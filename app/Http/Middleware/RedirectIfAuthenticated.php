<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // Cek guard admin
        if (Auth::guard('web')->check()) {
            return redirect()->route('admin.dashboard');
        }

        // Cek guard siswa
        if (Auth::guard('siswa')->check()) {
            return redirect()->route('siswa.dashboard');
        }

        return $next($request);
    }
}