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
    public function index(Vehiculo $placa)
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

    public function  RGSalidas($fechaInicio,$fechaFinal,Vehiculo $placa){

        $data=Salidas::Datatable2($placa->id, $fechaInicio, $fechaFinal);

        $date = date('d-m-Y');
        $date1 = date('g:i:s a');
        $vistaurl="reportesTransporte.salidasVReport";
        $view =  \View::make($vistaurl, compact('data','fechaInicio','fechaFinal', 'date','date1', 'placa'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper('letter', 'landscape');
        return $pdf->stream('Reporte_general_salidas '.$date.'.pdf');

    }
}
