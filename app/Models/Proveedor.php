<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    public $timestamps = false;
    protected $table = "proveedores";

    protected $fillable = [
        'id',
        'nombre',
        'direccion',
        'descripcion',
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
