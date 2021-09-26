<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/* Clientes*/

$router->get('/clientes', 'ClientesController@cargarClientes');

$router->get('/clientes/{id:[0-9]+}', 'ClientesController@cargarCliente');

$router->post('/clientes', 'ClientesController@agregarCliente');

$router->put('/clientes/{id:[0-9]+}', 'ClientesController@actualizarCliente');

$router->delete('/clientes/{id:[0-9]+}', 'ClientesController@eliminarCliente');

/* Productos*/

$router->get('/productos', 'ProductosController@cargarProductos');

$router->get('/productos/{id:[0-9]+}', 'ProductosController@cargarProducto');

$router->post('/productos', 'ProductosController@agregarProducto');

$router->put('/productos/{id:[0-9]+}', 'ProductosController@actualizarProducto');

$router->delete('/productos/{id:[0-9]+}', 'ProductosController@eliminarProducto');
