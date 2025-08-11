<?php

use App\Http\Middleware\AdminAuthMiddleware; //added this line by dhananjay 04-05-2025
use App\Http\Middleware\AdminGuestMiddleware; //added this line by dhananjay 04-05-2025
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->append(\App\Http\Middleware\TrustProxies::class);
		 $middleware->alias([            //added this line by dhananjay 04-05-2025
            'admin_auth' => AdminAuthMiddleware::class,
            'admin_guest' => AdminGuestMiddleware::class
        ]);
		
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
