<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\CMS\CMSConfiguration;

class CheckSiteDown
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->is('admin/*') && !$request->is('admin')) {
            $configuration = CMSConfiguration::first();
            if ($configuration->front_site_up == '0') {
                return response()->view('errors.503', [], 503);
            }
        }

        return $next($request);
    }
}
