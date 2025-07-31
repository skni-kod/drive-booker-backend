<?php

use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseRegistration\AdminCourseRegistrationController;
use App\Http\Controllers\CourseRegistration\GuestCourseRegistrationController;
use App\Http\Controllers\CreditCardController;
use App\Http\Controllers\GoogleAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('user/{user}', 'show');
        Route::put('user/{user}', 'update');
        Route::put('user/profile', 'fillProfile');
    });

    Route::controller(CreditCardController::class)->group(function () {
        Route::get('user/{user}/credit-card', 'show');
        Route::put('user/{user}/credit-card', 'update');
    });
});

Route::middleware(['auth:sanctum', 'role:owner'])->group(function () {
    Route::controller(AdminStudentController::class)->group(function () {
        Route::get('admin/students', 'index');
    });

    Route::controller(AdminCourseRegistrationController::class)->group(function () {
        Route::get('admin/course_registrations', 'index');
    });

    Route::controller(AdminCourseRegistrationController::class)->group(function () {
        Route::post('admin/course_registrations/{courseRegistration}/accept', 'accept');
        Route::post('admin/course_registrations/{courseRegistration}/decline', 'decline');
    });
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/course-locations', [CourseController::class, 'locations']);

// Student Course Registrations
Route::controller(GuestCourseRegistrationController::class)->group(function () {
    Route::post('courses/{course}/registrations', 'store');
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/google/redirect', [GoogleAuthController::class, 'redirectToGoogle']);
Route::get('/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
