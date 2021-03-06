<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::user()){
            Auth::logout();
            session()->flush();
            return redirect()->route('/')->withErrors(['msg'=>'<div class="alert alert-warning" id="alert">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>Sorry! </strong> Please Login First!
                        </div>']);
        }
        if (Auth::user()){
            if (Auth::user()->role == CONST_ROLE_ADMIN) {
              return $next($request);
            }
        }
        Auth::logout();
        session()->flush();
        return redirect()->route('/')->withErrors(['msg'=>'<div class="alert alert-danger" id="alert">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>Sorry! </strong> Unauthorized Action Performed!
                        </div>']);
    }
}
