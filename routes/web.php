<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

// public resurces

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',[AuthController::class,'showLogin'])->name('login');
Route::post('/login',[AuthController::class,'login']);

Route::get('/register',[AuthController::class,'showRegister']);
Route::post('/register',[AuthController::class,'register'])->name('register');


// authenticate users
Route::middleware('auth')->group(function(){

    Route::get('/dashboard',[HomeController::class,'dashboard'])->name('dashboard');

    // USER PROFILE 
    Route::get('/profile',[UserController::class,'profile'])->name('profile');
    Route::put('/profile/update',[UserController::class,'updateProfile'])->name('profile.update');
    // see profile 
    Route::get('/profile/{id}', [UserController::class, 'profile'])->name('profile');
    

    // pages
    Route::view('/contact', 'pages.contact')->name('contact');
    Route::view('/home', 'pages.home')->name('home');
    Route::view('/location', 'pages.location')->name('location');
    Route::view('/about', 'pages.about')->name('about');
    Route::view('/product', 'pages.product')->name('product');
    Route::view('/userData', 'pages.user-list')->name('user-list');
    });

// admin 
Route::middleware(['auth','admin'])->group(function () {
    Route::resource('users', UserController::class);
});


Route::post('/logout', [AuthController::class,'logout'])->name('logout')->middleware('auth');



