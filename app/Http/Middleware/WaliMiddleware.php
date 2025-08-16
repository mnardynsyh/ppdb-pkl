<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class WaliMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'wali') {
            return $next($request);
        }
        return redirect()->route('login');
    }
}
