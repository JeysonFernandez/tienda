<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaRey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rey', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad_vendida')->nullable();
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
        Schema::dropIfExists('rey');
    }
}
