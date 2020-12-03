<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public $timestamps = false;
    protected $table = "pedidos";

    const EXPRESS = 2;
    const NORMAL = 1;

    const Pendiente = 1;
    const Cancelado = 2;
    const Entregado = 3;
    const Comprado  = 4;


    public function estado()
    {
        if($this->estado == Pedido::Pendiente){return 'Pendiente';}
        if($this->estado == Pedido::Cancelado){return 'Cancelado';}
        if($this->estado == Pedido::Entregado){return 'Entregado';}
        if($this->estado == Pedido::Comprado){return 'Comprado';}
    }

    public function getTipoPedidoAttribute()
    {
        switch ($this->tipo){
            case 1:
                return 'Completo';
            break;
            case 2;
                return 'Express';
            break;
        }
    }


    public function pedidoproducto(){
        return $this->hasMany('App\Models\PedidoProducto');
    }
    public function usuarios(){
        return $this->belongsTo('App\Models\Usuario','usuario_id','id');
    }

    public function productos(){
        return $this->belongsToMany('App\Models\Producto')
            ->withPivot('cantidad_producto','valor_total');
    }
}
