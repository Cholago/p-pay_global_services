<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // Define the main web routes file
        web: __DIR__.'/../routes/web.php',
        // Define the console commands routes file
        commands: __DIR__.'/../routes/console.php',
        // Define a simple health check endpoint
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            // Handle Inertia requests (for Inertia.js integration)
            \App\Http\Middleware\HandleInertiaRequests::class,
            // Add link headers for preloaded assets
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,

        ]);

        $middleware->alias([
             // Custom middleware to log user actions when they are authenticated
            'log.user.actions' => \App\Http\Middleware\LogUserActions::class,
        ]);

        // Additional middleware configuration can be added here
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Exception handling configuration can be added here
    })->create();
