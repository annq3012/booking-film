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
Route::group(['namespace'=>'Admin', 'prefix'=>'admin', 'middleware'=>'admin'], function() {
	Route::get('/', 'AdminController@index')->name('admin.index');
	Route::resource('users', 'UserController');
	Route::resource('/users', 'UserController');
	Route::resource('/rooms', 'RoomController');
	Route::put('/users/{user}/role', 'UserController@updateRole')->name('users.updateRole');
	Route::resource('/cities', 'CityController');
	Route::resource('/films', 'FilmController');
	Route::put('/films/{film}/status', 'FilmController@updateStatus')->name('films.updateStatus');
});

Auth::routes();

