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

Route::middleware('api')->get('/movies', 'MovieController@index');

Route::middleware('api')->post('/movies', 'MovieController@store');

Route::middleware('api')->get('/movies/{id}', 'MovieController@show');

Route::middleware('api')->put('/movies/{id}', 'MovieController@update');

Route::middleware('api')->delete('/movies/{id}', 'MovieController@destroy');
