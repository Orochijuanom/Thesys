<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = 'tipos';

	public $timestamps = false;

	public function tesis()
    {
        return $this->hasMany('App\Tesi', 'tipo_id', 'id');
    }
}
