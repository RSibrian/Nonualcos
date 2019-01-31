<?php

namespace App\Http\Controllers;

use App\Vehiculo;
use App\Activos;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Response;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $vehiculos=Vehiculo::all();
      //dd($activos);
      return view('vehiculos.index',compact('vehiculos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehiculo $vehiculo)
    {
        //
    }

    public function indexHistory($placa)
    {
        $month = date('m');
        $year = date('Y');
        $fechaInicio= Carbon::createFromDate($year,$month,1);
        $fechaFinal=Carbon::now();
        return View('vehiculos.indexHistory', compact('placa', 'fechaInicio', 'fechaFinal'));

    }

    public function  datatable3($fechaInicio,$fechaFin,$placa){

        $data=Vehiculo::Datatable3($placa,$fechaInicio,$fechaFin);

        return Response::json($data);
    }

    public function  RGMantenimientos($fechaInicio,$fechaFinal,$placa){

        $data=Vehiculo::Datatable3($placa,$fechaInicio,$fechaFinal);

        $date = date('d-m-Y');
        $date1 = date('g:i:s a');
        $vistaurl="reportesTransporte.mantenimientosVReport";
        $view =  \View::make($vistaurl, compact('data','fechaInicio','fechaFinal', 'date','date1'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Reporte_general_vehiculos '.$date.'.pdf');

    }
}
