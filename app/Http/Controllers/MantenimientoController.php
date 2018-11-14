<?php

namespace App\Http\Controllers;

use App\Mantenimiento;
use App\Activos;
use Carbon\Carbon;

use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $mantenimientos=Mantenimiento::All();
      return view('mantenimientos.index',compact('mantenimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $activos=Activos::pluck('nombreActivo','id');
      $date = Carbon::now();
      return view('mantenimientos.create',compact('date','activos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Mantenimiento::create($request->all());
      return redirect('/mantenimientos')->with('create','Se ha registrado con éxito el mantenimiento');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Mantenimiento $mantenimiento)
    {
      return view('mantenimientos.show',compact('mantenimiento'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Mantenimiento $mantenimiento)
    {

      $activos=Activos::pluck('nombreActivo','id');
      $date = Carbon::now();
      return view('mantenimientos.edit',compact('date','activos','mantenimiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mantenimiento $mantenimiento)
    {
        $mantenimiento->update($request->all());
        return redirect('/mantenimientos')->with('update','La actualización del mantenimiento se ha realizado con éxito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mantenimiento $mantenimiento)
    {
        //
    }
}
