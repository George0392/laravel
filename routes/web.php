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
    // return view('almacen.categoria.edit');
});

Route::resource('almacen/categoria', 'CategoriaController');
Route::resource('almacen/articulo', 'ArticuloController');
Route::resource('almacen/cliente', 'PersonaController');
Route::resource('almacen/proveedor', 'ProveedorController');
Route::resource('almacen/ingreso', 'IngresoController');
