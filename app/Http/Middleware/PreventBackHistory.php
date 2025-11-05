<?php

namespace App\Http\Middleware;

use Closure;

class PreventBackHistory
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        return $response->header('Cache-Control','no-store, no-cache, must-revalidate, max-age=0')
                        ->header('Pragma','no-cache')
                        ->header('Expires','Sat, 26 Jul 1997 05:00:00 GMT');
    }
}
