<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiasDisponiblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dias_disponibles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('dia');
            $table->time('hora_inicio');
            $table->time('hora_termino');
            $table->json('pausas')->nullable();
            $table->tinyInteger('activo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dias_disponibles');
    }
}
