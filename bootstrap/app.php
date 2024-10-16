<?php

use App\Helper\RouteUtils;
use App\Http\Middleware\EnsureUserHasRole;
use App\Http\Middleware\EnsureUserRoleNot;
use App\Http\Middleware\ValidateKeycloakSession;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
//        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/internal/status',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => EnsureUserHasRole::class,
            'role_not' => EnsureUserRoleNot::class,
            'auth_keycloak' => ValidateKeycloakSession::class,
        ]);
        $middleware->redirectUsersTo(function () {
            return RouteUtils::getIndexRoute();
        });
        $middleware->redirectGuestsTo(function () {
            return RouteUtils::getLogInRoute();
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
