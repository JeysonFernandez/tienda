<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForaingKeyEnProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productos', function (Blueprint $table) {

            $table->bigInteger('tipo_id')->unsigned();
            $table->bigInteger('talla_id')->unsigned();
            $table->bigInteger('color_id')->unsigned();
            $table->bigInteger('genero_id')->unsigned();
            $table->bigInteger('categoria_id')->unsigned();
            $table->bigInteger('marca_id')->unsigned();
            $table->bigInteger('proveedor_id')->unsigned();


            $table->foreign('tipo_id')->references('id')->on('tipos')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('talla_id')->references('id')->on('tallas')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('color_id')->references('id')->on('colores')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('genero_id')->references('id')->on('generos')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('CASCADE')->onUpdate('CASCADE');

        });
}

        /**
         * Reverse the migrations.
         *
         * @return void
         */
    public function down()
    {
        Schema::dropIfExists('codigos_descuento');

        Schema::table('citas',function(Blueprint $table){
            $table->dropColumn('tipo_id');
            $table->dropColumn('talla_id');
            $table->dropColumn('color_id');
            $table->dropColumn('genero_id');
            $table->dropColumn('categoria_id');
            $table->dropColumn('marca_id');
            $table->dropColumn('proveedor_id');
        });
    }
}
