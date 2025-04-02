<?php

use App\Enums\RolesEnum;
use App\Http\Controllers\InstructorAvailabilityController;
use App\Http\Controllers\InstructorDriverController;
use App\Http\Controllers\InstructorEventController;
use Illuminate\Support\Facades\Route;

$instructor = RolesEnum::INSTRUCTOR->value;
Route::group(['prefix' => 'instructor', 'middleware' => ['auth:sanctum', 'role:instructor']], function () {
    //define instructor routes
    Route::apiResource('events', InstructorEventController::class);
    Route::apiResource('drivers', InstructorDriverController::class)->only(['index']);
    Route::apiResource('availability', InstructorAvailabilityController::class)->only(['index', 'store']);

});
