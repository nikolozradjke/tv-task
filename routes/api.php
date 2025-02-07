<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\TvAuthController;
use App\Http\Controllers\TV\TvCodeController;
use App\Http\Controllers\UserRegistrationController;

Route::middleware(['throttle:60,1'])->group(function () {
    Route::post('/register', UserRegistrationController::class);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/refresh', [AuthController::class, 'refreshToken']);
    Route::post('/active-tv-code', [TvAuthController::class, 'activateCode']);
    Route::post('/poll-tv-code', [TvAuthController::class, 'pollTheCode']);

    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('/generate-tv-code', [TvCodeController::class, 'generateTvAuthCode']);
    });
});
