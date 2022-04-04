<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function findex(Request $request){
        if ($request->ajax()) {
            $data = User::where('role', 0)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<button class="btn btn-primary btn-sm" onclick="Status('.$row->id.')"><i class="fas fa-sync-alt"></i></button>
                            <button class="btn btn-warning btn-sm" onclick="Show('.$row->id.')"><i class="fas fa-pen-square"></i></button>
                            <button class="btn btn-danger btn-sm" onclick="Delete('.$row->id.')"><i class="fas fa-trash"></i></button>';

                    return $btn;
                })
                ->addColumn('status', function($row){
                    if ($row->status == 1){
                        $btn = '<span class="badge badge-pill badge-primary">Active</span>';

                    }else{
                        $btn = '<span class="badge badge-pill badge-danger">Disabled</span>';

                    }
                    return $btn;
                })
                ->addColumn('photo', function($row){
                    return '<img style="width: 50px" src="storage/user/'.$row->photo.'">';
                })
                ->rawColumns(['action', 'status', 'photo'])
                ->make(true);
        }
        return view('admin.pages.flying-user.index');
    }
    public function sindex(Request $request){
        if ($request->ajax()) {
            $data = User::where('role', 2)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<button class="btn btn-primary btn-sm" onclick="Status('.$row->id.')"><i class="fas fa-sync-alt"></i></button>
                            <button class="btn btn-warning btn-sm" onclick="Show('.$row->id.')"><i class="fas fa-pen-square"></i></button>
                            <button class="btn btn-danger btn-sm" onclick="Delete('.$row->id.')"><i class="fas fa-trash"></i></button>';

                    return $btn;
                })
                ->addColumn('status', function($row){
                    if ($row->status == 1){
                        $btn = '<span class="badge badge-pill badge-primary">Active</span>';

                    }else{
                        $btn = '<span class="badge badge-pill badge-danger">Disabled</span>';

                    }
                    return $btn;
                })
                ->addColumn('photo', function($row){
                    return '<img style="width: 50px" src="storage/user/'.$row->photo.'">';
                })
                ->rawColumns(['action', 'status', 'photo'])
                ->make(true);
        }
        return view('admin.pages.store-user.index');
    }
    public function uindex(Request $request){
        if ($request->ajax()) {
            $data = User::where('role', 3)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<button class="btn btn-primary btn-sm" onclick="Status('.$row->id.')"><i class="fas fa-sync-alt"></i></button>
                            <button class="btn btn-warning btn-sm" onclick="Show('.$row->id.')"><i class="fas fa-pen-square"></i></button>
                            <button class="btn btn-danger btn-sm" onclick="Delete('.$row->id.')"><i class="fas fa-trash"></i></button>';

                    return $btn;
                })
                ->addColumn('status', function($row){
                    if ($row->status == 1){
                        $btn = '<span class="badge badge-pill badge-primary">Active</span>';

                    }else{
                        $btn = '<span class="badge badge-pill badge-danger">Disabled</span>';

                    }
                    return $btn;
                })
                ->addColumn('photo', function($row){
                    return '<img style="width: 50px" src="storage/user/'.$row->photo.'">';
                })
                ->rawColumns(['action', 'status', 'photo'])
                ->make(true);
        }
        return view('admin.pages.user.index');
    }
    public function aindex(Request $request){
        if ($request->ajax()) {
            $data = User::where('role', 1)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<button class="btn btn-primary btn-sm" onclick="Status('.$row->id.')"><i class="fas fa-sync-alt"></i></button>
                            <button class="btn btn-warning btn-sm" onclick="Show('.$row->id.')"><i class="fas fa-pen-square"></i></button>
                            <button class="btn btn-danger btn-sm" onclick="Delete('.$row->id.')"><i class="fas fa-trash"></i></button>';

                    return $btn;
                })
                ->addColumn('status', function($row){
                    if ($row->status == 1){
                        $btn = '<span class="badge badge-pill badge-primary">Active</span>';

                    }else{
                        $btn = '<span class="badge badge-pill badge-danger">Disabled</span>';

                    }
                    return $btn;
                })
                ->addColumn('photo', function($row){
                    return '<img style="width: 50px" src="storage/user/'.$row->photo.'">';
                })
                ->rawColumns(['action', 'status', 'photo'])
                ->make(true);
        }
        return view('admin.pages.admin-user.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $a = User::all();
        return response()->json([
            'user' => $a
        ],200);
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
        if ($request->type){
            $role = 2;
            $ref = $request->ref_user;
        }else{
            $role = 0;
            $ref = null;
        }
        User::create([
           'name' => $request->name,
           'user_name' =>substr(str_replace(' ', '', strtolower($request->name)), 0, 5).rand(1,2000),
           'photo' => 'default.png',
           'email' => $request->email,
           'phone' => $request->phone,
           'role' => $role,
           'reffer_by' => $ref,
           'password' => Hash::make($request->password)
        ]);
        return response()->json([
            'message' => 'Registration done'
        ],200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forget(Request $request)
    {
        $token = Str::random(32);
      $st =   User::where('email',$request->email)->update([
            'remember_token' => $token
        ]);
      if ($st){
          (new User)->forceFill([
              'email' => $request->email,
          ])->notify(new PasswordReset($token));
          return response()->json([
              'message' => 'Password reset link is send to your email'
          ],200);
      }else{
          return response()->json([
              'message' => 'No user found'
          ],420);
      }

    }
    public function reset(Request $request)
    {
        $st =  User::find($request->id);
        if ($st){
           User::where('id',$request->id)->update([
                'remember_token' => null,
                'password' => Hash::make($request->password)
            ]);
            return response()->json([
                'message' => 'Password reset successfully'
            ],200);
        }else{
            return response()->json([
                'message' => 'Expired'
            ],4200);
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
