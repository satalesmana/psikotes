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

<<<<<<< HEAD
//use Illuminate\Routing\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/soal_index','SoalController@index');

Route::get('/input','AingController@input');

Route::post('/proses','AingController@proses');
=======
Route::get('/', 'HomeController@index')->name('home');
>>>>>>> b4c37fc3af7f41cae4dedca1c011beb8f0516aa8
