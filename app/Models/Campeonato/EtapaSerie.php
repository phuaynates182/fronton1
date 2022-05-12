<?php

namespace ioliga\Models\Campeonato;

use Illuminate\Database\Eloquent\Model;
use ioliga\Models\Campeonato\Etapa;
use ioliga\Models\Campeonato\Fecha;
use ioliga\Models\Campeonato\GeneroSerie;
use ioliga\Models\Campeonato\Partido;
use ioliga\Models\Campeonato\Tabla;
use ioliga\Models\Campeonato\Resultado;
use Illuminate\Support\Facades\DB;
class EtapaSerie extends Model
{
   protected $table='etapaSerie';

    public function etapa()
	{
	    return $this->hasOne(Etapa::class,'id','etapa_id');
	}
	public function fechas()
	{
		return $this->hasMany(Fecha::class, 'etapaSerie_id');
	}
	public function generoSerie()
	{
	    return $this->hasOne(GeneroSerie::class,'id','generoSerie_id');
	}

	public function fechasOrdenas()
	{
		return $this->hasMany(Fecha::class, 'etapaSerie_id')->orderby('fechaInicio');
	}

	/*buscar etapas partidos*/
	public function buscarPartidoRepetidos()
	{
		 return $this->hasManyThrough(
            Partido::class,
            Fecha::class,
            'etapaSerie_id', // Foreign key on users table...
            'fecha_id', // Foreign key on posts table...
            'id', // Local key on countries table...
            'id' // Local key on users table...
        );
	}
	public function tablas()
    {
        return $this->hasMany(Tabla::class,'etapaSerie_id');
    }
    public function buscarTablasresultados()
	{
		 $listaPartidos= $this->hasManyThrough(
            Resultado::class,
            Tabla::class,
            'etapaSerie_id', // Foreign key on posts table...
            'tabla_id', // Foreign key on users table...
     		'id',
     		'id'
        );

		 return $listaPartidos;
	}


	/**/
	public function resultado($id)
	{	
		$result=Tabla::
		join('resultado','resultado.tabla_id','=', 'tabla.id')
		->select('resultado.tabla_id','tabla.bonificacion',DB::raw('((sum(resultado.estado="Ganado")*3)+tabla.bonificacion) as ganado,sum(resultado.estado="Empate") as empate , sum(golesFavor-golesContra) as goles'))
		->where('etapaSerie_id',$id)		
		->groupBy('resultado.tabla_id','tabla.bonificacion')
		->orderBy('ganado','DESC')		
		->orderBy('empate','DESC')
		->orderBy('goles','DESC')
		->get();
		return $result;
	}

	/*funciones para la vista*/
	public function buscarPartidoVista()
	{
		 return $this->hasManyThrough(
            Partido::class,
            Fecha::class,
            'etapaSerie_id', // Foreign key on users table...
            'fecha_id', // Foreign key on posts table...
            'id', // Local key on countries table...
            'id' // Local key on users table...
        )->where('tipo','Finalizado')->orderBy('fechaInicio','asc');
	}
	

}
