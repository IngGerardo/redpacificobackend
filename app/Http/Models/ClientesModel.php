<?php

namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;

class ClientesModel extends Model
{
    /**
    * Contiene el nombre de la tabla de clientes
    * @var string tabla de clientes 
    * @access protected
    */
    protected $table = 'cat_clientes';

    /**
    * Contiene la llave primaria que indetifica a la tabla
    * @var string tabla de clientes 
    * @access protected
    */
    protected $primaryKey = 'idu_cliente';

    /**
    * Deshabilita las inserciones de fecha created_at y updated_at
    * @var boolean afecta a la tabla de clientes
    * @access public
    */
    public $timestamps = false;
}
