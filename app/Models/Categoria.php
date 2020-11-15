<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public $timestamps = false;
    protected $table = "categorias";

    public function productos(){
        return $this->hasMany('App\Producto');
    }
}
