<?php

use App\Http\Controllers\Web\Auth\Keycloak\KeycloakLogInController;
use App\Http\Controllers\Web\Auth\Keycloak\KeycloakLogOutController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->controller(KeycloakLogInController::class)->group(function () {
    Route::get('/login', 'index')->name('auth.keycloak.login');
    Route::get('/login/callback', 'callbackHandler')->name('auth.keycloak.login.callback');
});

Route::middleware('auth')->controller(KeycloakLogOutController::class)->group(function () {
    Route::get('/logout', 'index')->name('auth.keycloak.logout');
    Route::get('/logout/callback', 'callbackHandler')->name('auth.keycloak.logout.callback');
});
