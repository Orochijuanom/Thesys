<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiantes';

    protected $fillable = ['username'];

    public $timestamps = false;

    function tesis()
    {

    	return $this->belongsToMany('App\Tesi', 'estudiante_tesi', 'estudiante_id', 'tesi_id');

    }
}
