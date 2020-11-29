<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoProducto extends Model
{
    public $timestamps = false;
    protected $table = "pedido_producto";


    public function getMontoTotalAttribute()
    {
        return $this->sum('costo');
    }

    public function productos(){
        return $this->belongsTo('App\Models\Producto','producto_id','id');
    }
    public function pedidos(){
        return $this->belongsTo('App\Models\Pedido');
    }
}
