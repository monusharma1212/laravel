<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

// Public
Route::get('/', fn() => view('welcome'))->name('welcome');

Route::get('/login',[AuthController::class,'showLogin'])->name('login');
Route::post('/login',[AuthController::class,'login']);

Route::get('/register',[AuthController::class,'showRegister'])->name('register.form');
Route::post('/register',[AuthController::class,'register'])->name('register');

// Authenticated users
Route::middleware('auth')->group(function(){


    Route::get('/dashboard',[HomeController::class,'dashboard'])->name('dashboard');
    // Route::get('/profit', [HomeController:class,'profil'])->name('data');

    // Profile (self)
    Route::get('/profile',[UserController::class,'profile'])->name('profile');
    Route::get('/profilEdit',[UserController::class,'profilEdit'])->name('profilEdit');
    Route::put('/profileUpdate',[UserController::class,'profileUpdate'])->name('profileUpdate');

});

// Admin only
Route::middleware(['auth','admin'])->group(function () {
    Route::resource('users', UserController::class);
});

Route::post('/logout', [AuthController::class,'logout'])
    ->name('logout')
    ->middleware('auth');


