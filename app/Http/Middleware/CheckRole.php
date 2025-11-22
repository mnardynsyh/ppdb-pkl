<?php

    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Symfony\Component\HttpFoundation\Response;

    class CheckRole
    {
        public function handle($request, Closure $next, $role)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    if (Auth::user()->role_id != $role) {
        abort(403, 'Anda tidak memiliki akses.');
    }

    return $next($request);
}

    }