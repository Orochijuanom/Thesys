<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuradoTesiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurado_tesi', function(Blueprint $table){

            $table->increments('id');
            $table->integer('cod_user_ryca')->unsigned();
            $table->integer('tesi_id')->unsigned();

            $table->unique(['cod_user_ryca', 'tesi_id'], 'user_tesi_unique');

            $table->foreign('tesi_id')
                  ->references('id')->on('tesis')
                  ->onDelete('restrict')
                  ->onUpddate('no action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jurado_tesi');
    }
}
