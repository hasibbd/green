<?php

namespace App\Console\Commands;

use App\Models\CompanyWallet;
use App\Models\Generation;
use App\Models\StoreManagerWallat;
use App\Models\UserBalanceWallat;
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
        $company_wallet = CompanyWallet::all()->sum('balance');
        $date = Carbon::now()->subDays(1);
        $store_manager_wallet = StoreManagerWallat::where('created_at', '>=', $date)->get();
        $store_wallet = [];
        $user_wallet = [];
        foreach ($store_manager_wallet->unique('target_id') as $u){
            $point = StoreManagerWallat::where('target_id', $u->target_id)->sum('balance');
            if ($point > 0){
                $store_wallet [] = [
                    'vendor_id' => null,
                    'order_id' => null,
                    'balance' => -$point, //Balance need check
                    'created_by' => 1,
                    'target_id' => $u->target_id,
                ];
                $user_wallet [] = [
                    'user_id' => $u->target_id,
                    'balance' => $point,
                    'from' => 1,
                    'created_by' => 1,
                    'target_id' => $u->target_id,
                    'status' => 1,
                ];
            }
        }
        StoreManagerWallat::insert($store_wallet);
        UserBalanceWallat::insert($user_wallet);

        \Log::info("Cron is working fine!");
    }
}
