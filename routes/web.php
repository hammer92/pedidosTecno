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


Auth::routes();

Route::get('/home', 'HomeController@index')->middleware('guest');

Route::get('/', 'HomeController@indexCliente')->middleware('guest');

Route::resource('categorias', 'CategoriaController')->middleware('guest');

Route::resource('productos', 'ProductoController')->middleware('guest');

Route::resource('ordens', 'OrdenController')->middleware('guest');

Route::get('ordens/{id}/pdf', 'OrdenController@pdf')->name('ordens.pdf')->middleware('guest');

Route::resource('ordenDetalles', 'OrdenDetalleController')->middleware('guest');