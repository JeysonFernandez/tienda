<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    public $timestamps = false;
    protected $table = "compras";

    public function usuario(){
        return $this->belongsTo('App\Usuario');
    }
    public function compraproducto(){
        return $this->hasMany('App\CompraProducto');
    }
    public function pagos(){
        return $this->hasMany('App\Pago');
    }
    public function productos(){
        return $this->belongsToMany('App\Producto')
        ->withPivot('cantidad_producto','costo_total');
    }


}
