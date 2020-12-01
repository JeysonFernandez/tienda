<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompraProducto extends Model
{
    public $timestamps = false;
    protected $table = "compra_producto";

    protected $fillable = [
        'id',
        'cantidad',
        'costo',
        'producto_id',
        'compra_id'
    ];

    public function productos(){
        return $this->belongsTo('App\Models\Producto','producto_id','id');
    }
    public function compras(){
        return $this->belongsTo('App\Compra');
    }
}
