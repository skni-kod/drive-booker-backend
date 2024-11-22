<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/courses', CourseController::class)->except('update');

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);