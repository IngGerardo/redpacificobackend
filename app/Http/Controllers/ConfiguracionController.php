<?php

namespace App\Http\Controllers;
use App\Http\Models\ConfiguracionModel as configuracion;
use Illuminate\Http\Request;
use DB;

class ConfiguracionController extends Controller
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
    * Regresa todos las configuraciones que esten en el catalogo de la empresa.
    *
    * @author Gerardo Ortiz
    * @return object incluye todos los Configuracion.
    */
    public function cargarConfiguracion(Request $request) {
        $respuesta = configuracion::first();
        return response()->json(array("response" => $respuesta));
    }

    /**
    * Inserta la nueva configuración en el catalogo de la empresa.
    *
    * @author Gerardo Ortiz
    * @return boolean verdadero si la insercion se completo con éxito.
    * @param object $request variable con todos los datos de la nueva configuración.
    */
    public function agregarConfiguracion(Request $request) {
        $respuesta = false;

        if ($request->idu_configuracion == '') {
            $configuracion = new configuracion;
            $configuracion->num_tasa = $request->num_tasa;
            $configuracion->num_enganche = $request->num_enganche;
            $configuracion->num_plazo = $request->num_plazo;
            $respuesta = $configuracion->save();
        } else {
            $configuracion = configuracion::findOrFail($request->idu_configuracion);
            $configuracion->num_tasa = $request->num_tasa;
            $configuracion->num_enganche = $request->num_enganche;
            $configuracion->num_plazo = $request->num_plazo;
            $respuesta = $configuracion->save();
        }
        
        return response()->json(array("response" => $respuesta));
    }

}
