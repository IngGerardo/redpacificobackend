<?php

namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;

class VentasModel extends Model
{
    /**
    * Contiene el nombre de la tabla de ventas
    * @var string tabla de ventas 
    * @access protected
    */
    protected $table = 'ctl_ventas';

    /**
    * Contiene la llave primaria que indetifica a la tabla
    * @var string tabla de ventas 
    * @access protected
    */
    protected $primaryKey = 'idu_venta';

    /**
    * Deshabilita las inserciones de fecha created_at y updated_at
    * @var boolean afecta a la tabla de ventas
    * @access public
    */
    public $timestamps = false;
}
