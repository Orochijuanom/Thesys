<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';

    public $timestamps = false;

    public function tesis()
    {
        return $this->hasMany('App\Tesi', 'estado_id', 'id');
    }
}
