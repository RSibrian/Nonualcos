<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Arr;
use App\Vehiculo;
use App\Empleado;

class Salidas extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
    //Modelo para salidas de vehículo

    //variables
    protected  $table='salidas';

    protected $fillable=[
        'fechaSalida','destinoTrasladarse','mision',
        'idVehiculo','idEmpleado'
    ];

    public function vales(){
        return $this->hasOne(Vale::class, 'idSalida');
    }

    public function empleados(){
        return $this->belongsTo(Empleado::class, 'idEmpleado');
    }

    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class, 'idVehiculo');
    }

    /**
    * {@inheritdoc}
    */
    //fución para cambiar los datos guardados en la auditoría
    public function transformAudit(array $data): array
    {
      //fechaSalida
      if(Arr::has($data,'old_values.fechaSalida'))
      $data['old_values']['fechaSalida']=\Helper::fecha($data['old_values']['fechaSalida']);

      if (Arr::has($data,'new_values.fechaSalida'))
      $data['new_values']['fechaSalida']=\Helper::fecha($data['new_values']['fechaSalida']);

      //idVehiculo
      if(Arr::has($data,'old_values.idVehiculo'))
      if(!empty($data['old_values']['idVehiculo']))
      $data['old_values']['idVehiculo']=Vehiculo::find($data['old_values']['idVehiculo'])->numeroPlaca;

      if (Arr::has($data,'new_values.idVehiculo'))
      if(!empty($data['new_values']['idVehiculo']))
      $data['new_values']['idVehiculo']=Vehiculo::find($data['new_values']['idVehiculo'])->numeroPlaca;

      //idEmpleado
      if(Arr::has($data,'old_values.idEmpleado'))
      if(!empty($data['old_values']['idEmpleado']))
      $data['old_values']['idEmpleado']=Empleado::find($data['old_values']['idEmpleado'])->fullName;

      if (Arr::has($data,'new_values.idEmpleado'))
      if(!empty($data['new_values']['idEmpleado']))
      $data['new_values']['idEmpleado']=Empleado::find($data['new_values']['idEmpleado'])->fullName;

      return $data;
    }

}
