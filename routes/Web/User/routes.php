<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\User\HomeController;
use App\Http\Controllers\Web\User\ProfileController;
use App\Http\Controllers\Web\User\IBMAController;

Route::middleware('auth')->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('user.index');
    });
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('user.profile');
        Route::put('/profile/{id}', 'update')->name('user.profile.update');
    });
    Route::controller(IBMAController::class)->group(function () {
        Route::get('/ibma', 'index')->name('user.ibma');
        Route::get('/ibma/new', 'createForm')->name('user.ibma.create');
        Route::get('/ibma/{id}', 'detail')->name('user.ibma.detail');
        Route::get('/ibma/{id}/edit', 'updateForm')->name('user.ibma.edit');
        Route::get('/ibma/{id}/upload', 'uploadForm')->name('user.ibma.upload');
        Route::post('/ibma/{id}', 'store')->name('user.ibma.store');
        Route::put('/ibma/{id}', 'update')->name('user.ibma.update');
        Route::delete('/ibma/{id}', 'delete')->name('user.ibma.delete');
    });
});
