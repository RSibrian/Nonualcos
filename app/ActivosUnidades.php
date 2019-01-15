<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use OwenIt\Auditing\Contracts\Auditable;
class ActivosUnidades extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
  
  protected $table = 'activos_unidades';
  protected $fillable = [
      'fechaInicioUni','fechaFinalUni','estadoUni','observacionUni','idActivo','idUnidad','idEmpleado'
  ];
  public function activo()
  {
      return $this->belongsTo(Activos::class,'idActivo');
  }
  public function unidad()
  {
      return $this->belongsTo(Unidades::class,'idUnidad');
  }
  public function empleado()
  {
      return $this->belongsTo(Empleado::class,'idEmpleado');
  }



    public static function activosxUnidad($idUnidad,$estadoActivo){
    return DB::table('activos_unidades')
    ->join('activos', 'activos.id', '=', 'activos_unidades.idActivo')
    ->where('activos_unidades.estadoUni','=',1)
    ->where('activos.estadoActivo','=',$estadoActivo)
    ->where('activos_unidades.idUnidad','=',$idUnidad)
    ->select('activos.*','activos_unidades.*')
    //->orderBy('sa_en_vehiculos.id','desc')
    ->get();
    }

    public static function activosxunidadEstado($idUnidad){
    return DB::table('activos_unidades')
    ->join('activos', 'activos.id', '=', 'activos_unidades.idActivo')
    ->where('activos_unidades.estadoUni','=',1)
    ->where('activos_unidades.idUnidad','=',$idUnidad)
    ->select('activos.*','activos_unidades.*')
    //->orderBy('sa_en_vehiculos.id','desc')
    ->get();
    }
}
