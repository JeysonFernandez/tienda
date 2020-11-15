<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    public $timestamps = false;
    protected $table = "marcas";

    public function productos(){
        return $this->hasMany('App\Producto');
    }
}
