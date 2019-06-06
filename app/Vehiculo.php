<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Arr;


class Vehiculo extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
  protected $table = 'vehiculos';
  protected $fillable = [
      'numeroPlaca','idActivo'
  ];
  public function activo()
  {
      return $this->belongsTo(Activos::class,'idActivo');
  }

  public function salidas()
  {
      return $this->hasMany(Salidas::class, 'idVehiculo');
  }

  /**
  * {@inheritdoc}
  */
  //fución para cambiar los datos guardados en la auditoría
  public function transformAudit(array $data): array
  {
    //Activo
    if(Arr::has($data,'old_values.idActivo'))
    if(!empty($data['old_values']['idActivo']))
    $data['old_values']['idActivo']=Activos::find($data['old_values']['idActivo'])->nombreActivo;

    if (Arr::has($data,'new_values.idActivo'))
    if(!empty($data['new_values']['idActivo']))
    $data['new_values']['idActivo']=Activos::find($data['new_values']['idActivo'])->nombreActivo;

    return $data;
  }

    public static function Datatable3($placa,$fechaI,$fechaF){

        return  Mantenimiento::join('activos', 'mantenimientos.idActivo', '=', 'activos.id')
            ->join('proveedores', 'mantenimientos.empresaEncargada', '=', 'proveedores.id')
            ->join('vehiculos', 'vehiculos.idActivo', '=', 'activos.id')
            ->join('empleados', 'empleados.id', '=', 'mantenimientos.personalSolicitaMantenimiento')
            ->select( 'mantenimientos.*', 'nombreEmpresa', 'nombresEmpleado', 'apellidosEmpleado')
            ->where([
                ['vehiculos.id', '=', $placa],
                ['estadoActivo', '=', '1'],
                ['fechaRetornoTaller', '!=', null]
            ])
            ->whereBetween('fechaRetornoTaller', [$fechaI, $fechaF ])
            ->get();
    }

    public static function PlacasDisponibles(){

        $vehiculosSalidas=Salidas::join('vales', 'salidas.id', '=', 'vales.idSalida')
            ->join('vehiculos', 'vehiculos.id', '=', 'salidas.idVehiculo')
            ->where('vales.estadoRecibidoVal','=', '0')->get(['vehiculos.id']);

        $vehiculosMantenimiento=Activos::join('mantenimientos', 'activos.id', '=', 'mantenimientos.idActivo')
            ->join('vehiculos', 'activos.id', '=', 'vehiculos.idActivo')
            ->where('mantenimientos.fechaRetornoTaller','=',null)
            ->get(['vehiculos.id']);

        $vehiculosActivos=Activos::join('vehiculos', 'activos.id', '=', 'vehiculos.idActivo')
            ->where([
                ['activos.estadoActivo','=','1'],
                ['activos.tipoActivo','=','1'],
                ['activos.codigoInventario','=',null]
            ])->orWhere([
                ['activos.estadoActivo','=','0'],
                ['activos.tipoActivo','=','1'],
            ])->get(['vehiculos.id']);

        $lista=$vehiculosSalidas->merge($vehiculosMantenimiento)->merge($vehiculosActivos);
        $lista=$lista->toArray();

        return Vehiculo::whereNotIn('id',$lista)->pluck('vehiculos.numeroPlaca', 'vehiculos.id');
    }

    public static function VehiculosActivos(){
        $vehiculos=Vehiculo::join('activos', 'activos.id', '=', 'vehiculos.idActivo')
            ->where([
                ['activos.estadoActivo','=','1'],
                ['activos.tipoActivo','=','1'],
                ['activos.codigoInventario','!=',null]
            ])->orWhere([
                ['activos.estadoActivo','=','1'],
                ['activos.tipoActivo','=','1'],
            ])->get(['vehiculos.id']);
        $vehiculos=$vehiculos->toArray();

        return Vehiculo::whereIn('id', $vehiculos)->get();
    }
}
