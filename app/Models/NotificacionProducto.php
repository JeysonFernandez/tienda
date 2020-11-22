<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificacionProducto extends Model
{
    public $timestamps = false;
    protected $table = "notificacion_productos";

    public function productos(){
        return $this->belongsTo('App\Producto','producto_id');
    }


}
