<?php

namespace ioliga\Models\Campeonato;

use Illuminate\Database\Eloquent\Model;
use ioliga\Models\Equipo\Genero;
use ioliga\Models\Equipo\Equipo;
use ioliga\Models\Campeonato\Serie;
use ioliga\Models\Campeonato\EtapaSerie;
use ioliga\Models\Campeonato\Asignacion;

class GeneroSerie extends Model
{
    protected $table='generoSerie';


    /*GenerioSerie <--- Genero */
    public function genero()
	{
	    return $this->belongsTo(Genero::class, 'genero_id');
    }

    public function serie()
	{
	    return $this->belongsTo(Serie::class, 'serie_id');
    }
    
    // GeneroSerie ---> Equipos
    public function equipos()
    {
        return $this->belongsToMany(Equipo::class, 'asignacion', 'generoSerie_id','equipo_id')->as('asignacion')->withPivot('id');
    }

      //busqueda de generoSerie a asignaciongenero serie

    public function serieAsignacionNomina()
    {
        return $this->hasManyThrough(
            AsignacionNomina::class,
            Asignacion::class,
            'generoSerie_id', // Foreign key on GeneroSerie table...
            'asignacion_id', // Foreign key on Genero table...
            'id', // Local key on countries table...
            'id' // Local key on users table...
        );
    }
    public function etapaSerie()
    {
        return $this->hasMany(EtapaSerie::class,'generoSerie_id'); 
    }
    public function asignacionDes()
    {
        return $this->hasMany(Asignacion::class,'generoSerie_id')->where('estado',1)->orderBy('equipo_id', 'desc'); 
    }
     public function asignacionAsc()
    {
        return $this->hasMany(Asignacion::class,'generoSerie_id')->where('estado',1)->orderBy('equipo_id'); 
    }
     public function asignaciones()
    {
        return $this->hasMany(Asignacion::class,'generoSerie_id'); 
    }
}
