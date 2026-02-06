<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login',[AuthController::class,'showLogin'])->name('login');
Route::post('/login',[AuthController::class,'login']);

Route::get('/register',[AuthController::class,'showRegister']);
Route::post('/register',[AuthController::class,'register'])->name('register'); // ⭐ IMPORTANT

Route::get('/logout',[AuthController::class,'logout'])->name('logout');

Route::middleware('auth')->group(function(){
    Route::get('/dashboard',[HomeController::class,'dashboard']);
    Route::resource('/users',UserController::class);    
});


Route::middleware(['user','admin'])->group(function () {
    Route::resource('/users', UserController::class);
});

Route::get('/data',[UserController::class,'index']);