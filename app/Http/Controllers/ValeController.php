<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValeRequest;
use App\Salidas;
use App\User;
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
      // retorna la vista principal de vales de combustible
        $_vale=new Vale();
      $_vales = json_decode($_vale->ValeList());
      return View('vales.index',compact('_vales'));
    }

    public function Crear()
    {
      // retorna la vista para el registro de nuevo vale

      return View('vales.createVale');
    }

    public function show($vale){

        $_vale=new Vale();
        $_show = $_vale->Valefind($vale);

        return View('vales.show', compact('_show'));

    }

    public function edit($vale){

        $_vale=new Vale();
        $_edit = $_vale->Valefind($vale);

        return View('vales.editVale', compact('_edit'));

    }

    public function Liquidacion()
    {
      // retorna la vista para el registro de nuevo vale


      return View('vales.index2');
    }

    public function NuevaLiquidacion()
    {
      // retorna la vista para el registro de nuevo vale
        $_liquidar=Vale::where('estadoLiquidacionVal', '=', '0')->get();

      return View('vales.formularioLiquidacion', compact('_liquidar'));
    }

    public function Guardar(ValeRequest $request)
    {

        //función que permite almacenar la información en la base de datos
        $_salida =new Salidas();
        $_salida->GuardarSalida($request);
        $_salida->save();


        $_vale =new Vale();
        $_vale->GuardarVale($request);
        $_vale->save();

        return redirect('/vales');
    }

    public function GuardarLiquidacion()
    {
        //función que permite almacenar la información en la base de datos

        return redirect('/vales/liquidar');
    }

    public function autocompletePlacas(){
        $term = Input::get('term');
        $results = array();

        $queries = Vehiculos::where('numeroPlaca', 'LIKE', '%'.$term.'%')
            ->take(6)->get();

        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->idVehiculo, 'value' => $query->numeroPlaca];
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
