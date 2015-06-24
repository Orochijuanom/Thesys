<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisiones', function(Blueprint $table){

            $table->increments('id');
            $table->longText('revision');
            $table->integer('cod_user_ryca');
            $table->integer('tesi_id')->unsigned();
            $table->dateTime('fecha');

            $table->foreign('tesi_id')
                  ->references('id')->on('tesis')
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
        Schema::drop('revisiones');
    }
}
