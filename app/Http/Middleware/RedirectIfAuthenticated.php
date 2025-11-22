<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$guards)
    {
    if ($request->is('login')) {
        if (Auth::check()) {
            return match(Auth::user()->role_id) {
                1 => redirect()->route('admin.dashboard'),
                2 => redirect()->route('siswa.dashboard'),
            };
        }
    }


    return $next($request);
    }

}
