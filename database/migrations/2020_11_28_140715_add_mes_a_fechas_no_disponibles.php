<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMesAFechasNoDisponibles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fechas_no_disponibles', function (Blueprint $table) {

            $table->tinyInteger('mes')->unsigned();


        });
}

        /**
         * Reverse the migrations.
         *
         * @return void
         */
    public function down()
    {

        Schema::table('fechas_no_disponibles',function(Blueprint $table){
            $table->dropColumn('mes');
        });
    }
}
