<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    public $timestamps = false;
    protected $table = "pagos";

    const Retrasado = 1;
    const Adelantada = 2;
    const Tiempo = 3;

    public function scopeCompra($query)
    {
        return $query->compras();
    }

    public function estados()
    {
        if($this->estado == Pago::Retrasado){return 'Retrasado';}
        if($this->estado == Pago::Adelantada){return 'Adelantada';}
        if($this->estado == Pago::Tiempo){return 'A Tiempo';}
    }

    public function compras(){
        return $this->belongsTo('App\Models\Compra','compra_id','id');
    }
}
