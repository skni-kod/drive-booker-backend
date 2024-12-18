<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CreditCardController;
use App\Http\Controllers\GoogleAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('user/{user}', 'show');
        Route::put('user/{user}', 'update');
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(CreditCardController::class)->group(function () {
        Route::get('user/{user}/credit-card', 'show');
        Route::put('user/{user}/credit-card', 'update');
    });
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/courses', CourseController::class)->except('update');

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::get('/google/redirect', [GoogleAuthController::class, 'redirectToGoogle']);
Route::get('/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
