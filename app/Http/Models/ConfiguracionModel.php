<?php

namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionModel extends Model
{
    /**
    * Contiene el nombre de la tabla de configuración
    * @var string tabla de configuración 
    * @access protected
    */
    protected $table = 'ctl_configuracion';

    /**
    * Contiene la llave primaria que indetifica a la tabla
    * @var string tabla de configuración 
    * @access protected
    */
    protected $primaryKey = 'idu_configuracion';

    /**
    * Deshabilita las inserciones de fecha created_at y updated_at
    * @var boolean afecta a la tabla de configuración
    * @access public
    */
    public $timestamps = false;
}
