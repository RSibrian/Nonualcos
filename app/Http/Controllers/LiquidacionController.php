<?php

namespace App\Http\Controllers;

use App\Http\Requests\LiquidacionRequest;
use App\Vale;
use App\Vehiculo;
use Illuminate\Http\Request;

class LiquidacionController extends Controller
{
    //
    public function index()
    {
        // retorna la vista para el registro de nuevo vale


        return View('liquidaciones.index');
    }

    public function create()
    {
        // retorna la vista para el registro de nuevo vale
        $_liquidar=Vale::where('estadoLiquidacionVal', '=', '0')->get();
        $placas=Vehiculo::pluck('numeroPlaca', 'id');

        return View('liquidaciones.create', compact('_liquidar','placas'));
    }

    public function store(LiquidacionRequest $request)
    {
        //función que permite almacenar la información en la base de datos
        $request->createLiquidacion($request);

        return redirect('/liquidaciones/vales/index');
    }

}
