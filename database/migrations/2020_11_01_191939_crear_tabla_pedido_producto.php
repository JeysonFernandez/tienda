<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaPedidoProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_producto', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('cantidad')->nullable();
            $table->integer('costo')->nullable();
            $table->bigInteger('pedido_id')->unsigned();
            $table->bigInteger('producto_id')->unsigned();

            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::dropIfExists('pedido_producto');
    }
}
