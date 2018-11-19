<?php

namespace App\Http\Controllers;

use App\Vale;
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

        return View('liquidaciones.create', compact('_liquidar'));
    }

    public function store()
    {
        //función que permite almacenar la información en la base de datos

        return redirect('/vales/liquidar');
    }

}
