<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    public $timestamps = false;
    protected $table = "colors";

    public function productos(){
        return $this->hasMany('App\Producto');
    }
}
