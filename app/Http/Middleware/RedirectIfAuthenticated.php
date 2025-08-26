<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Kalau user sudah login, arahkan ke dashboard sesuai role
                $user = Auth::user();

                if ($user->id_role == 1) {
                    return redirect()->route('admin.dashboard');
                } elseif ($user->id_role == 2) {
                    return redirect()->route('siswa.dashboard');
                }

                return redirect('/home'); // fallback
            }
        }

        return $next($request);
    }
}
