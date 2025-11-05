<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
        'admin' => \Illuminate\Auth\Middleware\Authenticate::class . ':web',
        'siswa' => \Illuminate\Auth\Middleware\Authenticate::class . ':siswa',
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'pendaftaran.status' => \App\Http\Middleware\CheckPendaftaranStatus::class,
        'prevent-back' => \App\Http\Middleware\PreventBackHistory::class,
    ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
