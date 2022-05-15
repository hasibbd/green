<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.pages.profile.index');
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        if ($request->password == $request->c_password){
            if($request->hasfile('profile')) {
                $file = $request->file('profile');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename = time() . Str::random(5) . '.' . $extension;
                $resize = Image::make($file)->resize(300, 300)->encode($extension);
                $save = Storage::put("public/user/" . $filename, $resize->__toString());
            }else{
                $filename = Auth::user()->photo;
            }
            if ($request->password){
              $data = [
                  'photo' => $filename,
                  'name' => $request->name,
                  'email' => $request->email,
                  'password' => Hash::make($request->password)
              ];
            }else{
                $data = [
                    'photo' => $filename,
                    'name' => $request->name,
                    'email' => $request->email
                ];
            }

            User::find(auth()->user()->id)->update($data);
           // Auth::attempt(array('email' => $request->email, 'password' =>$request->password), true);
            return response()->json([
                'message' => 'Profile information changed',
                'data' => $data
            ],200);

        }else{
            return response()->json([
               'message' => 'Password did not matched'
            ],400);
        }

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
