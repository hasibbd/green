<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function checkRef(Request $request){
        if ($request->user_id == null){
            return response()->json([
                'message' => 'Please add referral user id',
                'data' => []
            ],404);
        }
        $check = User::where('user_id', $request->user_id)->get();
        if (count($check) > 0){
            if ($check[0]->is_store_manager == 1){
                if ($check[0]->is_registered){
                    return response()->json([
                        'message' => 'Referral user is found',
                        'data' => $check
                    ],200);
                }else{
                    return response()->json([
                        'message' => 'Referral user is not a registered user',
                        'data' => $check
                    ],404);
                }
            }else{
                return response()->json([
                    'message' => 'Referral user is not a store manager',
                    'data' => $check
                ],404);
            }
        }else{
            return response()->json([
                'message' => 'Not Found',
                 'data' => []
            ],404);
        }
    }
    public function login(){
       return view('auth.pages.login');
    }
    public function registration(){
        return view('auth.pages.register');
    }
    public function forgot(){
        return view('auth.pages.forgot');
    }
    public function recover($token){
        $target = User::where('remember_token',$token)->first();
        if ($target){
            return view('auth.pages.recover',compact('target'));
        }else{
            return view('auth.pages.login');
        }

    }
    public function logout(){
        session()->flush();
        Auth::logout();
        return redirect()->route('/')->withErrors(['msg'=>'<div class="alert alert-primary" id="alert">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>Thank You! </strong> See you soon...
                        </div>']);
    }
}
