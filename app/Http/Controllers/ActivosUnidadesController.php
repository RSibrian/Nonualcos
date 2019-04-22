<?php

namespace App\Http\Controllers;
use App\Http\Requests\ActivosUnidadesRequest;
use App\Activos;
use App\Unidades;
use App\Empleado;
use Carbon\Carbon;
use App\ActivosUnidades;
use App\ClasificacionesActivos;
use Illuminate\Support\Facades\DB;
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivosUnidadesRequest $request)
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
          return redirect("/activosUnidades/" . $request['idActivo'])->with('create', 'El traslado se ha realizado con éxito');

        }else{
          // cuando no existe una asignacion
          $unidad = Unidades::find($request['idUnidad']);
          $clasificacion = ClasificacionesActivos::find($activoUpdate->idClasificacionActivo);

          //para correlativo por unidad
        //  $activosUnidades=ActivosUnidades::where('idUnidad',$request['idUnidad'])->get();
          //$activosUnidades=ActivosUnidades::where('estadoUni',true)->get(); //correlativo global
            $activos=Activos::All();
          $contador=1;
          foreach ($activos as  $activo) {
            $primerTraslado=$activo->activosUnidades->first();
            if (isset($primerTraslado)) {
              if($activo->idClasificacionActivo==$activoUpdate->idClasificacionActivo && $primerTraslado->idUnidad==$request['idUnidad']){
                $contador++;
              }
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

        return redirect("/activosUnidades/" . $request['idActivo'])->with('create', 'El traslado se ha realizado con éxito');
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
      $empleados=Empleado::all()->where('estadoEmpleado',true)->pluck('full_name','id');


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

    public function reporteTraslado($idtraslado)
    {
          $traslado=ActivosUnidades::find($idtraslado);
          $activo=Activos::find($traslado->idActivo);
          $personalAutoriza=Empleado::find($traslado->idAutoriza);
          $traslados=ActivosUnidades::where('idActivo',$activo->id)->get();
          for($i=0;$i<count($traslados);$i++)  {
            if($traslados[$i]->id==$idtraslado){
              if($i==0){
                $traslado['nombreAntiguo']="Ninguno";
                $traslado['UnidadAntiguo']="Ninguno";
              }else{
                $trasladoAnterior=$traslados[$i-1];
                $traslado['nombreAntiguo']=$trasladoAnterior->empleado->nombresEmpleado." ".$trasladoAnterior->empleado->apellidosEmpleado;
                $traslado['UnidadAntiguo']=$trasladoAnterior->unidad->nombreUnidad;
              }
            }
          }
          $traslado['NombreAutoriza']=$personalAutoriza->nombresEmpleado." ".$personalAutoriza->apellidosEmpleado;
          $date = date('d-m-Y');
          $date1 = date('g:i:s a');
          //dd($date);
          $vistaurl="activosUnidades.reporteTraslado";
          $view =  \View::make($vistaurl, compact('traslado','activo', 'date','date1'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->setPaper('letter', 'portrait');

          $pdf->loadHTML($view);
          return $pdf->stream('Constancia de Traslado '.$activo->codigoInventario.'-'.$date.'.pdf');
        }
}
