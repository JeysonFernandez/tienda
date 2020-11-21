<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    public $timestamps = false;
    protected $table = "tipos";

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
