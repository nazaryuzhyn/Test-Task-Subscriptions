<?php

use App\Modules\Auth\Controllers\LoginController;
use App\Modules\Auth\Controllers\LogoutController;
use App\Modules\Auth\Controllers\SignupController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', LoginController::class)->name('login');
    Route::post('signup', SignupController::class)->name('signup');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::delete('logout', LogoutController::class)->name('logout');
    });
});
