<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
Route::group(['middleware'=>'auth'], function(){
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
});
