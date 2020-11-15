<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaNotificacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacion_usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('mensaje')->nullable();
            $table->tinyInteger('borrado')->nullable();
            $table->tinyInteger('click')->nullable();
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
        Schema::dropIfExists('notificacion_usuarios');
    }
}
