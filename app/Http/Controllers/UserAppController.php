<?php

namespace App\Http\Controllers;

use App\Models\CompanyWallet;
use App\Models\PointWallet;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserBalanceWallat;
use App\Models\UserInformation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use function Symfony\Component\String\length;

class UserAppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = UserInformation::with('user')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if ($row->status){
                        $btn = '<button class="btn btn-warning btn-sm" onclick="Show('.$row->id.')"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-danger btn-sm" onclick="Delete('.$row->id.')"><i class="fas fa-trash"></i></button>';

                    }else{
                        $btn = '<button class="btn btn-primary btn-sm" onclick="Status('.$row->id.')"><i class="far fa-check-circle"></i></button>
                            <button class="btn btn-warning btn-sm" onclick="Show('.$row->id.')"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-danger btn-sm" onclick="Delete('.$row->id.')"><i class="fas fa-trash"></i></button>';

                    }

                    return $btn;
                })
                ->addColumn('status', function($row){
                    if ($row->status == 1){
                        $btn = '<span class="badge badge-pill badge-success">Approved</span>';

                    }else{
                        $btn = '<span class="badge badge-pill badge-warning">Pending</span>';

                    }
                    return $btn;
                })
                ->addColumn('photo', function($row){
                    return '<img style="width: 50px" src="storage/user/'.$row->user->photo.'">';
                })
                ->rawColumns(['action', 'status', 'photo'])
                ->make(true);
        }
        return view('admin.pages.user-application.index');
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $data = UserInformation::with('user')->where('id', $id)->first();
        if ($data){
            return response()->json([
                'message' => 'Data Found',
                'data' => $data
            ],200);
        }else{
            return response()->json([
                'message' => 'Data not found',
                'data' => $data
            ],404);
        }
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $data = UserInformation::find($id);
        UserInformation::destroy($id);
        $data = User::where('id',  $data->user_id)->update([
            'is_registered' => false
        ]);
        return response()->json([
            'message' => 'Data deleted',
            'data' =>[]
        ],202);
    }
    public function status($id)
    {
        $data = UserInformation::find($id);
        DB::beginTransaction();

        try {
            if ($data->status == true){
                UserInformation::where('id', $id)->update([
                    'status' => false
                ]);
                User::where('id', $data->user_id)->update([
                    'is_registered' => false,
                    'distribution_date' => null
                ]);
                PointWallet::create([
                    'user_id' => $data->user_id,
                    'point' => Setting::find(CONST_SETTING_USER_APPLICATION)->point_rate,
                    'generate_from' => 'Application Decline',
                    'status' => CONST_DISTRIBUTE_PENDING,
                ]);
                return response()->json([
                    'message' => 'Data status update to disabled',
                    'data' => $data
                ],200);
            }
            else{
                UserInformation::where('id', $id)->update([
                    'status' => true
                ]);
                $check = User::max('user_id');
                if ($check){
                    $nu = (int) $check;
                    $user_id = sprintf("%08d", $nu+1);
                }else{
                    $user_id = '00000001';
                }
                $target = User::find( $data->user_id);
                if ($target->user_id){
                    User::where('id', $data->user_id)->update([
                        'is_registered' => true,
                        'reffer_by' => $data->r_code,
                    ]);
                }else{
                    User::where('id', $data->user_id)->update([
                        'is_registered' => true,
                        'user_id' => $user_id
                    ]);
                }
                User::where('id', $data->user_id)->update([
                    'distribution_date' => Carbon::today()->addDays(CONST_DISTRIBUTE_DATE)
                ]);
                PointWallet::create([
                    'user_id' => $data->user_id,
                    'point' => - Setting::find(CONST_SETTING_USER_APPLICATION)->point_rate,
                    'generate_from' => 'Application Fee',
                    'status' => CONST_DISTRIBUTE_DONE,
                ]);
                CompanyWallet::create([
                    'user_id' => $data->user_id,
                    'balance' => Setting::find(CONST_SETTING_USER_APPLICATION)->point_rate/Setting::find(CONST_SETTING_POINT_RATE)->point_rate,
                    'remarks' => 'Application fee',
                    'created_by' => Auth::user()->id,
                    'target_id' => $data->user_id,
                    'status' => CONST_DISTRIBUTE_DONE,
                ]);
                if ($data->is_paid_hpa == 0){
                    $rate = Setting::find(CONST_SETTING_HPA_BONUS);
                    $target_hpa = User::where('user_id', $data->hpa_reffer)->first();
                    $user_wallet [] = [
                     'user_id' => $target_hpa->id,
                     'balance' => $rate->point_rate,
                    'from' => 'HPA reference bonus',
                    'created_by' => Auth::user()->id,
                    'target_id' => $target_hpa->id,
                    'status' => CONST_DISTRIBUTE_PENDING,
                ];
                    CompanyWallet::create([
                        'user_id' => $target_hpa->id,
                        'balance' => -$rate->point_rate,
                        'remarks' => 'HPA reference bonus',
                        'created_by' => Auth::user()->id,
                        'target_id' => $data->user_id,
                        'status' => CONST_DISTRIBUTE_DONE,
                    ]);
                    UserBalanceWallat::insert($user_wallet);
                    UserInformation::where('id', $id)->update([
                        'is_paid_hpa' => 1
                    ]);
                }
                DB::commit();
                return response()->json([
                    'message' => 'Data status update to enable',
                    'data' => $data
                ],200);
            }

            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Failed'.$e,
                'data' => []
            ],404);
        }
    }
}
