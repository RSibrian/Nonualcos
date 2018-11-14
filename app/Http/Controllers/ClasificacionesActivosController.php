<?php

namespace App\Http\Controllers;

use App\ClasificacionesActivos;
use Illuminate\Http\Request;
use App\TipoLeyes;

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
      $tiposLey=TipoLeyes::pluck('nombreLey','id','valorProcentaje');
      return view('clasificaciones.create',compact('tiposLey'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      ClasificacionesActivos::create($request->all());
      return redirect('/clasificaciones')->with('create','Sea creado con éxito la Clasificacion');
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
      $tiposLey=TipoLeyes::pluck('nombreLey','id','valorProcentaje');
      return view('clasificaciones.edit',compact('clasificacionesActivos','tiposLey'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClasificacionesActivos  $clasificacionesActivos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClasificacionesActivos $clasificacionesActivos)
    {
      $clasificacionesActivos->update($request->all());
      return redirect('/clasificaciones')->with('update','Sea editado con éxito la clasificacion');
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
