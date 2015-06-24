<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurricularesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculares', function(Blueprint $table){

            $table->increments('id');
            $table->integer('cod_user_ryca');
            $table->integer('cod_prog_ryca');

            $table->unique(['cod_user_ryca', 'cod_prog_ryca'], 'user_prog_unique');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('curriculares');
    }
}
