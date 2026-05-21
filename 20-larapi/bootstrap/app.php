<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AuthToken;  // ← Agrega esta línea al inicio

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',  // ← Asegúrate de tener la API
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Registrar el middleware alias (esto reemplaza a $routeMiddleware)
        $middleware->alias([
            'auth.token' => AuthToken::class,  // ← Aquí registras tu middleware
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();