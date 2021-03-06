<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $target = User::where('email',$request->email)->first();
        if ($target){
            $credentials = $request->only('email', 'password');
        }else{
            $target2 = User::where('phone',$request->email)->first();
            if ($target2){
                $request['email'] = $target2->email;
                $credentials = $request->only('email', 'password');
                $target = $target2;
            }
        }
        if ($target || $target2){
            if (Auth::attempt($credentials)){
                if ($target->status == CONST_STATUS_ENABLED){
                    switch ($target->role){

                        case CONST_ROLE_ADMIN:  return redirect()->route('dashboard'); break;
                        case CONST_ROLE_VENDOR:  return redirect()->route('vendor-dashboard'); break;
                        case CONST_ROLE_USER:  return redirect()->route('home'); break;
                        case CONST_ROLE_ACTIVE_USER:  return redirect()->route('home'); break;

                        default: redirect()->route('/')->withErrors(['msg'=>'<div class="alert alert-danger" id="alert">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>Sorry! </strong> Unknown user!
                        </div>']);

                    }
                }else{
                    return redirect()->route('/')->withErrors(['msg'=>'<div class="alert alert-warning" id="alert">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>Sorry! </strong>Your account is disabled!!!
                        </div>']);
                }

            }else{
                return redirect()->route('/')->withErrors(['msg'=>'<div class="alert alert-danger" id="alert">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>Sorry! </strong>Password did not matched!
                        </div>']);
            }

        }else{
            return redirect()->route('/')->withErrors(['msg'=>'<div class="alert alert-danger" id="alert">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>Sorry! </strong> Your are not an user!
                        </div>']);
        }
    }
}
