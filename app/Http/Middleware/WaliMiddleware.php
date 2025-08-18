<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class WaliMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('wali')->check()) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
