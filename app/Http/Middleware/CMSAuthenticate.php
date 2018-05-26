<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CMSAuthenticate
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
        //Not Logged CMS Users
        if(!Auth::guard('cms')->check()){
            return redirect('/admin/login');
        }

        //Blocked CMS Users
        if(Auth::guard('cms')->user()->blocked_at != null){
            return redirect('/admin/login');
        }

        return $next($request);
    }
}
