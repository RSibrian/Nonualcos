<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValeRequest;
use App\Http\Requests\ValeEditRequest;
use App\Salidas;
use App\User;
use App\Vehiculo;
use Illuminate\Http\Request;
use App\Empleado;
use App\Vale;
use App\Vehiculos;
use Response;
use Input;

class valeController extends Controller
{
    //Controlador para la gestion de vales de combustible

    public function index()
    {
      // retorna la vista principal o index de vales de combustible
      $_vales = Vale::select('*')
          ->where('estadoLiquidacionVal', '=', '0')
          ->orderBy('updated_at', 'desc')
          ->get();

      return View('vales.index',compact('_vales'));
    }

    public function create()
    {
      // retorna la vista para el registro de nuevo vale

      return View('vales.create');
    }

    public function show(Vale $vale){
        //función indicada para mostrar los valores del vale, salida y empleados, los métodos find se
        //utilizan para encontrar los nombres del empleado que son mostrados en la seccion de entrega.
        //La valiable $nombre contiene una colleccion de informacion con respecto al empleado que realizó la salida.
        //de igual manera funciona la variable $vehiculo y salida.

        $salida=$vale->salida;
        $vehiculo=$vale->salida->vehiculo;
        $nombre=$vale->salida->empleados;
        $recibe=$vale->salida->empleados->find($vale->empleadoRecibeVal);
        $autoriza=$vale->salida->empleados->find($vale->empleadoAutorizaVal);

        return View('vales.show', compact('vale', 'salida', 'vehiculo', 'nombre', 'recibe', 'autoriza'));

    }

    public function edit(Vale $vale){

        $salida=$vale->salida;
        $vehiculo=$vale->salida->vehiculo;
        $solicitante=$vale->salida->empleados;
        $recibe=$vale->salida->empleados->find($vale->empleadoRecibeVal);
        $autoriza=$vale->salida->empleados->find($vale->empleadoAutorizaVal);

         //echo dd($vale);
        return View('vales.edit', compact('vale', 'salida', 'vehiculo', 'solicitante', 'recibe', 'autoriza'));

    }

    public function store(ValeRequest $request)
    {
        //función que permite almacenar la información en la base de datos
        $request->createVale($request);

        return redirect('/vales')->with('create','Se ha guardado con éxito el registro de vale');
    }

    public function update(ValeEditRequest $request, Vale $vale)
    {
        $request->updateVale($request, $vale);
        return redirect('/vales')->with('update','Se ha editado con éxito el registro de vale');
    }

    public function ValeVistaReporte(Vale $vale){
        //función indicada para mostrar los valores del vale, salida y empleados, los métodos find se
        //utilizan para encontrar los nombres del empleado que son mostrados en la seccion de entrega.
        //La valiable $nombre contiene una colleccion de informacion con respecto al empleado que realizó la salida.
        //de igual manera funciona la variable $vehiculo y salida.
        $salida=$vale->salida;
        $vehiculo=$vale->salida->vehiculo;
        $nombre=$vale->salida->empleados;
        $recibe=$vale->salida->empleados->find($vale->empleadoRecibeVal);
        $autoriza=$vale->salida->empleados->find($vale->empleadoAutorizaVal);

        $date = date('d-m-Y');
        $date1 = date('g:i:s a');
        $vistaurl="vales.valesViewReport";
        $view =  \View::make($vistaurl, compact('vale', 'salida', 'vehiculo', 'nombre', 'recibe', 'autoriza', 'date','date1'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Detalle de Vale '.$date.'.pdf');


    }


    public function autocompletePlacas(){
        $term = Input::get('term');
        $results = array();

        $queries = Vehiculo::where('numeroPlaca', 'LIKE', '%'.$term.'%')
            ->take(6)->get();

        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->numeroPlaca];
        }
        return Response::json($results);

    }

    public function autocompleteDestinos(){
        $term = Input::get('term');
        $results = array();

        $queries = Salidas::select('destinoTrasladarse')
            ->groupBy('destinoTrasladarse')
            ->having('destinoTrasladarse', 'LIKE', '%'.$term.'%')
            ->take(6)->get();

        foreach ($queries as $query)
        {
            $results[] = ['value' => $query->destinoTrasladarse];
        }
        return Response::json($results);

    }

    public function autocompleteEmpleado(){
        $term = Input::get('term');
        $results = array();

        $queries = Empleado::where('nombresEmpleado', 'LIKE', '%'.$term.'%')
            ->orWhere('apellidosEmpleado', 'LIKE', '%'.$term.'%')
            ->take(6)->get();

        foreach ($queries as $query)
        {
            $results[] = ['id' => $query->id,'value' => $query->nombresEmpleado.' '.$query->apellidosEmpleado];

        }
        return Response::json($results);

    }

    public function autocompleteGasolinera(){

        $term = Input::get('term');
        $results = array();

        $queries = Vale::select('gasolinera')
            ->groupBy('gasolinera')
            ->having('gasolinera', 'LIKE', '%'.$term.'%')
            ->take(6)->get();

        foreach ($queries as $query)
        {
            $results[] = ['value' => $query->gasolinera];
        }
        return Response::json($results);

    }

    public function autocompletetipoCombustible(){

        $term = Input::get('term');
        $results = array();

        $queries = Vale::select('tipoCombustible')
            ->groupBy('tipoCombustible')
            ->having('tipoCombustible', 'LIKE', '%'.$term.'%')
            ->take(6)->get();

        foreach ($queries as $query)
        {
            $results[] = ['value' => $query->tipoCombustible];
        }
        return Response::json($results);

    }


}
