<?php

use App\Enums\RolesEnum;
use Illuminate\Support\Facades\Route;

$driver = RolesEnum::DRIVER->value;
Route::group(['middleware' => ["role:$driver", 'auth:sanctum']], function () {
    //define driver routes
});
