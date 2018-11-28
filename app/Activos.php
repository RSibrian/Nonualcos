<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Activos extends Model
{
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
}
