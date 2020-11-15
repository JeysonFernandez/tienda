<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public $timestamps = false;
    protected $table = "pedidos";
    public function pedidoproducto(){
        return $this->hasMany('App\PedidoProducto');
    }
    public function usuarios(){
        return $this->belongsTo('App\Usuario');
    }

    public function productos(){
        return $this->belongsToMany('App\Producto')
            ->withPivot('cantidad_producto','valor_total');
    }
}
