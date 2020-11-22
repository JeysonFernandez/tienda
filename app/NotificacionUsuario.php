<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificacionUsuario extends Model
{
    public $timestamps = false;
    protected $table = "notificacions";

    public function usuario(){
    return $this->belongsTo('App\Usuario');
    }
    public function productos(){
    return $this->belongsToMany('App\Producto','notificacion_producto','id','producto_id')
        ->withPivot('mensaje','fecha_creacion','tipo');
    }
   
}
