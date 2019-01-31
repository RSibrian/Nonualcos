<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Arr;
use App\Activos;
use App\Empleado;
use App\Unidades;

class ActivosUnidades extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;

  protected $table = 'activos_unidades';
  protected $fillable = [
      'fechaInicioUni','fechaFinalUni','estadoUni','observacionUni','idActivo','idUnidad','idEmpleado'
  ];

  protected $auditExclude = [
        'id',
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

    /**
    * {@inheritdoc}
    */
    //fución para cambiar los datos guardados en la auditoría
    public function transformAudit(array $data): array
    {
      //Activo
      if(Arr::has($data,'old_values.idActivo'))
      $data['old_values']['idActivo']=Activos::find($data['old_values']['idActivo'])->nombreActivo;

      if (Arr::has($data,'new_values.idActivo'))
      $data['new_values']['idActivo']=Activos::find($data['new_values']['idActivo'])->nombreActivo;

      //Unidad
      if(Arr::has($data,'old_values.idUnidad'))
      $data['old_values']['idUnidad']=Unidades::find($data['old_values']['idUnidad'])->nombreUnidad;

      if (Arr::has($data,'new_values.idUnidad'))
      $data['new_values']['idUnidad']=Unidades::find($data['new_values']['idUnidad'])->nombreUnidad;

      //Empleado
      if(Arr::has($data,'old_values.idEmpleado'))
      $data['old_values']['idEmpleado']=Empleado::find($data['old_values']['idEmpleado'])->fullName;

      if (Arr::has($data,'new_values.idEmpleado'))
      $data['new_values']['idEmpleado']=Empleado::find($data['new_values']['idEmpleado'])->fullName;

      //Fecha de Asignación
      if(Arr::has($data,'old_values.fechaInicioUni'))
      $data['old_values']['fechaInicioUni']=\Helper::fecha($data['old_values']['fechaInicioUni']);

      if (Arr::has($data,'new_values.fechaInicioUni'))
      $data['new_values']['fechaInicioUni']=\Helper::fecha($data['new_values']['fechaInicioUni']);

      //Fecha de cambio
      if(Arr::has($data,'old_values.fechaFinalUni'))
      $data['old_values']['fechaFinalUni']=\Helper::fecha($data['old_values']['fechaFinalUni']);

      if (Arr::has($data,'new_values.fechaFinalUni'))
      $data['new_values']['fechaFinalUni']=\Helper::fecha($data['new_values']['fechaFinalUni']);

      return $data;
    }
}
