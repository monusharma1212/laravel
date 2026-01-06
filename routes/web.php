<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [UserController::class,'showData']);
Route::get('/user/{id}', [UserController::class,'singleUser'])->name('view.user');
Route::get('/add', [UserController::class,'addUser']);
Route::get('/update', [UserController::class,'updateUser']);
