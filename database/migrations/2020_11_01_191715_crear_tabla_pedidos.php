<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaPedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('lugar_visita')->nullable();
            $table->dateTime('fecha_hora')->nullable();
            $table->tinyInteger('estado')->nullable();
            $table->tinyInteger('tipo')->nullable();
            $table->timestamps();

            $table->bigInteger('usuario_id')->unsigned();


            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
