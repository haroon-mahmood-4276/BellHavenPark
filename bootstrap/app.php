<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\{Exceptions, Middleware};
use Spatie\Permission\Middleware\{PermissionMiddleware, RoleMiddleware, RoleOrPermissionMiddleware};
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function () {
            Route::middleware('web')
                ->prefix('ajax')
                ->group(base_path('routes/ajax.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        },
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(fn () => route('login.view'))
            ->redirectUsersTo(fn () => route('dashboard.index'))
            ->alias([
                'role' => RoleMiddleware::class,
                'permission' => PermissionMiddleware::class,
                'role_or_permission' => RoleOrPermissionMiddleware::class,
            ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
