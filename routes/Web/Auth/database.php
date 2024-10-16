<?php

use App\Http\Controllers\Web\Auth\LogInController;
use App\Http\Controllers\Web\Auth\LogOutController;
use App\Http\Controllers\Web\Auth\Password\ForgotPasswordController;
use App\Http\Controllers\Web\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Web\Auth\RegisterController;
use Illuminate\Support\Facades\Route;


Route::middleware("guest")->group(function () {
    Route::controller(LogInController::class)->group(function () {
        Route::get("/login", "index")->name("auth.login");
        Route::post("/login", "store")->name("auth.login.store");
    });

    Route::controller(RegisterController::class)->group(function () {
        Route::get("/register", "index")->name("auth.register");
        Route::post("/register", "store")->name("auth.register.store");
    });

    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get("/forgot-password", "index")->name("auth.password.forgot");
        Route::post("/forgot-password", "store")->name("auth.password.forgot.store");
    });

    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get("/reset-password/{token}", "index")->name("password.reset");
        Route::post("/reset-password", "store")->name("auth.password.reset.store");
    });
});

Route::middleware("auth")->group(function () {
    Route::get("/logout", LogOutController::class)->name("auth.logout");
});
