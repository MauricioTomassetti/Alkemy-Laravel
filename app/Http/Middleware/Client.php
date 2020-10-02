<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class Client
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
        if (Auth::user()->role->first()->name_role=="Cliente" && (Auth::id() == $request->id ||
            Auth::user()->slug == $request->id)) {
                return $next($request);
                 }
        abort(403);
    }
}
