<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //Not Logged Users
        if(!Auth::guard()->check()){
            return redirect('/login');
        }

        //Blocked Users
        if(Auth::guard()->user()->blocked_at != null){
            return redirect('/login');
        }

        return $next($request);
    }
}
