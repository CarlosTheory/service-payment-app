<?php

use Illuminate\Http\Request;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Mostrar usuarios
Route::get('/users', 'UserController@index');

// Mostrar solo un usuario
Route::get('/user/{id}', 'UserController@show');

// Registrar Usuario
Route::post('/user/new', 'UserController@store');

// Eliminar Usuario
Route::delete('/user/{id}', 'UserController@destroy');

// Modificar Usuario
Route::put('/user/{id}', 'UserController@update');