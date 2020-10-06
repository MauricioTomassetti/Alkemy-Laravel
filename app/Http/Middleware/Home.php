<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Home
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
        
        if (!Auth::check()|| Auth::user()->role->first()->name_role == "Cliente" ) {
            return $next($request);
        }
        return redirect()->route('me.list',[Auth::user()->slug]);
    }
}
