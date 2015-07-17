<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revisione extends Model
{
    protected $table = 'revisiones';

    protected $fillable = ['revision', 'cod_user_ryca', 'tesi_id', 'fecha'];

    public $timestamps = false;

    public function tesis()
    {
    	return $this->belongsTo('App\Tesi', 'tesi_id', 'id');
    }


}
