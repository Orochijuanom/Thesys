<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';

    protected $fillable = ['cod_facu_ryca', 'area'];

    public $timestamps = false;
}
