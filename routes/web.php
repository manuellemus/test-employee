<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'EmpleadoController@index')->name('empleado.index')->middleware('auth');

Route::post('/post', 'EmpleadoController@search')->name('empleado.search')->middleware('auth');

Route::resource('empleado', 'EmpleadoController')
->middleware('auth')
->except(['show', 'index','create','edit']);
