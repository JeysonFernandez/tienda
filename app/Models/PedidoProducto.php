<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoProducto extends Model
{
    public $timestamps = false;
    protected $table = "pedido_producto";

    public function productos(){
        return $this->belongsTo('App\Producto');
    }
    public function pedidos(){
        return $this->belongsTo('App\Pedido');
    }
}
