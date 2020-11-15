<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    public $timestamps = false;
    protected $table = "generos";

    public function productos(){
        return $this->hasMany('App\Producto');
    }
}
