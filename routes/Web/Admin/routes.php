<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Admin\HomeController;
use App\Http\Controllers\Web\Admin\ProfileController;

Route::middleware('auth')->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('admin.index');
    });
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('admin.profile');
        Route::put('/profile/{id}', 'update')->name('admin.profile.store');
        Route::put('/profile/{id}/upload', 'upload')->name('admin.profile.uploadimage');
    });
});
