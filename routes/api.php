<?php

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Support\Facades\Route;

// user Authentification 

Route::group(['prefix' => 'auth', 'middleware' => 'throttle:10,1'], function () {
    Route::post('login', [AuthController::class, 'login']);
});

// user Operations with Sanctum

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);
});