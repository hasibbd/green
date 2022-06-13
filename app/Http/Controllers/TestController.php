<?php

namespace App\Http\Controllers;

use App\Models\CompanyWallet;
use App\Models\Generation;
use App\Models\GenerationBasic;
use App\Models\PointWallet;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserBalanceWallat;
use App\Models\UserInformation;
use App\Models\UserReserve;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $target = UserReserve::where('status', CONST_STATUS_DISABLED)->get();

       foreach ($target as $t){
         //  $this->companyDistribution($t->balance,CONST_COMMISSION_COMPANY,$t->user_id);
         //  $this->generationDistribution($t->balance,CONST_COMMISSION_GENERATION,$t->user_id);
        $this->generationDistribution($t->balance,CONST_COMMISSION_GENERATION,$t->user_id);
          // $this->basicDistribution($t->balance,CONST_COMMISSION_BASIC,$t->user_id)
         //   return response()->json($this->generationDistribution($t->balance,CONST_COMMISSION_GENERATION,$t->user_id));
       }
     /*   UserReserve::where('status', CONST_STATUS_DISABLED)->update([
           'status' => CONST_STATUS_ENABLED
        ]);*/

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
        return $data;
       // CompanyWallet::create($data);
    }
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
                    'from' => 'Generation basic',
                    'created_by' => CONST_ROLE_ADMIN,
                    'target_id' => $ref_user->id,
                    'status' => CONST_DISTRIBUTE_DONE,
                ]);
                $start++;
                $this->generationDistributionMaker($ref_user->id, $total, $ref_user->generatoion_step, $start);
            }
         }
        }
    public function basicDistribution($total_balance, $percentage, $user_id){
        $main_user = User::find($user_id);
        $balance = ($total_balance*$percentage)/100;
        $today = Carbon::today()->toDateString();
        $targets = UserInformation::with('user','last_shop')
            ->withSum('point', 'point')
            ->whereRelation('user','status', CONST_STATUS_ENABLED)
           // ->whereRelation('user','user_id', '<', $main_user->user_id)
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
        $this->Distribute($total, 3000, $user_array);
    }
    public function Sum($client) {
        $n = $client;
        $a = 1;
        $l = $client;
        return ($n*($a + $l))/2;
	}
    public function Distribute($client, $total, $users){
        $j = $client;
		 $per_head = $total/$this->Sum($client);
        $user_wallet = [];
         for ($i = 0; $i < $client; $i++) {
            $will_get = $j*$per_head;
             $user_wallet [] = [
                 'user_id' => $users[$i],
                 'balance' => $will_get,
                 'from' => 'Basic Commission',
                 'created_by' => CONST_ROLE_ADMIN,
                 'target_id' => $users[$i],
                 'status' => CONST_DISTRIBUTE_DONE,
             ];
         	 $j--;
         }
         dd($user_wallet);
      //  UserBalanceWallat::insert($user_wallet);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
