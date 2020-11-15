<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaCompras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->integer('deuda_total')->nullable();
            $table->integer('deuda_pendiente')->nullable();
            $table->dateTime('fecha_siguiente_pago')->nullable();
            $table->dateTime('fecha_compra')->nullable();
            $table->tinyInteger('estado')->nullable();
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
        Schema::dropIfExists('compras');
    }
}
