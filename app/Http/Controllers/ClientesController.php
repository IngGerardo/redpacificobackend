<?php

namespace App\Http\Controllers;
use App\Http\Models\ClientesModel as clientes;
use Illuminate\Http\Request;
use DB;

class ClientesController extends Controller
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
    * Regresa todos los clientes que esten en el catalogo de la empresa.
    *
    * @author Gerardo Ortiz
    * @return object incluye todos los clientes.
    */
    public function cargarClientes(Request $request) {
        $respuesta = clientes::paginate($request->get('itemsPerPage'), ['*'], 'page', $request->get('currentPage'));
        return response()->json(array("response" => $respuesta));
    }

    /**
    * Regresa el cliente seleccionado en el sistema por su ID
    *
    * @author Gerardo Ortiz
    * @return object objeto con la informacion del cliente.
    * @param integer $id identificador unico del cliente
    */
    public function cargarCliente($id) {
        $respuesta = clientes::findOrFail($id);
        return response()->json(array("response" => $respuesta));
    }

    /**
    * Inserta un nuevo cliente en el catalogo de clientes.
    *
    * @author Gerardo Ortiz
    * @return boolean verdadero si la insercion se completo con éxito.
    * @param object $request variable con todos los datos del nuevo cliente.
    */
    public function agregarCliente(Request $request) {
        $cliente = new clientes;
        $cliente->nom_cliente = $request->nom_cliente;
        $cliente->des_apellidopaterno = $request->des_apellidopaterno;
        $cliente->des_apellidomaterno = $request->des_apellidomaterno;
        $cliente->des_rfc = $request->des_rfc;
        $respuesta = $cliente->save();
        return response()->json(array("response" => $respuesta));
    }

    /**
    * Actualiza un cliente en el catalogo de clientes.
    *
    * @author Gerardo Ortiz
    * @return boolean verdadero si la actualizacion se completo con éxito.
    * @param integer $id identificador unico del cliente.
    * @param object $request variable con todos los datos del cliente a actualizar.
    */
    public function actualizarCliente($id, Request $request) {
        $cliente = clientes::findOrFail($id);
        $cliente->nom_cliente = $request->nom_cliente;
        $cliente->des_apellidopaterno = $request->des_apellidopaterno;
        $cliente->des_apellidomaterno = $request->des_apellidomaterno;
        $cliente->des_rfc = $request->des_rfc;
        $respuesta = $cliente->save();
        return response()->json(array("response" => $respuesta));
    }

    /**
    * Eliminar un cliente en el catalogo de clientes.
    *
    * @author Gerardo Ortiz
    * @return boolean verdadero si la eliminacion se completo con éxito.
    * @param integer $id identificador unico del cliente.
    */
    public function eliminarCliente($id) {
        $cliente = clientes::findOrFail($id);
        $respuesta = $cliente->delete();
        return response()->json(array("response" => $respuesta));
    }
}
