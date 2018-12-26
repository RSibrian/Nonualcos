<?php

namespace App\Http\Controllers;

use App\EntradasSalidas;
use Illuminate\Http\Request;
use App\Empleado;
use Carbon\Carbon;
use App\Http\Requests\EntradasSalidasRequest;


class EntradasSalidasController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EntradasSalidasRequest $request)
    {
      EntradasSalidas::create($request->all());
      return redirect("/entradasSalidas/" . $request['idEmpleado'])->with('create', 'Se ha creado con éxito el registro');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EntradasSalidas  $entradasSalidas
     * @return \Illuminate\Http\Response
     */
     public function show(Empleado $empleado)
     {
         //
         $entradasSalidas=EntradasSalidas::All()->where('idEmpleado',$empleado->id);
         $mes=date("m");
         $anno=date("Y");
         $date = date($anno."-".$mes."-01");

         $date2=Carbon::now();
         return view('entradasSalidas.show',compact('entradasSalidas','date','date2','empleado'));
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EntradasSalidas  $entradasSalidas
     * @return \Illuminate\Http\Response
     */
    public function edit(EntradasSalidas $entradasSalidas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EntradasSalidas  $entradasSalidas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EntradasSalidas $entradasSalidas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EntradasSalidas  $entradasSalidas
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntradasSalidas $entradasSalidas)
    {
        //
    }
}
