<?php

namespace App\Http\Controllers;

use App\Http\Requests\LiquidacionRequest;
use App\Liquidacion;
use App\Salidas;
use App\Vale;
use App\Vehiculo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Response;

class LiquidacionController extends Controller
{
    //
    public function index()
    {
        // retorna la vista para el registro de nuevo vale
        $liquidaciones =Liquidacion::all()->sortByDesc('updated_at');

        return View('liquidaciones.index', compact('liquidaciones'));
    }

    public function create()
    {
        // retorna la vista para el registro de nuevo vale
        $placas=Liquidacion::PlacasDisponibes();
        $vales=Liquidacion::valesDisponibles();
        Liquidacion::verifica($placas, $vales);
        $placas=$placas->prepend('Seleccione una placa', '0');
        return View('liquidaciones.create', compact('placas', 'vales'));
    }

    public function store(LiquidacionRequest $request)
    {
        //función que permite almacenar la información en la base de datos
        $request->createLiquidacion($request);

        return redirect('/liquidaciones/vales/index')->with('create','Se ha guardado con éxito el registro de liquidación');
    }

    public function edit(Liquidacion $liquidacion)
    {
        $placas=Vehiculo::pluck('numeroPlaca', 'id');
        $placas=$placas->prepend('Seleccione una placa', '0');

        $vales=Liquidacion::VehiculohasLiquidacion($liquidacion);
        return View('liquidaciones.edit', compact('liquidacion','placas', 'vales'));
    }

    public function show(Liquidacion $liquidacion)
    {
        $vales=Liquidacion::VehiculohasLiquidacion($liquidacion);

        return View('liquidaciones.show', compact('liquidacion', 'vales'));
    }

    public function  datatable($placa){

        $data=Liquidacion::Datatable($placa);

        return Response::json($data);
    }

    public function  coste(Vale $id){

         return Response::json($id);
    }

    public function LiquidacionVales(Liquidacion $liquidacion)
    {
        $vales=Liquidacion::VehiculohasLiquidacion($liquidacion);

        return Response::json($vales);
    }

    public function LiquidacionVistaReporte(Liquidacion $liquidacion){
        //función indicada para mostrar los valores del vale, salida y empleados, los métodos find se
        //utilizan para encontrar los nombres del empleado que son mostrados en la seccion de entrega.
        //La valiable $nombre contiene una colleccion de informacion con respecto al empleado que realizó la salida.
        //de igual manera funciona la variable $vehiculo y salida.
        $vales=Liquidacion::VehiculohasLiquidacion($liquidacion);

        $date = date('d-m-Y');
        $date1 = date('g:i:s a');
        $vistaurl="reportesTransporte.liquidacionesViewReport";
        $view =  \View::make($vistaurl, compact('liquidacion', 'vales', 'date','date1'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream('Detalle de Liquidacion '.$date.'.pdf');


    }

       public function LiquidacionReporteGeneral($fechaI,$fechaF){
        //función indicada para mostrar los valores del vale, salida y empleados, los métodos find se
        //utilizan para encontrar los nombres del empleado que son mostrados en la seccion de entrega.
        //La valiable $nombre contiene una colleccion de informacion con respecto al empleado que realizó la salida.
        //de igual manera funciona la variable $vehiculo y salida.
        $liquidaciones=Liquidacion::Liquidaciones($fechaI,$fechaF);

        $date = date('d-m-Y');
        $date1 = date('g:i:s a');
        $vistaurl="reportesTransporte.LiquidacionRGeneral";
        $view =  \View::make($vistaurl, compact('liquidaciones', 'fechaI', 'fechaF' ,'date','date1'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream('Reporte General de Liquidaciones '.$date.'.pdf');


    }

    public static function RGLiquidaciones(){

        $month = date('m');
        $year = date('Y');
        $fechaInicio= Carbon::createFromDate($year,$month,1);
        $fechaFinal=Carbon::now();

        return View('liquidaciones.indexHistorialLiquidaciones', compact('fechaInicio', 'fechaFinal'));

    }

    public static function MostrarLiquidaciones($fechaInicio, $fechaFin){

        $liquidaciones=Liquidacion::MLiquidaciones($fechaInicio,$fechaFin);

        return $liquidaciones;

    }

}
