<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    public $timestamps = false;
    protected $table = "compras";

    const Pendiente = 1;
    const Completado = 2;


    public function usuario(){
        return $this->belongsTo('App\Models\Usuario','usuario_id','id');
    }
    public function compraproducto(){
        return $this->hasMany('App\Models\CompraProducto','compra_id','id');
    }
    public function pagos(){
        return $this->hasMany('App\Models\Pago','compra_id','id');
    }
    public function productos(){
        return $this->belongsToMany('App\Models\Producto')
        ->withPivot('cantidad','costo');
    }


}
