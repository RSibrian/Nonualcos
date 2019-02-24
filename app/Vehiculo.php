<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Activos;

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
}
