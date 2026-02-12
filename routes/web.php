<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

//-- Public --//

Route::view('/','welcome')->name('welcome');

Route::get('/login',[AuthController::class,'showLogin'])->name('login');
Route::post('/login',[AuthController::class,'login']);

Route::get('/register',[AuthController::class,'showRegister'])->name('register.form');
Route::post('/register',[AuthController::class,'register'])->name('register');

//-- Authenticated users --//

Route::middleware('auth')->group(function(){
    Route::get('/dashboard',[ProfileController::class,'dashboard'])->name('dashboard');
    Route::get('/profile',[ProfileController::class,'profile'])->name('profile');
    Route::get('/profilEdit',[ProfileController::class,'profilEdit'])->name('profilEdit');
    Route::put('/profileUpdate',[ProfileController::class,'profileUpdate'])->name('profileUpdate');

});

// Admin only
Route::middleware(['auth','admin'])->group(function () {
    Route::resource('users', UserController::class);
    route::get('/users/export/csv',[UserController::class,'exportCsv'])->name('users.export.csv');
    route::get('/users/export/pdf',[UserController::class,'exportPdf'])->name('users.export.pdf');
});

Route::post('/logout', [AuthController::class,'logout'])
    ->name('logout')
    ->middleware('auth');


