<?php

namespace App\Http\Controllers;

use App\Models\StoreManagerApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class StoreAppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = StoreManagerApplication::with('user')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<button class="btn btn-primary btn-sm" onclick="Status('.$row->id.')"><i class="far fa-check-circle"></i></button>
                            <button class="btn btn-warning btn-sm" onclick="Show('.$row->id.')"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-danger btn-sm" onclick="Delete('.$row->id.')"><i class="fas fa-trash"></i></button>';

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
        return view('admin.pages.store-application.index');
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
        $tar = User::find(Auth::user()->id);
        if (strtolower($request->check_yes) != 'yes'){
            return response()->json([
                'message' => 'Please type "Yes" in the input filed',
            ],404);
        }
        if (!$tar->is_registered){
            return response()->json([
                'message' => 'Your are not a registered user',
                'data' => $tar
            ],404);
        }
        if (!$tar->is_store_manager){
            StoreManagerApplication::create([
                'user_id' => Auth::user()->id,
                'created_by' => Auth::user()->id
            ]);
            return response()->json([
                'message' => 'Application submitted successfully',
            ],200);
        }else{
            return response()->json([
                'message' => 'Your have already submit an application',
                'data' => $tar
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $data = StoreManagerApplication::with('user')->where('id', $id)->first();
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
        $data = StoreManagerApplication::find($id);
        StoreManagerApplication::destroy($id);
        $data = User::where('id', $data->user_id)->update([
            'is_store_manager' => false
        ]);
        return response()->json([
            'message' => 'Data deleted',
            'data' =>[]
        ],202);
    }
    public function status($id)
    {
        $data = StoreManagerApplication::find($id);
        if ($data->status){
            StoreManagerApplication::where('id', $id)->update([
                'status' => false
            ]);
            User::where('id', $data->user_id)->update([
                'is_store_manager' => false
            ]);
            return response()->json([
                'message' => 'Data status update to disabled',
                'data' => $data
            ],200);
        }else{
            StoreManagerApplication::where('id', $id)->update([
                'status' => true
            ]);
            User::where('id', $data->user_id)->update([
                'is_store_manager' => true
            ]);
            return response()->json([
                'message' => 'Data status update to enable',
                'data' => $data
            ],200);
        }
    }
}
