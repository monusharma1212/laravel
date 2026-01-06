<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(UserController::class)->group(function(){

    Route::get('/', 'showData')->name('home');
    Route::get('/user/{id}','singleUser')->name('view.user');
    Route::post('/add', 'addUser')->name('addUser');
    Route::get('/update', 'updateUser');
    Route::get('/updatepage/{id}', 'updateUser')->name('update.page');
    Route::get('/delete/{id}','userDelete');

});
Route::get('/addData',function(){
    return view('addUser');
});
