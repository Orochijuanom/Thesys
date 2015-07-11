<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Decano extends Model
{

    protected $table = 'decanos';

    protected $fillable = ['cod_user_ryca', 'cod_facu_ryca'];

    public $timestamps = false;
}
