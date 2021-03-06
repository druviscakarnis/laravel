<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/','table_controller@show')->name('table');
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/authCheck','login_controller@checkAuth')->name('authCheck');
Route::get('/register','reg_controller@addUser')->name('register');
Route::get('/login', function(){
    return view ('login');
}) ->name('login');

Route::get('/login_f', function(){
    return view ('login_f');
}) ->name('login_f');
