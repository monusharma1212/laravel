<?php

use App\Http\Controllers\Api\UserApiController;
use Illuminate\Support\Facades\Route;

Route::post('/register',[UserApiController::class,'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/userlist',[UserApiController::class,'userlist']);
    Route::put('/user/{id}',[UserApiController::class,'view']);
});
