<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Developer
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
        //dd($request->slug);
        if (Auth::check() && Auth::user()->roles->first()->name_role == "Desarrollador") {
            return $next($request);
        }
        return back();
    }
}
