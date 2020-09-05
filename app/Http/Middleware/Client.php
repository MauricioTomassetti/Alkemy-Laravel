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
        if (Auth::id() == $request->id) {

            $rol = User::findOrFail($request->id)->role()->where('roles_users.id', '2')->first();

            if (Auth::check() &&  $rol->name_role == 'Cliente') {
                return $next($request);
            }
        }
        abort(403);
    }
}
