<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $e): void {
        $e->renderable(function (AuthenticationException $ex, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'success'    => false,
                    'statusCode' => 401,
                    'message'    => 'Vous devez être connecté pour effectuer toute action.',
                ], 401);
            }
        });
    })->create();
