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

Route::get('/', 'WelcomeController@index');
Route::get('/search', 'ResultadosController@index');
Route::get('/proyecto/{tesis}', 'ResultadosController@show');

Route::get('logout', function(){

	session()->forget('user');
	return redirect('/');

});

//rutas del admin
Route::controller('admin/login', 'Admin\LoginController');
Route::get('admin/home', 'Admin\HomeController@index');
Route::resource('admin/decanos', 'Admin\DecanosController', ['except' => ['show', 'edit', 'update']]);
Route::resource('admin/comites', 'Admin\ComitesController', ['except' => ['show', 'edit', 'update']]);

//rutas del estudiante
Route::controller('estudiante/login', 'Estudiante\LoginController');
Route::get('estudiante/home', 'Estudiante\HomeController@index');
route::get('estudiante/tesis', 'Estudiante\TesisController@index');
Route::get('estudiante/tesis/create', 'Estudiante\TesisController@create');
Route::post('estudiante/tesis', 'Estudiante\TesisController@store');
Route::get('comite/tesis/{tesis}', 'Estudiante\TesisController@show');

//rutas del decano
Route::controller('decano/login', 'Decano\LoginController');
Route::get('decano/home', 'Decano\HomeController@index');
Route::resource('decano/areas', 'Decano\AreasController', ['except' => 'show']);
Route::resource('decano/lineas', 'Decano\LineasController');
Route::resource('decano/reportes', 'Decano\ReportesController');

//rutas del comite
Route::controller('comite/login', 'Comite\LoginController');
Route::get('comite/home', 'Comite\HomeController@index');
Route::get('comite/tesis', 'Comite\TesisController@index');
Route::get('comite/tesis/{tesis}', 'Comite\TesisController@show');
Route::get('comite/tesis/{tesis}/edit', 'Comite\TesisController@edit');
Route::put('comite/tesis/{tesis}', 'Comite\TesisController@update');

/*// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');*/