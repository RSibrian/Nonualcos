<?php

namespace App\Http\Controllers;

use App\Http\Requests\LiquidacionRequest;
use App\Liquidacion;
use App\Salidas;
use App\Vale;
use App\Vehiculo;
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
        $placas=Vehiculo::pluck('numeroPlaca', 'id');
        $placas=$placas->prepend('Seleccione una placa', '0');
        return View('liquidaciones.create', compact('placas'));
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

}
