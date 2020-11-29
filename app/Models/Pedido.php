<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public $timestamps = false;
    protected $table = "pedidos";

    const EXPRESS = 1;
    const NORMAL = 2;


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
        return $this->belongsTo('App\Models\Usuario');
    }

    public function productos(){
        return $this->belongsToMany('App\Models\Producto')
            ->withPivot('cantidad_producto','valor_total');
    }
}
