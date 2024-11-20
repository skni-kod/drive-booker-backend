<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\GoogleAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/courses', CourseController::class)->except('update');

Route::get('auth/google/redirect', [GoogleAuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
