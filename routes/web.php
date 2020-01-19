<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('users')->middleware('auth')->group(function(){
    Route::post('/store', 'UsersController@store')->name('store');
    Route::post('/edit/{id}', 'UsersController@update')->name('edit');
    Route::post('/delete/{id}', 'UsersController@destroy')->name('delete');
    Route::POST('/home', 'HomeController@index')->name('search');
});
