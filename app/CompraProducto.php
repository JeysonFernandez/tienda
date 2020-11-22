<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompraProducto extends Model
{
    public $timestamps = false;
    protected $table = "compra_producto";

    public function productos(){
        return $this->hasMany('App\Producto');
    }
    public function compras(){
        return $this->belongsTo('App\Compra');
    }
}
