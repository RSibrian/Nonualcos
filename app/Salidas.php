<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Salidas extends Model
{
    //Modelo para salidas de vehículo

    //variables
    protected  $table='salidas';

    protected $fillable=[
        'fechaSalida','destinoTrasladarse','mision', 'estadoSalida',
        'fechaLiquidacion','numeroFacturaLiquidacion','montoFacturaLiquidacion',
        'idVehiculo','idEmpleado'
    ];

    public function Vales(){
        return $this->hasMany(Vale::class, 'idSalida');
    }

    public function Empleados(){
        return $this->belongsTo(Empleado::class, 'idEmpleado');
    }

    public function Vehiculo(){
        return $this->belongsTo(Vehiculos::class, 'idVehiculo');
    }

    public function GuardarSalida(Request $request){

        $this->fechaSalida = $request->fechaSalida;
        $this->destinoTrasladarse = strtoupper($request->destino);
        $this->mision = $request->mision;
        $this->idVehiculo = $this->buscaIdVehiculo($request->numeroPlaca);
        $this->idEmpleado =$request->idSolicitante;

    }

    public function buscaIdVehiculo(String $placa){
        $_query = Vehiculos::select('idVehiculo')->where('numeroPlaca', '=', $placa)->take(1)->get();
        return $_query[0]->idVehiculo;
    }

}
