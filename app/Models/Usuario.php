<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticable
{
    use Notifiable;
    public $timestamps = false;
    protected $table = "usuarios";

    protected $fillable = [
        'id',
        'nombre',
        'primer_apellido',
        'segundo_apellido',
        'email',
        'password',
        'tipo',
        'estado_calidad',
        'sexo',
        'direccion',
        'conocido',
        'deuda_total',
    ];








    public function compras(){
        return $this->hasMany('App\Compra');
    }

    public function pedidos(){
        return $this->hasMany('App\Pedido');
    }
    public function nusuarios(){
        return $this->hasMany('App\NotificacionUsuario');
    }
}
