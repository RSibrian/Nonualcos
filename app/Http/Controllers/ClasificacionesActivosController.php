<?php

namespace App\Http\Controllers;

use App\ClasificacionesActivos;
use Illuminate\Http\Request;
use App\Http\Requests\ClasificacionActivosRequest;

class ClasificacionesActivosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $tipos=ClasificacionesActivos::All();
      return view('clasificaciones.index',compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('clasificaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClasificacionActivosRequest $request)
    {
      
      ClasificacionesActivos::create($request->all());
      return redirect('/clasificaciones')->with('create','Se ha creado con éxito la clasificación de activo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClasificacionesActivos  $clasificacionesActivos
     * @return \Illuminate\Http\Response
     */
    public function show(ClasificacionesActivos $clasificacionesActivos)
    {
        return view('clasificaciones.show',compact('clasificacionesActivos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClasificacionesActivos  $clasificacionesActivos
     * @return \Illuminate\Http\Response
     */
    public function edit(ClasificacionesActivos $clasificacionesActivos)
    {
      return view('clasificaciones.edit',compact('clasificacionesActivos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClasificacionesActivos  $clasificacionesActivos
     * @return \Illuminate\Http\Response
     */
    public function update(ClasificacionActivosRequest $request, ClasificacionesActivos $clasificacionesActivos)
    {
      $clasificacionesActivos->update($request->all());
      return redirect('/clasificaciones')->with('update','Se ha editado correctamente la clasificación de activo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClasificacionesActivos  $clasificacionesActivos
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClasificacionesActivos $clasificacionesActivos)
    {
        //
    }
}
