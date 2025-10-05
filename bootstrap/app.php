<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\ValidUser;
use App\Http\Middleware\TestUserRole;
use App\Http\Middleware\HelloUser;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'IsValidUser' => ValidUser::class,
            'TestRole' => TestUserRole::class,
        ]);

        $middleware->group('ok-user', [
            ValidUser::class,
            TestUserRole::class,
        ]);

        // Uncomment if HelloUser middleware exists
        // $middleware->append(HelloUser::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
