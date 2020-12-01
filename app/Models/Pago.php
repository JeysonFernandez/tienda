<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    public $timestamps = false;
    protected $table = "pagos";
    public function compras(){
        return $this->belongsTo('App\Models\Compra','compra_id','id');
    }
}
//hola jeyson
