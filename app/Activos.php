<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Arr;
use App\Proveedor;
use App\ClasificacionesActivos;

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
    $url=$data['url'];
    
    //Clasificación de activos
    if(Arr::has($data,'old_values.idClasificacionActivo'))
    $data['old_values']['idClasificacionActivo']=ClasificacionesActivos::find($data['old_values']['idClasificacionActivo'])->nombreTipo;

    if (Arr::has($data,'new_values.idClasificacionActivo'))
    $data['new_values']['idClasificacionActivo']=ClasificacionesActivos::find($data['new_values']['idClasificacionActivo'])->nombreTipo;

    //Vehículo o no
    if(Arr::has($data,'old_values.tipoActivo'))
    $data['old_values']['tipoActivo']==0?$data['old_values']['tipoActivo']="No": $data['old_values']['tipoActivo']="Sí";

    if (Arr::has($data,'new_values.tipoActivo'))
    $data['new_values']['tipoActivo']==0?$data['new_values']['tipoActivo']="No": $data['new_values']['tipoActivo']="Sí";

    //Adquisición
    if(Arr::has($data,'old_values.tipoAdquisicion'))
    $data['old_values']['tipoAdquisicion']==1?$data['old_values']['tipoAdquisicion']="Compra": $data['old_values']['tipoAdquisicion']="Donación";

    if (Arr::has($data,'new_values.tipoAdquisicion'))
    $data['new_values']['tipoAdquisicion']==1?$data['new_values']['tipoAdquisicion']="Compra": $data['new_values']['tipoAdquisicion']="Donación";

    //¿Usado?
    if(Arr::has($data,'old_values.estadoUsado'))
    $data['old_values']['estadoUsado']==1?$data['old_values']['estadoUsado']="Sí": $data['old_values']['estadoUsado']="No";

    if (Arr::has($data,'new_values.estadoUsado'))
    $data['new_values']['estadoUsado']==1?$data['new_values']['estadoUsado']="Sí": $data['new_values']['estadoUsado']="No";

    //Fecha de adquisición
    if(Arr::has($data,'old_values.fechaAdquisicion'))
    $data['old_values']['fechaAdquisicion']=\Helper::fecha($data['old_values']['fechaAdquisicion']);

    if (Arr::has($data,'new_values.fechaAdquisicion'))
    $data['new_values']['fechaAdquisicion']=\Helper::fecha($data['new_values']['fechaAdquisicion']);

    //Proveedor
    if(Arr::has($data,'old_values.idProveedor'))
    if(!empty($data['old_values']['idProveedor']))$data['old_values']['idProveedor']=Proveedor::find($data['old_values']['idProveedor'])->nombreEmpresa;

    if (Arr::has($data,'new_values.idProveedor'))
    if(!empty($data['new_values']['idProveedor']))$data['new_values']['idProveedor']=Proveedor::find($data['new_values']['idProveedor'])->nombreEmpresa;

    //Precio
    if(Arr::has($data,'old_values.precio'))
    $data['old_values']['precio']='$ '.\Helper::dinero($data['old_values']['precio']);

    if (Arr::has($data,'new_values.precio'))
    $data['new_values']['precio']='$ '.\Helper::dinero($data['new_values']['precio']);

    return $data;
  }
}
