<?php

namespace App\Http\Controllers;

use App\Models\PointWallet;
use App\Models\User;
use App\Models\UserInformation;
use App\Models\VendorLimit;
use App\Notifications\NewUser;
use App\Notifications\PasswordChanged;
use App\Notifications\PasswordRecover;
use App\Notifications\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function RegStore(Request $request){
        $check = User::where('user_id',$request->r_code)->first();
        if (!$check){
            return response()->json([
                'message' => 'Refer code is not found',
                'data' => []
            ],404);
        }
     $st =  UserInformation::create([
              "user_id" => Auth::user()->id,
              "b_date" => $request->b_date,
              "f_name" =>  $request->f_name,
              "m_name" =>  $request->m_name,
              "gender" =>  $request->gender,
              "l_license" =>  $request->l_license,
              "l_date" =>  $request->l_date,
              "district" =>  $request->district,
              "p_station" =>  $request->p_station,
              "p_code" =>  $request->p_code,
              "occupation" =>  $request->occupation,
              "qualification" =>  $request->qualification,
              "n_name" =>  $request->n_name,
              "n_b_date" =>  $request->n_b_date,
              "relation" =>  $request->relation,
              "n_nid" =>  $request->n_nid,
              "r_name" =>  $request->r_name,
              "r_code" =>  $request->r_code,
              "a_name" =>  $request->a_name,
              "b_name" =>  $request->b_name,
              "branch" =>  $request->branch,
              "acc" =>  $request->acc,
              "created_by" => Auth::user()->id
       ]);
        if ($st){
            return response()->json([
                'message' => 'Registration done'
            ],200);
        }else{
            return response()->json([
                'message' => 'Registration failed, please check the data'
            ],404);
        }
    }
    public function findex(Request $request){
        if ($request->ajax()) {
            $data = User::where('role', 0)->where('is_registered', false)->get();
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
                ->addColumn('point', function($row){
                    return PointWallet::where('user_id',$row->id)->sum('point');
                })
                ->addColumn('photo', function($row){
                    return '<img style="width: 50px" src="storage/user/'.$row->photo.'">';
                })
                ->rawColumns(['action', 'status', 'photo','point'])
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
                            <button class="btn btn-success btn-sm" onclick="AddLimit('.$row->id.')"><i class="fas fa-dollar-sign"></i></button>
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
                ->addColumn('limit', function($row){
                    $limit =VendorLimit::where('user_id', $row->id)->get();
                    if ($limit){
                        return $limit->sum('limit');
                    }else{
                        return 0;
                    }
                })
                ->addColumn('type', function($row){
                    if ($row->is_mobile_store == 1){
                        $btn = '<span class="badge badge-pill badge-primary">Mobile Store</span>';

                    }else{
                        $btn = '<span class="badge badge-pill badge-warning">General Store</span>';

                    }
                    return $btn;
                })
                ->addColumn('photo', function($row){
                    return '<img style="width: 50px" src="storage/user/'.$row->photo.'">';
                })
                ->rawColumns(['action', 'status', 'photo','type','limit'])
                ->make(true);
        }
        $st_user = User::where('role', 1)->where('is_store_manager', 1)->where('is_store_manager', 1)->where('is_registered', 1)->get();
        return view('admin.pages.store-user.index', compact('st_user'));
    }
    public function uindex(Request $request){
        if ($request->ajax()) {
            $data = User::where('role', 0)->where('is_registered', true)->get();
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
                ->addColumn('point', function($row){
                   return PointWallet::where('user_id',$row->id)->sum('point');
                })
                ->rawColumns(['action', 'status', 'photo', 'point'])
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
        $check = User::where('phone', $request->phone)->orWhere('email', $request->email)->first();
        if ($check){
            return response()->json([
                'message' => 'Registration failed, Email/Phone already used'
            ],404);
        }
        $check = User::where('user_id',$request->ref_user)->first();
        if (!$check){
            return response()->json([
                'message' => 'Refer code is not found',
                'data' => []
            ],404);
        }
        if ($request->type){
            $role = 2;
            $ref = $request->ref_user;
        }else{
            $role = 0;
            $ref = null;
        }
        if($request->hasfile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . Str::random(5) . '.' . $extension;
            $resize = Image::make($file)->resize(300, 300)->encode($extension);
            $save = Storage::put("public/user/" . $filename, $resize->__toString());
        }else{
            if ($request->id){
                $filename = User::find($request->id)->photo;
            }else{
                $filename = 'default.png';
            }
        }
        User::create([
           'name' => $request->name,
           'user_name' =>substr(str_replace(' ', '', strtolower($request->name)), 0, 5).rand(1,2000),
           'photo' => $filename,
           'email' => $request->email,
           'phone' => $request->phone,
           'role' => $role,
           'reffer_by' => $ref,
           'password' => Hash::make($request->password)
        ]);
        if (!$request->id){
            $data = [
                'email' => $request->email,
                'password' => $request->password,
            ];
            (new User)->forceFill([
                'email' => $request->email,
            ])->notify(new NewUser($data));
        }
        return response()->json([
            'message' => 'Registration done'
        ],200);
    }
    public function store2(Request $request)
    {
        if($request->hasfile('photo'))
        {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().Str::random(5).'.'.$extension;
            $resize = Image::make($file)->resize(300, 300)->encode($extension);
            $save = Storage::put("public/user/".$filename, $resize->__toString());
            $pass = rand(100000,999999);
            User::updateOrCreate([
                    'id' => $request->id
                ]
                ,[
                    'photo' => $filename,
                    'name' => $request->name,
                    'user_name' =>substr(str_replace(' ', '', strtolower($request->name)), 0, 5).rand(1,2000),
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'role' => $request->role,
                    'password' => Hash::make($pass),
                ]);
            if (!$request->id){
                $data = [
                    'email' => $request->email,
                    'password' => $pass,
                ];
                (new User)->forceFill([
                    'email' => $request->email,
                ])->notify(new NewUser($data));
            }

        }else{
            if ($request->id){
                $target = User::find($request->id)->photo;
            }else{
                $target = 'default.png';
            }
            User::updateOrCreate([
                    'id' => $request->id
                ]
                ,[
                    'photo' => $target,
                    'name' => $request->name,
                    'user_name' =>substr(str_replace(' ', '', strtolower($request->name)), 0, 5).rand(1,2000),
                    'email' => $request->email,
                    'phone' => $request->phone,
                ]);

        }
        return response()->json([
            'message' => 'Registration done'
        ],200);
    }
    public function store3(Request $request)
    {
        if ($request->type){
            $type = 1;
        }else{
            $type = 0;
        }
        if($request->hasfile('photo'))
        {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().Str::random(5).'.'.$extension;
            $resize = Image::make($file)->resize(300, 300)->encode($extension);
            $save = Storage::put("public/user/".$filename, $resize->__toString());
            $pass = rand(100000,999999);
            User::updateOrCreate([
                    'id' => $request->id
                ]
                ,[
                    'photo' => $filename,
                    'name' => $request->name,
                    'user_name' =>substr(str_replace(' ', '', strtolower($request->name)), 0, 5).rand(1,2000),
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'is_mobile_store' => $type,
                    'role' => $request->role,
                    'password' => Hash::make($pass),
                ]);
            if (!$request->id){
                $data = [
                    'email' => $request->email,
                    'password' => $request->password,
                ];
                (new User)->forceFill([
                    'email' => $request->email,
                ])->notify(new NewUser($data));
            }
        }else{
            if ($request->id){
                $target = User::find($request->id)->photo;
            }else{
                $target = 'default.png';
            }
            User::updateOrCreate([
                    'id' => $request->id
                ]
                ,[
                    'photo' => $target,
                    'name' => $request->name,
                    'user_name' =>substr(str_replace(' ', '', strtolower($request->name)), 0, 5).rand(1,2000),
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'is_mobile_store' => $type,
                ]);
        }

        return response()->json([
            'message' => 'Registration done'
        ],200);
    }
    public function basicUpdate(Request $request){
        if($request->hasfile('photo'))
        {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().Str::random(5).'.'.$extension;
            $resize = Image::make($file)->resize(300, 300)->encode($extension);
            $save = Storage::put("public/user/".$filename, $resize->__toString());
            User::updateOrCreate([
                    'id' => auth()->user()->id
                ]
                ,[
                    'photo' => $filename,
                    'name' => $request->name,
                ]);
        }else{
            if (auth()->user()->id){
                $target = User::find(auth()->user()->id)->photo;
            }else{
                $target = 'default.png';
            }
            User::updateOrCreate([
                    'id' => auth()->user()->id
                ]
                ,[
                    'photo' => $target,
                    'name' => $request->name,
                ]);
        }
        return response()->json([
            'message' => 'Information updated'
        ],200);
    }
    public function passUpdate(Request $request){
        if ($request->n_pass != $request->r_pass){
            return response()->json([
                'message' => 'Please check New password and Repeat password'
            ],404);
        }else{
            $check = Hash::check($request->o_pass, User::find(auth()->user()->id)->password);
            if ($check){
                User::updateOrCreate([
                        'id' => auth()->user()->id
                    ]
                    ,[
                        'password' => Hash::make($request->r_pass),
                    ]);
                (new User)->forceFill([
                    'email' => auth()->user()->email,
                ])->notify(new PasswordChanged());
                return response()->json([
                    'message' => 'Password Changed'
                ],200);
            }
            else{
                return response()->json([
                    'message' => 'Please check your current password'
                ],404);
            }
        }
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
      $data = [
          'hash' => $token
      ];
      if ($st){
          (new User)->forceFill([
              'email' => $request->email,
          ])->notify(new PasswordRecover($data));
          return response()->json([
              'message' => 'Password reset link is send to your email'
          ],200);
      }else{
          return response()->json([
              'message' => 'No user found'
          ],404);
      }

    }
    public function status($id)
    {
        $data = User::find($id);
        if ($data->status){
            $data = User::where('id', $id)->update([
                'status' => false
            ]);
            return response()->json([
                'message' => 'Data status update to disabled',
                'data' => $data
            ],200);
        }else{
            $data = User::where('id', $id)->update([
                'status' => true
            ]);
            return response()->json([
                'message' => 'Data status update to enable',
                'data' => $data
            ],200);
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
        $data = User::find($id);
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
        $check = User::where('role',1)->get();
        if (count($check) > 1){
            User::destroy($id);
            return response()->json([
                'message' => 'Data deleted',
                'data' =>[]
            ],202);
        }else{
            return response()->json([
                'message' => 'Data failed',
                'data' =>[]
            ],404);
        }

    }
    public function userRegistration(){
        return view('frontend.pages.profile.registration');
    }
    public function CodeCheck($code){
        $check = User::where('user_id',$code)->first();
        if ($check){
            return response()->json([
                'message' => 'Data found',
                'data' =>$check
            ],200);
        }else{
            return response()->json([
                'message' => 'Refer code is not found',
                'data' => []
            ],404);
        }

    }
}
