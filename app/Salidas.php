<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use OwenIt\Auditing\Contracts\Auditable;

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


}
