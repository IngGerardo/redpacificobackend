<?php

namespace App\Http\Controllers;
use App\Http\Models\ProductosModel as productos;
use Illuminate\Http\Request;
use DB;

class ProductosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
    * Regresa todos los productos que esten en el catalogo de la empresa.
    *
    * @author Gerardo Ortiz
    * @return object incluye todos los productos.
    */
    public function cargarProductos(Request $request) {
        $respuesta = productos::paginate($request->get('itemsPerPage'), ['*'], 'page', $request->get('currentPage'));
        return response()->json(array("response" => $respuesta));
    }

    /**
    * Regresa el producto seleccionado en el sistema por su ID
    *
    * @author Gerardo Ortiz
    * @return object objeto con la informacion del producto.
    * @param integer $id identificador unico del producto
    */
    public function cargarProducto($id) {
        $respuesta = productos::findOrFail($id);
        return response()->json(array("response" => $respuesta));
    }

    /**
    * Inserta un nuevo producto en el catalogo de productos.
    *
    * @author Gerardo Ortiz
    * @return boolean verdadero si la insercion se completo con éxito.
    * @param object $request variable con todos los datos del nuevo producto.
    */
    public function agregarProducto(Request $request) {
        $producto = new productos;
        $producto->des_producto = $request->des_producto;
        $producto->des_modelo = $request->des_modelo;
        $producto->num_precio = $request->num_precio;
        $producto->num_existencia = $request->num_existencia;
        $respuesta = $producto->save();
        return response()->json(array("response" => $respuesta));
    }

    /**
    * Actualiza un producto en el catalogo de productos.
    *
    * @author Gerardo Ortiz
    * @return boolean verdadero si la actualizacion se completo con éxito.
    * @param integer $id identificador unico del producto.
    * @param object $request variable con todos los datos del producto a actualizar.
    */
    public function actualizarProducto($id, Request $request) {
        $producto = productos::findOrFail($id);
        $producto->des_producto = $request->des_producto;
        $producto->des_modelo = $request->des_modelo;
        $producto->num_precio = $request->num_precio;
        $producto->num_existencia = $request->num_existencia;
        $respuesta = $producto->save();
        return response()->json(array("response" => $respuesta));
    }

    /**
    * Eliminar un producto en el catalogo de productos.
    *
    * @author Gerardo Ortiz
    * @return boolean verdadero si la eliminacion se completo con éxito.
    * @param integer $id identificador unico del producto.
    */
    public function eliminarProducto($id) {
        $producto = productos::findOrFail($id);
        $respuesta = $producto->delete();
        return response()->json(array("response" => $respuesta));
    }
}
