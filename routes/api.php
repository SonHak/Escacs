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


//LOGEA AL USUARIO Y LE GENERA UN TOKEN
Route::post('/login','ControladorPrincipal@login');

//HACE UN LOGOUT AL USUARIO
Route::post('/logout','ControladorPrincipal@logout');


//DEVUELVE TODOS LOS USUARIOS
Route::post('/espera','ControladorPrincipal@espera');


Route::post('/juga','ControladorPrincipal@jugar');

Route::post('/mou','ControladorPrincipal@mover');
