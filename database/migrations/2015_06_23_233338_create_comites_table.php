<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comites', function(Blueprint $table){

            $table->increments('id');
            $table->integer('cod_user_ryca');
            $table->integer('cod_prog_ryca')->unique();

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
       Schema::drop('comites');
    }
}
