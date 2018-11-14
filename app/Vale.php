<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Vale extends Model
{
    //Modelo para vale de combustible

    //variables
    protected  $table='vales';

    protected $fillable=[
      'fechaCreacion', 'numeroVale', 'costoUnitario', 'gasolinera',
      'tipoCombustible', 'galones', 'empleadoAutoriza', 'empleadoRecibe',
      'estadoEntregado', 'estadoLiquidacion', 'estadoRecibido', 'idSalida'
    ];

    public function Salidas(){

        return $this->belongsTo(Salidas::class, 'idSalida');
    }


    public function GuardarVale(Request $request){
        //echo dd($request);
        $this->fechaCreacion = $request->fechaCreacion;
        $this->numeroVale = $request->numeroVale;
        $this->costoUnitarioVale = $request->cVale;
        $this->tipoCombustible = strtoupper($request->tipoCombustible);
        $this->galones = $request->nGalones;
        $this->gasolinera = strtoupper($request->gasolinera);
        $this->empleadoAutorizaVal = $request->idEmpAutoriza;
        $this->empleadoRecibeVal = $request->idEmpRecibe;

        $_estado= (String) $request->estadoEntrega;
         //echo  dd($_estado);

       if (!($_estado.equalTo("on"))){
          $this->estadoEntregadoVal = 0;
        }

        $this->idSalida = $this->buscaIdSalida();
    }

    public function buscaIdSalida(){
         $_query= Salidas::select('idSalida')->latest()->get();
        return $_query[0]->idSalida;
    }

    public function ValeList()
    {
        $_lista= Vale::join('salidas', 'vales.idSalida', '=', 'salidas.idSalida')
            ->join('empleados', 'salidas.idEmpleado', '=', 'empleados.id')
            ->join('cargos', 'empleados.idCargo', '=', 'cargos.id')
            ->select('vales.*', 'salidas.idSalida', 'empleados.nombresEmpleado', 'empleados.apellidosEmpleado', 'cargos.idUnidad')
            ->get();

        foreach ($_lista as $lista)
        {
            $_unidad=Unidades::select('nombreUnidad')
                ->where('id', '=', $lista->idUnidad)
                ->get();

            $_resultado[] = [
                'idVale' => $lista->idVale,
                'fechaCreacion' => $lista->fechaCreacion,
                'costoUnitarioVale' => $lista->costoUnitarioVale,
                'galones' => $lista->galones,
                'estadoEntregadoVal' => $lista->estadoEntregadoVal,
                'estadoRecibidoVal' => $lista->estadoRecibidoVal,
                'idSalida' => $lista->idSalida,
                'nombreEmpleado' => $lista->nombresEmpleado.' '.$lista->apellidosEmpleado,
                'unidad' => $_unidad[0]->nombreUnidad,
            ];
        }

        return json_encode($_resultado);
    }

    public function Valefind($vale)
    {
        $_lista= Vale::join('salidas', 'vales.idSalida', '=', 'salidas.idSalida')
            ->join('empleados', 'salidas.idEmpleado', '=', 'empleados.id')
            ->join('cargos', 'empleados.idCargo', '=', 'cargos.id')
            ->join('unidades', 'cargos.idUnidad', '=', 'unidades.id')
            ->select('vales.*', 'salidas.*', 'empleados.nombresEmpleado', 'empleados.apellidosEmpleado', 'empleados.id', 'unidades.nombreUnidad')
            ->where('vales.idVale', '=', $vale)
            ->get();

        foreach ($_lista as $lista)
        {
            $_vehiculo=Vehiculos::select('numeroPlaca')
                ->where('idVehiculo', '=', $lista->idVehiculo)
                ->first();

            $_autoriza=Empleado::select('nombresEmpleado', 'apellidosEmpleado')
                ->where('id', '=', $lista->empleadoAutorizaVal)
                ->first();

            $_recibe=Empleado::select('nombresEmpleado', 'apellidosEmpleado')
                ->where('id', '=', $lista->empleadoRecibeVal)
                ->first();

            $lista = array_add($lista, 'numeroPlaca',  $_vehiculo->numeroPlaca );

            $lista = array_add($lista, 'autoriza',  $_autoriza->nombresEmpleado.' '.$_autoriza->apellidosEmpleado );

            $lista = array_add($lista, 'recibe',  $_recibe->nombresEmpleado.' '.$_recibe->apellidosEmpleado );

        }

        return $lista;
    }
}
