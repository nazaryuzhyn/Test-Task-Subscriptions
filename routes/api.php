<?php

use App\Modules\Subscriptions\Controllers\SubscriptionController;
use App\Modules\Users\Controllers\MeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:sanctum'], function () {
    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('me', MeController::class)->name('me');
    });

    /*
    |--------------------------------------------------------------------------
    | Subscriptions
    |--------------------------------------------------------------------------
    */
    Route::prefix('subscriptions')->name('subscriptions.')->group(function () {
        Route::get('plans', [SubscriptionController::class, 'plans'])->name('plans');
        Route::post('change-plan', [SubscriptionController::class, 'changePlan'])->name('change-plan');
    });
});
