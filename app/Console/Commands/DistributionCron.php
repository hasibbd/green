<?php

namespace App\Console\Commands;

use App\Models\CompanyWallet;
use App\Models\Generation;
use App\Models\GenerationBasic;
use App\Models\Setting;
use App\Models\StoreManagerWallat;
use App\Models\User;
use App\Models\UserBalanceWallat;
use App\Models\UserInformation;
use App\Models\UserReserve;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DistributionCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'distribution:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $target = UserReserve::where('status', CONST_STATUS_DISABLED)->get();

        foreach ($target as $t){
            $this->companyDistribution($t->balance, CONST_COMMISSION_COMPANY, $t->user_id);
            $this->generationDistribution($t->balance, CONST_COMMISSION_GENERATION, $t->user_id);
            $this->basicDistribution($t->balance, CONST_COMMISSION_BASIC, $t->user_id);
        }
        $this->storeDistribution();
        UserReserve::where('status', CONST_STATUS_DISABLED)->update([
           'status' => CONST_STATUS_ENABLED
        ]);
        \Log::info("Distribution cron is working fine fine!");
    }
    public function storeDistribution(){
        $store_manager_wallet = StoreManagerWallat::where('status', CONST_DISTRIBUTE_PENDING)->get();
        $user_wallet = [];
        $com_wallet = [];
        foreach ($store_manager_wallet->unique('user_id') as $u){
            $point = StoreManagerWallat::where('user_id', $u->user_id)->sum('balance');
            if ($point > 0){
                $user_wallet [] = [
                    'user_id' => $u->user_id,
                    'balance' => $point,
                    'from' => 'Store sales commission',
                    'created_by' => CONST_ROLE_ADMIN,
                    'target_id' => $u->user_id,
                    'status' => CONST_DISTRIBUTE_PENDING,
                ];
                $com_wallet [] = [
                    'user_id' => $u->user_id,
                    'balance' => -$point,
                    'remarks' => 'Store sales commission',
                    'created_by' => CONST_ROLE_ADMIN,
                    'target_id' => $u->vendor_id,
                    'status' => CONST_DISTRIBUTE_PENDING,
                ];
                StoreManagerWallat::where('user_id', $u->user_id)->update([
                    'status' => CONST_DISTRIBUTE_DONE
                ]);
            }
        }
        UserBalanceWallat::insert($user_wallet);
        CompanyWallet::insert($com_wallet);
        \Log::info("Store manager distribution done!");
    }
    public function companyDistribution($total_balance, $percentage, $user_id){
        $data = [
            'user_id' => $user_id,
            'balance' => ($total_balance*$percentage)/100,
            'remarks' => 'Company Commission',
            'created_by' => CONST_ROLE_ADMIN,
            'target_id' => $user_id,
            'status' => CONST_DISTRIBUTE_PENDING,
        ];
         CompanyWallet::create($data);
    }
    public function basicDistribution($total_balance, $percentage, $user_id){
        $main_user = User::find($user_id);
        $balance = ($total_balance*$percentage)/100;
        $today = Carbon::today()->toDateString();
        $targets = UserInformation::with('user','last_shop')
            ->withSum('point', 'point')
            ->whereRelation('user','status', CONST_STATUS_ENABLED)
            ->whereRelation('user','user_id', '<', $main_user->user_id)
            ->get();
        $user_array = [];
        $total = 0;
        foreach ($targets as $t) {
            if (isset($t->last_shop)){
                $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $t->last_shop->created_at);
                $from = \Carbon\Carbon::today();
                $diff_in_days = $to->diffInDays($from);
                if ($diff_in_days <= CONST_DISTRIBUTE_DATE){
                    array_push($user_array, $t->user_id);
                    $total++;
                }
            }
        }
        $this->Distribute($total, $balance, $user_array);
    }
    public function Sum($client) {
        $n = $client;
        $a = 1;
        $l = $client;
        return ($n*($a + $l))/2;
    }
    public function Distribute($client, $total, $users){
        if ($client > 0){
            $j = $client;
            $per_head = $total/$this->Sum($client);
            $user_wallet = [];
            for ($i = 0; $i < $client; $i++) {
                $will_get = $j*$per_head;
                $user_wallet [] = [
                    'user_id' => $users[$i],
                    'balance' => $will_get,
                    'status' => CONST_DISTRIBUTE_DONE,
                ];
                $j--;
            }
            GenerationBasic::insert($user_wallet);
        }
    }
    //Generation + Basic
    public function generationDistribution($total_balance, $percentage, $user_id){
        $main_user = User::find($user_id);
        $balance = ($total_balance*$percentage)/100;
        $step = $main_user->generatoion_step;
        $start = 1;
        $this->generationDistributionMaker($main_user->id, $balance, $step, $start);
    }
    public function genBalanceGen($balance, $gen_step){
        $gen_setting = Generation::find($gen_step);
        $cal_balance = 0;
        if ($gen_setting){
            $cal_balance = ($balance*$gen_setting->percentage)/100;
        }
        return $cal_balance;
    }
    public function generationDistributionMaker($gen_id, $total, $gen_step, $start){
        if ($start <= $gen_step){
            $user = UserInformation::where('user_id', $gen_id)->first();
            if ($user){
                $ref_user = User::where('user_id', $user->generatoion_reffer)->first();

                UserBalanceWallat::create([
                    'user_id' => $ref_user->id,
                    'balance' => $this->genBalanceGen($total, $start),
                    'from' => 'Generation bonus',
                    'created_by' => CONST_ROLE_ADMIN,
                    'target_id' => $ref_user->id,
                    'status' => CONST_DISTRIBUTE_DONE,
                ]);
                GenerationBasic::create([
                    'user_id' => $ref_user->id,
                    'balance' => 50,
                    'status' => CONST_DISTRIBUTE_DONE,
                ]);
                $start++;
                $this->generationDistributionMaker($ref_user->id, $total, $ref_user->generatoion_step, $start);
            }
        }
    }
    //Basic wallet check
    public function basicWalletRefresh(){
        $targets = UserInformation::with('user','last_shop')
            ->withSum('point', 'point')
            ->whereRelation('user','status', CONST_STATUS_ENABLED)
            ->get();
        $user_array = [];
        $total = 0;
        foreach ($targets as $t) {
            if (isset($t->last_shop)){
                $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $t->last_shop->created_at);
                $from = \Carbon\Carbon::today();
                $diff_in_days = $to->diffInDays($from);
                if ($diff_in_days <= CONST_DISTRIBUTE_DATE){
                    array_push($user_array, $t->user_id);
                    $total++;
                }
            }
        }
        $this->Distribute($total, $balance, $user_array);
    }
}
