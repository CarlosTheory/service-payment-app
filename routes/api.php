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

// <<<<ROUTES FOR USERS>>>>
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
// <<<<END OF ROUTES FOR USERS>>>>


// <<<<ROUTES FOR BUSINESSES>>>>
// Mostrar negocios
Route::get('/businesses', 'BusinessController@index');

// Mostrar solo un negocio
Route::get('/business/{id}', 'BusinessController@show');

// Registrar Negocio
Route::post('/business/new', 'BusinessController@store');

// Eliminar Negocio
Route::delete('/business/{id}', 'BusinessController@destroy');

// Modificar Negocio
Route::put('/business/{id}', 'BusinessController@update');
// <<<<END OF ROUTES FOR BUSINESSES>>>>

Route::get('/products', 'ProductController@index');
Route::post('/business/{id}/product/new', 'ProductController@store');