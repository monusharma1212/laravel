<?php

use App\Http\Controllers\Api\UserApiController;

Route::get('/users', [UserApiController::class, 'index']);
Route::get('/users/{id}', [UserApiController::class, 'show']);
Route::post('/users', [UserApiController::class, 'store']);
Route::post('/users/{id}', [UserApiController::class, 'update']);
Route::delete('/users/{id}', [UserApiController::class, 'destroy']);