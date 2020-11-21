<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    public $timestamps = false;
    protected $table = "proveedores";

    public function productos(){
        return $this->hasMany('App\Producto');
    }
}
