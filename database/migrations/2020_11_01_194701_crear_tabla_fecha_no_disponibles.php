<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaFechaNoDisponibles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fechas_no_disponibles', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_hora')->nullable();
            $table->integer('duracion')->nullable();
            $table->tinyInteger('tipo')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fechas_no_disponibles');
    }
}
