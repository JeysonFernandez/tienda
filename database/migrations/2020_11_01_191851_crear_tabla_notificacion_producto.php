<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaNotificacionProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacion_productos', function (Blueprint $table) {
            $table->id();
            $table->string('mensaje')->nullable();
            $table->tinyInteger('borrado')->nullable();
            $table->tinyInteger('click')->nullable();
            $table->timestamps();

            $table->bigInteger('producto_id')->unsigned();

            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notificacion_productos');
    }
}
