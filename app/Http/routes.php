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

Route::get('/', function () {
    return view('welcome');
});

Route::get('logout', function(){

	session()->forget('user');
	return redirect('/');

});

//rutas del admin
Route::controller('admin/login', 'Admin\LoginController');
Route::get('admin/home', 'Admin\HomeController@index');
Route::resource('admin/decanos', 'Admin\DecanosController', ['except' => ['show', 'edit', 'update']]);
Route::resource('admin/comites', 'Admin\ComitesController', ['except' => ['show', 'edit', 'update']]);



/*// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');*/