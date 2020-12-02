<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    public $timestamps = false;
    protected $table = "compras";




    public function usuario(){
        return $this->belongsTo('App\Models\Usuario','usuario_id','id');
    }
    public function compraproducto(){
        return $this->hasMany('App\Models\CompraProducto');
    }
    public function pagos(){
        return $this->hasMany('App\Models\Pago','compra_id','id');
    }
    public function productos(){
        return $this->belongsToMany('App\Models\Producto')
        ->withPivot('cantidad','costo');
    }


}
