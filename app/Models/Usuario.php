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

    const ADELANTADO = 1;
    const AL_DIA = 2;
    const MOROSO = 3;




    public function getEstadoAttribute()
    {
        switch ($this->estado_calidad){
            case 1:
                return 'Adelantado';
            break;
            case 2:
                return 'Al Día';
            break;
            default:
                return 'Moroso';

        }
    }



    public function compras(){
        return $this->hasMany('App\Models\Compra');
    }

    public function pedidos(){
        return $this->hasMany('App\Models\Pedido');
    }
    public function nusuarios(){
        return $this->hasMany('App\Models\NotificacionUsuario');
    }
}
