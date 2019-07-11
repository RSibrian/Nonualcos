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
use Illuminate\Support\Facades\Auth;
use Response;
use Input;

class valeController extends Controller
{
    //Controlador para la gestion de vales de combustible

    public function index()
    {
      // retorna la vista principal o index de vales de combustible
        $_vales = Vale::darIndex();
        $esAdmin=Vale::EsAdmin(Auth::id());

      return View('vales.index',compact('_vales', 'esAdmin'));
    }

    public function create()
    {
      // retorna la vista para el registro de nuevo vale
        $placas = Vehiculo::PlacasDisponibles();
        $empleados = Vale::EmpleadosActivos();
        $administradores= Vale::UsuariosAdmin();
        $autoriza= User::find(Auth::id());
        $esAdmin=Vale::EsAdmin(Auth::id());
        Vale::verifica($autoriza,$placas, $empleados);
        $placas=$placas->prepend('Seleccione una placa', '0');
        $empleados=$empleados->prepend('Seleccione un empleado', '0');
        $administradores=$administradores->prepend('Seleccione un empleado', '0');

        return View('vales.create', compact('placas', 'empleados', 'autoriza', 'administradores', 'esAdmin'));
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
        $placas = Vale::PlascasDisponiblesModificar($vehiculo);
        $empleados = Vale::EmpleadosDisponiblesModificar($salida);
        $autoriza= User::find(Auth::id());
        $esAdmin=Vale::EsAdmin(Auth::id());
        $administradores= Vale::UsuariosAdmin();
        Vale::verifica($autoriza,$placas, $empleados);
        $placas=$placas->prepend('Seleccione una placa', '0');
        $empleados=$empleados->prepend('Seleccione un empleado', '0');
        $administradores=$administradores->prepend('Seleccione un empleado', '0');

         //echo dd($vale);
        return View('vales.edit', compact('vale', 'salida', 'vehiculo', 'placas', 'empleados', 'esAdmin', 'administradores', 'autoriza'));

    }

    public function store(ValeRequest $request)
    {
        //función que permite almacenar la información en la base de datos
        $request->createVale($request);

        return redirect('/vales/index')->with('create','Se ha guardado con éxito el registro');
    }

    public function update(ValeEditRequest $request, Vale $vale)
    {
        $request->updateVale($request, $vale);
        return redirect('/vales/index')->with('update','Se ha editado con éxito el registro');
    }

    public function devolver(Vale $vale)
    {
        
            $vale->update(['estadoRecibidoVal' => '1']);

        return json_encode("devuelto");
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
        $vistaurl="reportesTransporte.valesViewReport";
        $view =  \View::make($vistaurl, compact('vale', 'salida', 'vehiculo', 'nombre', 'recibe', 'autoriza', 'date','date1'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream('Detalle de Vale '.$date.'.pdf');


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
