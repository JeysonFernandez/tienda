<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('stock_critico')->nullable();
            $table->smallInteger('stock_actual')->nullable();
            $table->integer('precio_unidad')->nullable();
            $table->integer('costo_producto')->nullable();
            $table->string('imagen')->nullable();
            $table->tinyInteger('publicar')->nullable();
            $table->tinyInteger('borrado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
