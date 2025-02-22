<?php

use App\Enums\RolesEnum;
use Illuminate\Support\Facades\Route;

$instructor = RolesEnum::INSTRUCTOR->value;
Route::group(['middleware' => ["role:$instructor", 'auth:sanctum']], function () {
    //define instructor routes
});
