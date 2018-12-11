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
     return view('auth/login');
    // return view('almacen.categoria.edit');
});

// Categorias

// Route::get('almacen/categoria', 'CategoriaController@index')->name('categoria');
// Route::get('almacen/categoria/create', 'CategoriaController@create')->name('crear_categoria');
// Route::get('almacen/categoria/{categorium}', 'CategoriaController@show')->name('mostrar_categoria');
// Route::get('almacen/categoria/{id}/editar', 'CategoriaController@edit')->name('editar_categoria');
// Route::post('almacen/categoria', 'CategoriaController@store')->name('guardar_categoria');
// Route::delete('almacen/categoria/{categorium}', 'CategoriaController@destroy')->name('borrar_categoria');
// Route::put('almacen/categoria/{categorium}', 'CategoriaController@update')->name('categoria.update');
// Fin Categorias


//articulos
Route::resource('almacen/articulo', 'ArticuloController');
// fin articulos

// categoria
Route::resource('almacen/categoria', 'CategoriaController');
// fin categoria

//ventas
Route::get('almacen/venta/filtro', 'VentasController@filtro_fechas');
Route::resource('almacen/venta', 'VentasController');
//fin ventas

// clientes
Route::resource('almacen/cliente', 'PersonaController');
// fin clientes

//proveedores
Route::resource('almacen/proveedor', 'ProveedorController');
// fin proveedores
Route::resource('almacen/ingreso', 'IngresoController');

// seguridad
Auth::routes();

//pagina de inicio
Route::get('/home', 'HomeController@index')->name('home');
