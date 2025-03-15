<?php

use App\Enums\RolesEnum;
use App\Http\Controllers\AdminEventController;
use Illuminate\Support\Facades\Route;

$admin = RolesEnum::OWNER->value;
Route::group(['prefix' => 'admin', 'middleware' => ['auth:sanctum', 'role:owner']], function () {
    //define admin/owner routes
    Route::controller(AdminEventController::class)->group(function () {
        Route::get('events/pending', 'getPendingEvents');
        Route::get('events/stream', 'streamPendingEvents')->middleware('stream.cors');
        Route::post('events/{id}/accept', 'acceptEvent');
        Route::post('events/{id}/reject', 'rejectEvent');
    });
});
