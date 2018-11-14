<?php

namespace App\Http\Controllers;
use App\Activos;
use App\Unidades;
use App\Empleado;
use Carbon\Carbon;
use App\ActivosUnidades;
use Illuminate\Http\Request;

class ActivosUnidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $unidades=Unidades::pluck('nombreUnidad','id');
      $empleados=Empleado::pluck('nombresEmpleado','id');
      $date = Carbon::now();
      return view('activosUnidades.create',compact('unidades','date','empleados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //actualizar el registro anterior fecha final y estado
          $traslados=ActivosUnidades::where('idActivo',$request['idActivo'])->get();
          $traslado=$traslados->last();
          $traslado->fechaFinalUni=$request['fechaInicioUni'];
          $traslado->estadoUni=false;
          $traslado->save();
          ActivosUnidades::create($request->all());
          return redirect("/activosUnidades/" . $request['idActivo'])->with('create', 'Sea creado con éxito el traslado');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ActivosUnidades  $activosUnidades
     * @return \Illuminate\Http\Response
     */
    public function show(Activos $activo)
    {
      $unidades=Unidades::pluck('nombreUnidad','id');
      $empleados=Empleado::pluck('nombresEmpleado','id');
      $date = Carbon::now();
      return view('activosUnidades.show',compact('unidades','empleados','activo','date'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ActivosUnidades  $activosUnidades
     * @return \Illuminate\Http\Response
     */
    public function edit(ActivosUnidades $activosUnidades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ActivosUnidades  $activosUnidades
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActivosUnidades $activosUnidades)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ActivosUnidades  $activosUnidades
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActivosUnidades $activosUnidades)
    {
        //
    }
}
