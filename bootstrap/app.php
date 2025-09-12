<?php

use App\Http\Middleware\CheckCustomerRole;
use App\Http\Middleware\CheckDriverRole;
use App\Http\Middleware\checkOwnerRole;
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
        $middleware->alias([
            "OwnerCheck"=>checkOwnerRole::class,
            "CustomerCheck"=>CheckCustomerRole::class,
            "DriverCheck"=>CheckDriverRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
