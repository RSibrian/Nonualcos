<?php

namespace App\Http\Controllers;
use \App\Activos;
use Illuminate\Http\Request;

class DepreciacionController extends Controller
{
    //
    public function show(Activos $activo)
    {
        return view('activos.depreciaciones.show',compact('activo'));
    }
}
