<?php

namespace App\Http\Controllers;

use App\Cargo;
use App\Unidades;
use Illuminate\Http\Request;
use App\BitacoraAccion;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargos=Cargo::All();
        return view('cargos.index',compact('cargos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidades=Unidades::pluck('nombreUnidad','id');
        return view('cargos.create',compact('unidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //bitacora accion
      $unidad=Unidades::find($request['idUnidad']);
      $accion="Crear Cargo";
      $antes=null;
      $despues="Unidad: ".$unidad->nombreUnidad." <br> Cargo: ".$request['nombreCargo'];
      BitacoraAccion::crearBitacora($accion,$antes,$despues);
      //fin bicora accion
        Cargo::create($request->all());
        return redirect('/cargos')->with('create','Se ha creado con éxito el registro de cargo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function show(Cargo $cargo)
    {
        return view('cargos.show',compact('cargo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function edit(Cargo $cargo)
    {
        $unidades=Unidades::pluck('nombreUnidad','id');
        return view('cargos.edit',compact('cargo','unidades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cargo $cargo)
    {
      //bitacora
      $unidad=Unidades::find($request['idUnidad']);
      $accion="Editar Cargo";
      $antes="Unidad: ".$cargo->unidad->nombreUnidad." <br> Cargo: ".$cargo->nombreCargo;
      $despues="Unidad: ".$unidad->nombreUnidad." <br> Cargo: ".$request['nombreCargo'];
      BitacoraAccion::crearBitacora($accion,$antes,$despues);
      //fin bitacora
        $cargo->update($request->all());
      //  dd($cargo);
        return redirect('/cargos')->with('update','Se ha editado correctamente el cargo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cargo $cargo)
    {
        //
    }
}
