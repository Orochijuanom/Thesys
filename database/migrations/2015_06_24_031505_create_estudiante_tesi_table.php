<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudianteTesiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiante_tesi', function(Blueprint $table){

            $table->increments('id');
            $table->integer('estudiante_id')->unsigned();
            $table->integer('tesi_id')->unsigned();

            $table->unique(['estudiante_id', 'tesi_id'],'estudiante_tesi_unique');

            $table->foreign('estudiante_id')
                  ->references('id')->on('estudiantes')
                  ->onDelete('restrict')
                  ->onUpdate('no action');

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
        Schema::drop('estudiante_tesi');
    }
}
