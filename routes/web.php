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

Route::get('/home', 'AccountController@index')->name('home');
Route::get('/home/{account}', 'AccountController@show')->name('home.account');
Route::post('/send', 'TransferController@store')->name('send');
Route::post('/create', 'AccountController@store')->name('create');
