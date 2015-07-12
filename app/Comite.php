<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comite extends Model
{
    protected $table = 'comites';

    protected $fillable = ['cod_user_ryca', 'cod_prog_ryca'];

    public $timestamps = false;
}
