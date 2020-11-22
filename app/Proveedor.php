<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    public $timestamps = false;
    protected $table = "proveedor";

    public function productos(){
        return $this->hasMany('App\Producto');
    }
}
