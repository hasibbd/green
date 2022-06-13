<?php

namespace App\Http\Controllers;

use App\Models\CompanyWallet;
use App\Models\User;
use App\Models\VendorLimit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class LimitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = VendorLimit::where('user_id', Auth::user()->id)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function($row){
                    if ($row->created_by == CONST_ROLE_ADMIN){
                        return 'Point Purchased';
                    }else{
                        return 'Products Sell';
                    }

                })
                ->addColumn('date', function($row){
                    return date("F j, Y, g:i a", strtotime($row->created_at));
                })
                ->rawColumns(['date','user'])
                ->make(true);
        }
        return view('admin.pages.limit-list.index');
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
     $st = VendorLimit::create([
           'user_id' => $request->id,
           'limit' => $request->limit,
           'created_by' => Auth::user()->id,
       ]);
     if ($st){
         CompanyWallet::create([
             'user_id' => $request->id,
             'balance' => -$request->limit,
             'remarks' => 'Store Limit',
             'created_by' => Auth::user()->id,
             'target_id' => $request->id,
             'status' => CONST_DISTRIBUTE_PENDING,
         ]);
         return response()->json([
             'message' => 'Limit updated',
             'data' => $st
         ],200);
     }else{
         return response()->json([
             'message' => 'Failed',
             'data' => []
         ],404);
     }
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
