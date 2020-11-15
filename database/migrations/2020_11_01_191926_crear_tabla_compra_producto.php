<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaCompraProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_producto', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('cantidad')->nullable();
            $table->integer('costo')->nullable();
            $table->bigInteger('compra_id')->unsigned();
            $table->bigInteger('producto_id')->unsigned();

            $table->foreign('compra_id')->references('id')->on('compras')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::dropIfExists('compra_producto');
    }
}
