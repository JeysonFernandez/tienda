<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificacionProducto extends Model
{
    public $timestamps = false;
    protected $table = "notificacion_producto";

    public function productos(){
        return $this->belongsTo('App\Producto','productos_id');
    }
    
    
}
