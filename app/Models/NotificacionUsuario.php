<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificacionUsuario extends Model
{
    public $timestamps = false;
    protected $table = "notificacion_usuarios";

    public function usuario(){
    return $this->belongsTo('App\Models\Usuario');
    }
    public function productos(){
    return $this->belongsToMany('App\Models\Producto','notificacion_productos','id','producto_id')
        ->withPivot('mensaje','fecha_creacion','tipo');
    }

}
