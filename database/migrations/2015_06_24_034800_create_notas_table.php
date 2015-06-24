<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function(Blueprint $table){

            $table->increments('id');
            $table->integer('jurado_tesi_id')->unsigned();
            $table->float('nota');
            $table->longText('observaciones');
            $table->timestamps();

            $table->foreign('jurado_tesi_id')
                  ->references('id')->on('jurado_tesi')
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
        Schema::drop('notas');
    }
}
