<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiasDisponibles extends Model
{
    public $timestamps = false;
    protected $table = "dias_disponibles";

    public function getHoraInicioAttribute()
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $this->attributes['hora_inicio']);
    }

    public function getHoraTerminoAttribute()
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $this->attributes['hora_termino']);
    }
}
