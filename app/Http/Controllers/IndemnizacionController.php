<?php

namespace App\Http\Controllers;

use App\Indemnizacion;
use Illuminate\Http\Request;
use App\Empleado;
use App\User;
use App\ActivosUnidades;
use App\Vale;
use App\Descuento;
use Illuminate\Support\Facades\Session;
use DateTime;

class IndemnizacionController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $empleados=Empleado::where('estadoEmpleado',1)->get();

    return view('indemnizaciones.index',compact('empleados'));
  }

  public function make(Request $request)
  {
    // dd($request);
    $empleados=Empleado::find($request->empleadosId);

    //salario mínimo vigente
    $min=300.00;

    $indemnizaciones=collect();
    $fechaFin=new DateTime($request->fechaFin);
    $motivo=$request->motivo;
    foreach ($empleados as $empleado) {
      $i['empleado']=$empleado;

      //$fechaInicio=Carbon::parse($empleado->fechaIngreso);
      $fechaInicio=new DateTime($empleado->fechaIngreso);

      $dif=$fechaInicio->diff($fechaFin);
      //Años
      $i['years']=(int)$dif->format('%y');
      //meses
      $i['months']=(int)$dif->format('%m');
      //días
      $i['dias']=(int)$dif->format('%d');

      //$diasAntes = $fechaInicio->modify('last day of this month');

      //si los días de diferencia son de 30 o 31 se cuentan como un mes.
      if($i['dias']>=30){
        $i['months']++;
        if ($i['months']>11) {
          $i['years']++;
          $i['months']=$i['months']-12;
        }
        $i['dias']=0;
      }
      //Si es por Despido
      if($motivo=="Despido"){
        /*según el Código de Trabajo, para el cálculo de indemnización, ningún salario puede ser mayor a 4 veces el salario mínimo diario legal vigente.*/
        $empleado->salarioBruto>($min*4)
        ?$salario=$min*4
        :$salario=$empleado->salarioBruto;
        //un salario mensual por año y su equivalente por los meses trabajados.
      $i['monto']=($salario*$i['years'])
      +(($salario/12)*$i['months'])
      +(($salario/360)*$i['dias']);

      //De acuerdo con la Ley, la indemnización no puede ser menor al salario básico de 15 días.
      $basico=($salario/30)*15;
      if($i['monto']<$basico&&$i['years']>0){$i['monto']=$basico;}

    }

      //Si es por Renuncia Voluntaria
      //Esta prestación está establecida en la Ley Reguladora de la Prestación Económica por Renuncia Voluntaria
      if($motivo=="Renuncia Voluntaria"){
        //El cálculo no puede hacerse por un monto máximo al de 2 salarios mínimos.
        $empleado->salarioBruto>($min*2)
        ?$salario=$min*2
        :$salario=(($empleado->salarioBruto/30)*15);

      $i['monto']=($salario*$i['years'])
      +(($salario/12)*$i['months'])
      +(($salario/360)*$i['dias']);
    }

      if($i['years']>0){
        if ($i['years']==1) $i['years']=$i['years']." año ";
        else $i['years']=$i['years']." años ";
      }else $i['years']="";

      if($i['months']>0){
        if ($i['months']==1) $i['months']=$i['months']." mes ";
        else $i['months']=$i['months']." meses ";
      }else $i['months']="";
      if($i['dias']>0) $i['dias']=$i['dias']." días. ";
      else $i['dias']="";

      $i['tiempo']=$i['years'].$i['months'].$i['dias'];
      if ($i['years']<2 && $motivo=="Renuncia Voluntaria") {
        $i['tiempo']="No aplica (menos de dos años)";
        $i['monto']=0;
      }
      $indemnizaciones->push($i);
    }
    //dd($indemnizaciones);

    $fechaFin=\Carbon\Carbon::parse($request->fechaFin);
    return view('indemnizaciones.tabla',compact('indemnizaciones','fechaFin','motivo'));
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
  public function store(Request $request)
  {
    //
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Indemnizacion  $indemnizacion
  * @return \Illuminate\Http\Response
  */
  public function show(Indemnizacion $indemnizacion)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Indemnizacion  $indemnizacion
  * @return \Illuminate\Http\Response
  */
  public function edit(Indemnizacion $indemnizacion)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Indemnizacion  $indemnizacion
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, Indemnizacion $indemnizacion)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Indemnizacion  $indemnizacion
  * @return \Illuminate\Http\Response
  */
  public function destroy(Indemnizacion $indemnizacion)
  {
    //
  }

  public function bajaEmpleado(Empleado $empleado)
  {
    $activos = ActivosUnidades::where('idEmpleado',$empleado->id)->where('estadoUni',1)->get();
    $descuentos= Descuento::where('idEmpleado',$empleado->id)->where('estadoDescuento',1)->get();
    $vales = Vale::where('estadoRecibidoVal',0)->where('empleadoRecibeVal',$empleado->id)->get();

    return view('indemnizaciones.bajaEmpleado',compact('empleado','activos','descuentos','vales'));
  }

  public function desactivarEmpleado(Request $request)
  {
    $empleado = Empleado::find($request->idEmpleado);
    if($empleado){
      $empleado->estadoEmpleado=0;
      $empleado->save();

      $user= User::where('idEmpleado',$empleado->id)->first();

      if($user){
        $user->idEmpleado=null;
        $user->password=bcrypt('nonualcos');
        $user->save();
      }
      Session::flash('update','Empleado desactivado');
      echo json_encode('true');

    }else echo json_encode('false');
  }

}
