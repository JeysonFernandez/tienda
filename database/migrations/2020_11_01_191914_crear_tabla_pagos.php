<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaPagos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->string('direccion')->nullable();
            $table->integer('monto')->nullable();
            $table->date('fecha')->nullable();
            $table->tinyInteger('estado')->nullable();
            $table->timestamps();

            $table->bigInteger('compra_id')->unsigned();

            $table->foreign('compra_id')->references('id')->on('compras')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
