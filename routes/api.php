<?php

use App\Http\Controllers\Api\UserApiController;
use Illuminate\Support\Facades\Route;

Route::post('/register',[UserApiController::class,'register']);

