<?php

namespace App\Http\Controllers;
use App\Activos;
use App\Unidades;
use App\Empleado;
use Carbon\Carbon;
use App\ActivosUnidades;
use App\ClasificacionesActivos;

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

          $activoUpdate=Activos::find($request['idActivo']);

      if($activoUpdate->codigoInventario!=null){

          //ya existe una asignacion
          $traslado->fechaFinalUni=$request['fechaInicioUni'];
          $traslado->estadoUni=false;
          $traslado->save();
          ActivosUnidades::create($request->all());
          return redirect("/activosUnidades/" . $request['idActivo'])->with('create', 'Sea creado con éxito el traslado');

        }else{
          // cuando no existe una asignacion
          $unidad = Unidades::find($request['idUnidad']);
          $clasificacion = ClasificacionesActivos::find($activoUpdate->idClasificacionActivo);

          //para correlativo por unidad
          $activosUnidades=ActivosUnidades::where('idUnidad',$request['idUnidad'])->where('estadoUni',true)->get();
          //$activosUnidades=ActivosUnidades::where('estadoUni',true)->get(); //correlativo global
          //  $activos=Activos::All();
          $contador=1;
          foreach ($activosUnidades as  $traslado) {
            $activo=$traslado->activo;
            if($activo->idClasificacionActivo==$activoUpdate->idClasificacionActivo){
              $contador++;
            }
          }
        //  dd($contador);
          if($contador>99){
              $var=$contador;
          }else if($contador>9){
            $var="0".$contador;
          }else{
            $var="00".$contador;
          }
          //actualizamos activo y le colocamos el numero de placa
          $activoUpdate->codigoInventario="ALN".$unidad->codigoUnidad.$clasificacion->codigoTipo.$var;
          $activoUpdate->save();
          //tabla activos_unidad

          $request['idActivo']=$activoUpdate->id;
          ActivosUnidades::create($request->all());


        }

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
