<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // return $next($request);
        if(Auth::check())
        {
            if(Auth::user()->role == 'ROOT' || Auth::user()->role == 'ADMIN')
            {
                return $next($request);
            }
            else
            {
                return redirect('/home')->withErrors(['danger' => trans('admin.message.rootpermission')]);
            }
        }
        else
        {
            return redirect('/home')->withErrors(['danger' => trans('admin.message.loginrequired')]);
        }
    }
}
