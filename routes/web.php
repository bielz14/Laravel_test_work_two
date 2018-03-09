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

Route::get('/', 'ConsumerController@index')->name('home');

Auth::routes();

Route::patch('/update', 'ConsumerController@update')->name('update');

Route::post('/delete', 'ConsumerController@destroy')->name('delete');

Route::resource('consumer','ConsumerController');

Route::get('/editpassword/{id}', 'ConsumerController@editPassword')->name('editPassword');

Route::patch('/updatepassword/{id}', 'ConsumerController@updatePassword')->name('updatePassword');
