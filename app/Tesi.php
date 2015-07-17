<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Tesi extends Model
{
    
    protected $table = 'tesis';

    protected $fillable = ['titulo', 'linea_id', 'cod_prog_ryca', 'semestre', 'director_cod_user_ryca', 'tipo_id', 'estado_id', 'source'];

    public $timestamps = true;

    public function lineas()
    {
        return $this->belongsTo('App\Linea', 'linea_id', 'id');
    }

    public function tipos()
    {
    	return $this->belongsTo('App\Tipo', 'tipo_id', 'id');
    }

    public function estados()
    {
    	return $this->belongsTo('App\Estado', 'estado_id', 'id');
    }

    function estudiantes()
    {

        return $this->belongsToMany('App\Estudiante', 'estudiante_tesi', 'tesi_id', 'estudiante_id');

    }

    public function revisiones()
    {
        return $this->hasMany('App\Revisione', 'tesi_id', 'id');
    }
    
}
