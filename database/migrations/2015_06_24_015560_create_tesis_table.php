<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tesis', function(Blueprint $table){

            $table->increments('id');
            $table->string('titulo');
            $table->string('area_inst');
            $table->string('linea_inve');
            $table->integer('cod_prog_ryca');
            $table->integer('director_cod_user_ryca')->nullable();
            $table->integer('tipo_id')->unsigned();
            $table->integer('estado_id')->unsigned();
            $table->string('source');
            $table->timestamps();

            $table->foreign('tipo_id')
                  ->references('id')->on('tipos')
                  ->onDelete('restrict')
                  ->onUpdate('no action');

            $table->foreign('estado_id')
                  ->references('id')->on('estados')
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
        Schema::drop('tesis');
    }
}
