<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Arr;

class Activos extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;

  protected $table = 'activos';
  protected $fillable = [
      'id','codigoInventario','nombreActivo','numeroFactura','precio','marca','modelo','serie','color',
      'ObservacionActivo','tipoActivo','tipoAdquisicion','fechaAdquisicion','estadoActivo',
      'justificacionActivo','fechaBajaActivo','idProveedor','idClasificacionActivo','estadoUsado','aniosUso','valorResidual','aniosVida'
  ];
  public function clasificacionActivo()
  {
      return $this->belongsTo(ClasificacionesActivos::class,'idClasificacionActivo');
  }
  public function proveedor()
  {
      return $this->belongsTo(Proveedor::class,'idProveedor');
  }
  public function activosEmpleados()
  {
      return $this->hasMany(ActivosEmpleados::class,'idActivo');
  }
  public function activosUnidades()
  {
      return $this->hasMany(ActivosUnidades::class,'idActivo');
  }
  public function vehiculo()
  {
      return $this->hasOne(Vehiculo::class,'idActivo');
  }

  public static function mantenimientoxUnidad($idactivo){
  return DB::table('mantenimientos')
  ->join('activos','mantenimientos.idActivo' , '=', 'activos.id' )
  ->where('mantenimientos.idActivo','=',$idactivo)
  ->select('mantenimientos.*','activos.*')
  //->orderBy('','desc')
  ->get();
  }

  public static function vehiculoConsulta()
  {
    return DB::table('activos')
    ->where('activos.tipoActivo','=',1)
    ->select('*')
        // ->orderBy('vehiculos.id','desc')
    ->get();
  }

  public static function activosReporte($idUnidad){
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
        if (Arr::has($data, 'new_values.role_id')) {
            $data['old_values']['role_name'] = Role::find($this->getOriginal('role_id'))->name;
            $data['new_values']['role_name'] = Role::find($this->getAttribute('role_id'))->name;
        }
        if (Arr::has($data,'new_values.nombreActivo')) {
          $data['old_values']['nombreActivo']='Nuevo activo';
        }
        return $data;
    }
}
