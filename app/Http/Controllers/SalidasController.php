<?php

namespace App\Http\Controllers;

use App\Salidas;
use App\Vehiculo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Response;

class SalidasController extends Controller
{
    //
    public function index($placa)
    {
        // retorna la vista para el registro de nuevo vale
        $month = date('m');
        $year = date('Y');
        $fechaInicio= Carbon::createFromDate($year,$month,1);
        $fechaFinal=Carbon::now();
        return View('salidas.index', compact('fechaInicio', 'fechaFinal', 'placa'));
    }

    public function  datatable2($fechaInicio, $fechaFin, $placa){

        $data=Salidas::Datatable2($placa, $fechaInicio, $fechaFin);

        return Response::json($data);
    }
}
