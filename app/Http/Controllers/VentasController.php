<?php

namespace App\Http\Controllers;
use App\Http\Models\ClientesModel as clientes;
use App\Http\Models\ProductosModel as productos;
use App\Http\Models\VentasModel as ventas;
use App\Http\Models\ConfiguracionModel as configuracion;
use Illuminate\Http\Request;
use DB;

class VentasController extends Controller
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
    * Regresa todas las ventas que le pertenecen a un cliente en el catalogo de la empresa.
    *
    * @author Gerardo Ortiz
    * @param integer $id identificador unico del cliente.
    * @return object incluye todas las ventas de un cliente.
    */
    public function consultarVentas($id, Request $request) {

        $configuracion = configuracion::firstOrFail();

        $respuesta = ventas::where('idu_cliente', '=', $id)
        ->join('cat_productos', 'cat_productos.idu_producto', '=', 'ctl_ventas.idu_producto')
        ->select('cat_productos.des_producto','cat_productos.des_modelo','cat_productos.num_precio',
        'ctl_ventas.num_cantidad' ,'ctl_ventas.idu_venta')
        ->paginate($request->get('itemsPerPage'), ['*'], 'page', $request->get('currentPage'));

        $ventastotales = ventas::where('idu_cliente', '=', $id)
        ->join('cat_productos', 'cat_productos.idu_producto', '=', 'ctl_ventas.idu_producto')
        ->select('cat_productos.des_producto','cat_productos.des_modelo','cat_productos.num_precio',
        'ctl_ventas.num_cantidad' ,'ctl_ventas.idu_venta')
        ->get();

        $importe = 0;
        foreach ($ventastotales as $venta) {
            $venta->num_precio = $venta->num_precio * 
            ($venta->num_cantidad + ($configuracion->num_tasa * $configuracion->num_plazo)/100);
            $importe = $importe + ($venta->num_precio * $venta->num_cantidad);
        }

        foreach ($respuesta as $response) {
            $response->num_precio = $response->num_precio * 
            ($response->num_cantidad + ($configuracion->num_tasa * $configuracion->num_plazo)/100);
        }
        
        $enganche = ($configuracion->num_enganche/100) * $importe;
        $bonificacion = $enganche * (($configuracion->num_tasa * $configuracion->num_plazo) /100);
        $total = $importe - $enganche - $bonificacion;

        $ventasGenerales = new \stdClass();
        $ventasGenerales->enganche = $enganche;
        $ventasGenerales->bonificacion = $bonificacion;
        $ventasGenerales->total = $total;
        return response()->json(array("response" => $respuesta, "ventasGenerales" => $ventasGenerales));
    }

    /**
    * Regresa todos los clientes que esten en el catalogo de la empresa.
    *
    * @author Gerardo Ortiz
    * @return object incluye todos los clientes.
    */
    public function cargarClientes() {
        $respuesta = clientes::all();
        return response()->json(array("response" => $respuesta));
    }

    /**
    * Regresa todos los productos que esten en el catalogo de la empresa.
    *
    * @author Gerardo Ortiz
    * @return object incluye todos los productos.
    */
    public function cargarProductos() {
        $respuesta = productos::all();
        return response()->json(array("response" => $respuesta));
    }

    /**
    * Inserta una nueva venta en el catalogo de clientes.
    *
    * @author Gerardo Ortiz
    * @return boolean verdadero si la insercion se completo con éxito.
    * @param object $request variable con todos los datos de la nueva venta.
    */
    public function agregarVenta(Request $request) {
        $venta = new ventas;
        $venta->idu_producto = $request->idu_producto;
        $venta->idu_cliente = $request->idu_cliente;
        $venta->num_cantidad = $request->num_cantidad;
        $respuesta = $venta->save();

        if ($respuesta) {
            $producto = productos::findOrFail($venta->idu_producto);
            $producto->num_existencia = $producto->num_existencia - $venta->num_cantidad;
            $respuesta = $producto->save();
        }
        return response()->json(array("response" => $respuesta));
    }

    /**
    * Eliminar una venta en el catalogo de ventas.
    *
    * @author Gerardo Ortiz
    * @return boolean verdadero si la eliminacion se completo con éxito.
    * @param integer $id identificador unico de la venta.
    */
    public function eliminarVenta($id) {
        $venta = ventas::findOrFail($id);
        $respuesta = $venta->delete();

        if ($respuesta) {
            $producto = productos::findOrFail($venta->idu_producto);
            $producto->num_existencia = $producto->num_existencia + $venta->num_cantidad;
            $respuesta = $producto->save();
        }
        return response()->json(array("response" => $respuesta));
    }
}
