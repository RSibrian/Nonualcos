<?php

namespace App\Http\Controllers;

use App\Activos;
use App\ClasificacionesActivos;
use App\Unidades;
use App\Proveedor;
use App\Empleado;
use App\Vehiculo;
use App\Mantenimiento;
use Carbon\Carbon;
use App\BitacoraAccion;


use App\ActivosUnidades;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
class ActivosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $activos=Activos::All();
      return view('activos.index',compact('activos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $clasificaciones=ClasificacionesActivos::pluck('nombreTipo','id');
      $unidades=Unidades::pluck('nombreUnidad','id');
      $proveedores=Proveedor::All()->where('tipoProveedor','!=',2 )->pluck('nombreEmpresa','id');
      $empleados=Empleado::pluck('nombresEmpleado','id');
      $date = Carbon::now();
      return view('activos.create',compact('unidades','clasificaciones','proveedores','date','empleados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    for($cantidad=$request['cantidad']; $cantidad>0; $cantidad--){
      /*tabla activo
      $unidad = Unidades::find($request['idUnidad']);
      $clasificacion = ClasificacionesActivos::find($request['idClasificacionActivo']);
      //para correlativo por unidad
      $activosUnidades=ActivosUnidades::where('idUnidad',$request['idUnidad'])->where('estadoUni',true)->get();
      //$activosUnidades=ActivosUnidades::where('estadoUni',true)->get(); //correlativo global
    //  $activos=Activos::All();
      $contador=1;
      foreach ($activosUnidades as  $traslado) {
        $activo=$traslado->activo;
        if($activo->idClasificacionActivo==$request['idClasificacionActivo']){
          $contador++;
        }
      }
    //dd($contador);
      if($contador>99){
          $var=$contador;
      }else if($contador>9){
        $var="0".$contador;
      }else{
        $var="00".$contador;
      }
      $request['codigoInventario']="ALN".$unidad->codigoUnidad.$clasificacion->codigoTipo.$var;

      Activos::create($request->all());
      //tabla activos_unidad
      $activos=Activos::all();
      $activo=$activos->last();
      $request['idActivo']=$activo->id;
      ActivosUnidades::create($request->all());*/

      //Crear activo
      Activos::create($request->all());
      //tabla vehiculo
      $activos=Activos::all();
      $activo=$activos->last();
      $request['idActivo']=$activo->id;
      if(  $request['tipoActivo']==1)
      {

        //aqui guardar en Vehiculo placa y idActivo
        Vehiculo::create($request->all());
      }
    }
    //bitacora accion
    $clasificacion=ClasificacionesActivos::find($request['idClasificacionActivo']);
    $proveedor=Proveedor::find($request['idProveedor']);
    if($request['tipoAdquisicion']){ $tipo='Compra'; $uso=0;}else{$tipo='Usado';$uso=$request['aniosUso'];}

    $accion="Registro de Activo Fijo";
    $antes=null;
    $despues="Identificador: ".$request['idActivo'].
    " <br> clasificación: ".$clasificacion->nombreTipo.
    " <br> Nombre: ".$request['nombreActivo'].
    " <br> Fecha de Adquisición: ".$request['fechaAdquisicion'].
    " <br> Marca : ".$request['marca'].
    " <br> Modelo : ".$request['modelo'].
    " <br> Color : ".$request['color'].
    " <br> Serie : ".$request['serie'].
    " <br> precio: ".$request['precio'].
    " <br> Proveedor: ".$proveedor->nombreEmpresa.
      " <br> Factura: ".$request['numeroFactura'].
    " <br> Vida Utíl: ".$request['aniosVida'].
    " <br> Tipo de Adquisición: ".$tipo.
    " <br> Años de uso: ".$uso.
    " <br> Estado del Activo: "."Activo".
    " <br> Observacion: ".$request['ObservacionActivo'];


    BitacoraAccion::crearBitacora($accion,$antes,$despues);
    //fin bicora accion

      return redirect('/activos')->with('create','Se creó con éxito el registro de activo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activos  $activos
     * @return \Illuminate\Http\Response
     */
    public function show(Activos $activo)
    {
        return view('activos.show',compact('activo'));
    }

    public function mantenimientosUnidades(Activos $activo)
    {
      $mantenimientos=Mantenimiento::All()->where('idActivo',$activo->id)->sortByDesc('fechaRecepcionTaller');
      //  $mantenimientos=Activos::mantenimientoxUnidad($activo->id);
        if(!empty($mantenimientos)){
          return view('activos.mantenimientosUnidades',compact('activo','mantenimientos'));
        }
        //dd($mantenimientos);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activos  $activos
     * @return \Illuminate\Http\Response
     */
    public function edit(Activos $activo)
    {
      //52dd($activo);
      $clasificaciones=ClasificacionesActivos::pluck('nombreTipo','id');

      $proveedores=Proveedor::pluck('nombreEmpresa','id');
      $date = $activo->fechaAdquisicion;
      //$vehiculo=Activos::vehiculo($activo->id);
      return view('activos.edit',compact('clasificaciones','proveedores','date','activo'));




    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activos  $activos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activos $activos)
    {
      //dd($activos);
      $request['fechaBajaActivo']=Carbon::now();

      $activos->update($request->all());
      //tabla vehiculo
      if($activos->tipoActivo==1)
      {
        $vehiculo = Vehiculo::find($activos->vehiculo->id);
        //aqui guardar en Vehiculo placa y idActivo
      //  dd($vehiculo);
        $vehiculo->update($request->all());
      }
      return redirect('/activos')->with('update','Se ha editado correctamente el activo');
    }

    public function updateDaniado(Request $request, Activos $activos)
    {
      if($request->ajax()){
      $activos->estadoActivo=2;
      $activos->save();
      return response()->json($request->all());
      }
    }

    public function updateBaja(Request $request, Activos $activos)
    {
      if($request->ajax()){
      $activos->justificacionActivo=$request['justificacion'];
      $activos->fechaBajaActivo=Carbon::now();
      $activos->estadoActivo=0;
      $activos->save();
      return response()->json($request->all());
      }
    }
    public function indexDaniados()
    {
      $activos=Activos::All()->where('estadoActivo',2);
      //dd($activos);
      return view('activos.indexDaniados',compact('activos'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activos  $activos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activos $activos)
    {
        //
    }

    public function codigoGenerado(Unidades $unidad){

        $empleados=Empleado::EmpleadosxUnidad($unidad->id);
        //$empleados=DB::select( DB::raw("SELECT * FROM empleados WHERE empleados.idCargo IN (SELECT id FROM `cargos` WHERE cargos.idUnidad=$unidad->id)") );

        return Response::json($empleados);
    }

    public function reporteGeneral()
        {
          //$activos=Activos::All();
          $unidades=Unidades::All();
          $sinCodigoActivos=Activos::All()->where('codigoInventario','==',null);
          $date = date('d-m-Y');
          $date1 = date('g:i:s a');
          $vistaurl="activos.reporteGeneral";
          $view =  \View::make($vistaurl, compact('unidades','sinCodigoActivos', 'date','date1'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          $pdf->setPaper('letter', 'landscape');
          return $pdf->stream('Reporte de Activos '.$date.'.pdf');
        }

        public function generarReporte(){

          $unidades=Unidades::pluck('nombreUnidad','id');
          return view('activos.generarReporte',compact('unidades'));

        }

        public function reportexUnidad(Request $request)
        {


          $unidad=Unidades::find($request['idUnidad']);

          if($request['estadoActivo']!=5){
            $activos=ActivosUnidades::activosxUnidad($request['idUnidad'],$request['estadoActivo']);
          }else{

            $activos=ActivosUnidades::activosxunidadEstado($request['idUnidad']);
          }

          $date = date('d-m-Y');
          $date1 = date('g:i:s a');
          $vistaurl="activos.reportexUnidad";
          $view =  \View::make($vistaurl, compact('activos','unidad', 'date','date1'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          $pdf->setPaper('letter', 'landscape');
          return $pdf->stream('Reporte de Activos por Unidad '.$unidad->nombreUnidad.$date.'.pdf');
        }

        public function reporteDatosActivos($idactivo)
            {

              $activo=Activos::find($idactivo);

              $date = date('d-m-Y');
              $date1 = date('g:i:s a');
              //dd($date);
              $vistaurl="activos.reporteDatosActivos";
              $view =  \View::make($vistaurl, compact('activo', 'date','date1'))->render();
              $pdf = \App::make('dompdf.wrapper');
              $pdf->setPaper('letter', 'portrait');

              $pdf->loadHTML($view);
              return $pdf->stream('Reporte de Datos de Activo '.$activo->codigoInventario.'-'.$date.'.pdf');
            }

        public function reporteDepreAnual($idactivo)
            {

              $activo=Activos::find($idactivo);

              $date = date('d-m-Y');
              $date1 = date('g:i:s a');
              //dd($date);
              $vistaurl="activos.reporteDepreAnual";
              $view =  \View::make($vistaurl, compact('activo', 'date','date1'))->render();
              $pdf = \App::make('dompdf.wrapper');
              $pdf->loadHTML($view);
              $pdf->setPaper('letter', 'landscape');
              return $pdf->stream('Reporte de Depreciación de Activo Anual '.$activo->codigoInventario.'-'.$date.'.pdf');
            }

          public function reporteDepreMensual($idactivo)
              {

                $activo=Activos::find($idactivo);

                $date = date('d-m-Y');
                $date1 = date('g:i:s a');
                //dd($date);
                $vistaurl="activos.reporteDepreMensual";
                $view =  \View::make($vistaurl, compact('activo', 'date','date1'))->render();
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML($view);
                $pdf->setPaper('A4', 'landscape');
                return $pdf->stream('Reporte de Depreciación de Activo Mensual '.$activo->codigoInventario.'-'.$date.'.pdf');
              }




}
