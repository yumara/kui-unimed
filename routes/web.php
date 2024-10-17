<?php

use Illuminate\Support\Facades\Route;


Route::prefix('auth')->group(function () {
    $authProvider = config('auth.provider');
    if (in_array('database', $authProvider)) {
        require __DIR__ . "/Web/Auth/database.php";
    }

    if (in_array('keycloak', $authProvider)) {
        Route::prefix('keycloak')->group(function () {
            require __DIR__ . "/Web/Auth/keycloak.php";
        });
    }
});

Route::middleware(['auth', 'auth_keycloak', 'role:ADMIN'])
    ->prefix('admin')->group(function () {
        require __DIR__ . "/Web/Admin/routes.php";
    });

Route::middleware(['auth', 'auth_keycloak', 'role:USER'])
    ->prefix('user')->group(function () {
        require __DIR__ . "/Web/User/routes.php";
    });
Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->hasRole('ADMIN')) {
            return redirect('/admin');
        } elseif (Auth::user()->hasRole('USER')) {
            return redirect('/user');
        }
    }
    return redirect('/auth/login');
});
