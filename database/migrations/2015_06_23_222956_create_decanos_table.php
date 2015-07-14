<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDecanosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decanos', function(Blueprint $table){
            $table->increments('id');
            $table->integer('cod_user_ryca')->unique();
            $table->integer('cod_facu_ryca')->unique();

            $table->unique(['cod_user_ryca','cod_facu_ryca'], 'user_facu_unique');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('decanos');
    }
}
