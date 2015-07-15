<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Linea extends Model
{
    protected $table = 'lineas';

    protected $fillable = ['area_id', 'linea'];

    public $timestamps = false;

    public function areas()
    {
        return $this->belongsTo('App\Area', 'area_id', 'id');
    }
}
