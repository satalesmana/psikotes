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


Route::get('/user', function (Request $request) { return session()->all(); });

Route::resource('soalmbti', 'Api\MbtiController')->only(['index', 'store','destroy','edit','update']);
Route::resource('dimensi', 'Api\DimensiController')->only(['index', 'store','destroy','edit','update']);
Route::resource('mapingdimensi', 'Api\DimensiMapingController')->only(['index','store','destroy','edit']);