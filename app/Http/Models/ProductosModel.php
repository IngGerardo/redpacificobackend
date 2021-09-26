<?php

namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;

class ProductosModel extends Model
{
    /**
    * Contiene el nombre de la tabla de productos
    * @var string tabla de productos 
    * @access protected
    */
    protected $table = 'cat_productos';

    /**
    * Contiene la llave primaria que indetifica a la tabla
    * @var string tabla de productos 
    * @access protected
    */
    protected $primaryKey = 'idu_producto';

    /**
    * Deshabilita las inserciones de fecha created_at y updated_at
    * @var boolean afecta a la tabla de productos
    * @access public
    */
    public $timestamps = false;
}
