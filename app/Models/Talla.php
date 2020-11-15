<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    public $timestamps = false;
    protected $table = "tallas";

    public function productos(){
        return $this->hasMany('App\Producto');
    }
}
