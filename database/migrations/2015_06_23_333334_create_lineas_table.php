<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLineasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lineas', function(Blueprint $table){

            $table->increments('id');
            $table->integer('area_id')->unsigned();
            $table->string('linea');

            $table->foreign('area_id')
                  ->references('id')->on('areas')
                  ->onDelete('restrict')
                  ->onUpdate('no action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
