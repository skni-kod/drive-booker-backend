<?php

use App\Enums\RolesEnum;
use App\Http\Controllers\DriverAvailabilityController;
use App\Http\Controllers\DriverEventController;
use Illuminate\Support\Facades\Route;

$driver = RolesEnum::DRIVER->value;
Route::group(['prefix' => 'driver', 'middleware' => ['auth:sanctum', 'role:driver']], function () {
    //define driver routes
    Route::apiResource('events', DriverEventController::class)->only(['index', 'store']);
    Route::apiResource('events/available', DriverAvailabilityController::class)->only(['index']);
});
