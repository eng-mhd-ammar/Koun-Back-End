<?php

use App\Http\Exceptions\ExceptionsHandler;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        if(!env('APP_DEBUG')) {
            $exceptions->render(function (Throwable|Exception $exception) {
                if (request()->is('api/*')) {
                    return (new ExceptionsHandler)($exception);
                }
            });
        }
    })->create();
