<?php

declare(strict_types=1);

use App\Http\Middleware\HandleRedirects;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Sentry\Laravel\Integration;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__.'/../routes/auth.php',
            __DIR__.'/../routes/legacy.php',
            __DIR__.'/../routes/user.php',
            __DIR__.'/../routes/shortener.php',
            __DIR__.'/../routes/guest.php',
        ],
        commands: __DIR__.'/../routes/console.php',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware
            ->redirectGuestsTo('/login')
            ->append(HandleRedirects::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        Integration::handles($exceptions);
    })
    ->create();
