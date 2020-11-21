<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    public $timestamps = false;
    protected $table = "colores";

    protected $fillable = [
        'id',
        'nombre',
        'borrado',
    ];

    public function __toString()
    {
        return $this->nombre;
    }

    public function productos(){
        return $this->hasMany('App\Producto');
    }
}
