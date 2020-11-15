<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    public $timestamps = false;
    protected $table = "tipos";

    public function productos(){
        return $this->hasMany('App\Producto');
    }
}
