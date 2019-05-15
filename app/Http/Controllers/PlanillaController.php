<?php

namespace App\Http\Controllers;

use App\AjusteRenta;
use App\DiaPermiso;
use App\Empleado;
use App\EmpleadoPlanilla;
use App\Helpers\Helper;
use App\Planilla;
use App\Renta;
use App\Salidas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PlanillaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados=PlanillaController::planilla();
        return view('planillas.index',compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleados=PlanillaController::planilla();
        $date=date("d-m-Y");

        Excel::create("Planilla de empleados $date ", function ($excel) use ($empleados) {
            $excel->setTitle("Title");
            $excel->sheet("Planilla Empleados", function ($sheet) use ($empleados) {

                $sheet->loadView('planillas.excel')->with('empleados', $empleados);
            });

        })->download('xlsx');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empleados = PlanillaController::planilla();
        Planilla::create([
            'concepto'=>$request['concepto'],
            'mes'=>date("m"),
            'anno'=>date("Y"),
            'fechaPago'=>date('Y-m-d'),
        ]);
        $planilla_last=Planilla::all()->last();
        foreach ($empleados as $empleado){
            EmpleadoPlanilla::create([
                'idEmpleado'=>$empleado->id,
                'idPlanilla'=>$planilla_last->id,
                'unidad'=>$empleado->cargo->unidad->nombreUnidad,
                'cargo'=>$empleado->cargo->nombreCargo,
                'salario'=>round($empleado->salarioBruto,2),
                'dias'=>$empleado->dias_trabajados,
                'salarioDevengado'=>round($empleado->salario_ganado,2),
                'ISSS'=>round($empleado->ISSS,2),
                'idAFP'=>$empleado->idAFP,
                'AFP'=>round($empleado->AFP_empleado,2),
                'renta'=>round($empleado->descuento_renta,2),
                'totalDescuentos'=>round($empleado->total_descuentos,2),
                'sueldoNeto'=>round($empleado->liquido,2),
                'llegadasTarde'=>round($empleado->descuento_tiempo,2),
                'ISSSPatronal'=>round($empleado->ISSS_patron,2),
                'AFPPatronal'=>round($empleado->AFP_Patron,2)
            ]);
            AjusteRenta::create([
                'idEmpleado'=>$empleado->id,
                'salario'=>round($empleado->salario_ganado,2),
                'AFP'=>round($empleado->AFP_empleado,2),
                'renta'=>round($empleado->descuento_renta,2)
            ]);
            foreach ($empleado->diaPermisos_var as $diaPermiso2) {
                $diaPermiso=DiaPermiso::find($diaPermiso2->id);
                if ($diaPermiso2->tipoPermiso == 2) {
                    if ($diaPermiso->dip_dias > $empleado->p) {
                        $diaPermiso->dip_dias-=$empleado->p;
                        $empleado->p = 0;
                    } else {
                        $empleado->p-= $diaPermiso->dip_dias;
                        $diaPermiso->dip_dias=0;
                    }
                }
                else if ($diaPermiso2->casoPermiso == "8"){
                    if ($diaPermiso->dip_dias > $empleado->m) {
                        $diaPermiso->dip_dias-=$empleado->m;
                        $empleado->m = 0;
                    } else {
                        $empleado->m-= $diaPermiso->dip_dias;
                        $diaPermiso->dip_dias=0;
                    }
                }
                else if ($diaPermiso2->tipoPermiso == 4 || $diaPermiso2->tipoPermiso == 5) {
                    if ($diaPermiso->dip_dias > $empleado->i) {
                        $diaPermiso->dip_dias-=$empleado->i;
                        $empleado->i = 0;
                    } else {
                        $empleado->i-= $diaPermiso->dip_dias;
                        $diaPermiso->dip_dias=0;
                    }
                }
                $diaPermiso->save();
                if($diaPermiso->dip_dias==0) {
                    $diaPermiso->delete();
                }
            }
            if($empleado->descuento_tiempo>0 && $empleado->llegadaBandera) {
                $llegadas_tarde_eliminar = $empleado->entradasSalidas()->where('estado', 1)->get();
                $empleado->descuento_tiempo = 0;
                foreach ( $llegadas_tarde_eliminar as $llegada_tarde) {
                    $llegada_tarde->estado=0;
                    $llegada_tarde->save();
                }
            }
        }
        if(intval(date("m"))==12)
        {
            $ajustes=AjusteRenta::all();
            foreach ($ajustes as $ajuste)
            {
                $ajuste->delete();
            }
        }
        return redirect('/empleadoPlanillas')->with('create','Se ha Guardado con exito la planilla');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\planilla  $planilla
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resultado= Salidas::all();
        $indice=0;
        foreach ($resultado as $solicitud) {
            $date =  date('Y-m-d');
            if($date>$solicitud->fechaSalida) $resultado[$indice]->color="#831517";
            else $resultado[$indice]->color="#17A589";
            $resultado[$indice]->start=$solicitud->fechaSalida;
            $resultado[$indice]->end=$solicitud->fechaSalida;
            $resultado[$indice]->title="Número de Placa: ".$solicitud->vehiculo->numeroPlaca;
            $resultado[$indice]->descripcion=$solicitud->destinoTrasladarse?:"No Especificado";
            $resultado[$indice]->nombre=$solicitud->empleados->full_name;
            $resultado[$indice]->destino=$solicitud->destinoTrasladarse?:"No Especificado";
            $resultado[$indice]->mision=$solicitud->mision?:"No Especificado";
            $resultado[$indice]->fecha=Helper::fecha($solicitud->fechaSalida);
            $indice++;
        }
        return response()->json($resultado);
    }
    public function calendario()
    {
        return view('calendario.calendar');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\planilla  $planilla
     * @return \Illuminate\Http\Response
     */
    public function edit(planilla $planilla)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\planilla  $planilla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, planilla $planilla)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\planilla  $planilla
     * @return \Illuminate\Http\Response
     */
    public function destroy(planilla $planilla)
    {
        //
    }
    public function reporte()
    {
        $empleados=PlanillaController::planilla();
        $date = date('d-m-Y');
        $date1 = date('g:i:s a');
        $vistaurl="planillas.reporte";
        $view =  \View::make($vistaurl, compact('empleados', 'date','date1'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper('letter', 'portrait');
         //$pdf->setPaper('A4', 'landscape');
        //return $pdf->download('Reporte planillas '.$date.'.pdf');
        return $pdf->stream('Reporte planillas '.$date.'.pdf');
    }
    static function planilla()
    {
        $mes = date("m");
        $anno = date("Y");
        $fecha_fin_mes = date($anno . "-" . $mes . "-01");
        $fecha_fin_mes = date("Y-m-d", strtotime("$fecha_fin_mes +1 month"));
        $empleados=Empleado::all();//orderBy('apellidosEmpleado', 'asc')->get();
        foreach ($empleados as $empleado) {
            $dias = date("t");
            $mes= date('m');
            if($empleado->estadoEmpleado==0  )
            {
               // dd($empleado->indemnizaciones->last());
                if(isset($empleado->indemnizaciones->last()->fechaFinalizacion))
                {
                    $fecha=date("Y-m-01");
                    if($empleado->indemnizaciones->last()->fechaFinalizacion>=$fecha)
                        $dias=PermisoController::diferenciaFechas($fecha,$empleado->indemnizaciones->last()->fechaFinalizacion);
                    else
                        $dias=0;


                }
            }
            $empleado->dias=$dias;
            $empleado->dias_permios_sin_goce = 0;
            $empleado->dias_incapacidad = 0;
            $empleado->dias_maternidad = 0;
            $empleado->p = 0;
            $empleado->i = 0;
            $empleado->m = 0;
            $empleado->llegadas_tarde = $empleado->entradasSalidas()->where('estado', 1)->get();
            $empleado->descuento_tiempo = 0;
            foreach ( $empleado->llegadas_tarde as $llegada_tarde) {
                $empleado->descuento_tiempo += $llegada_tarde->costoTiempo;
            }
            $empleado->diaPermisos_var = \App\Permiso::diaPermisoDB($empleado->id, $fecha_fin_mes);
            foreach (  $empleado->diaPermisos_var as $diaPermiso) {
                //dd($diaPermiso);
                if ($diaPermiso->tipoPermiso == 2)  $empleado->dias_permios_sin_goce += $diaPermiso->dip_dias;
                else if ($diaPermiso->casoPermiso == "8")  $empleado->dias_maternidad += $diaPermiso->dip_dias;
                else if ($diaPermiso->tipoPermiso == 4 || $diaPermiso->tipoPermiso == 5)  $empleado->dias_incapacidad += $diaPermiso->dip_dias;
            }
            $empleado->dias_trabajados = $dias;
            $salario = $empleado->salarioBruto;
            if($dias>0)
                $empleado->salario_diario = $salario / $dias;
            else  $empleado->salario_diario=0;
            if ( $empleado->dias_trabajados > 0)
                if ( $empleado->dias_trabajados >  $empleado->dias_permios_sin_goce) {
                    $empleado->p =  $empleado->dias_permios_sin_goce;
                    $empleado->dias_trabajados -=  $empleado->dias_permios_sin_goce;
                } else {
                    $empleado->p =  $empleado->dias_trabajados;
                    $empleado->dias_trabajados =  $empleado->dias_trabajados -  $empleado->p;
                }
            if ( $empleado->dias_trabajados > 0) {
                if ( $empleado->dias_trabajados >  $empleado->dias_maternidad) {
                    $empleado->m =  $empleado->dias_maternidad;
                    $empleado->dias_trabajados -=  $empleado->dias_maternidad;
                } else {
                    $empleado->m =  $empleado->dias_trabajados;
                    $empleado->dias_trabajados =  $empleado->dias_trabajados -  $empleado->m;
                }
            }
            if ( $empleado->dias_trabajados > 0) {
                if ( $empleado->dias_trabajados >  $empleado->dias_incapacidad) {
                    $empleado->dias_trabajados -=  $empleado->dias_incapacidad;
                    $empleado->i =  $empleado->dias_incapacidad;
                } else {
                    $empleado->i =  $empleado->dias_trabajados;
                    $empleado->dias_trabajados =  $empleado->dias_trabajados -  $empleado->i;

                }
            }
            $empleado->salario_ganado =  $empleado->salario_diario *  $empleado->dias_trabajados;
            $empleado->ISSS = 0;
            $empleado->ISSS_patron = 0;
            $empleado->AFP_empleado = 0;
            $empleado->AFP_Patron = 0;
            if ( $empleado->salario_ganado >= 1000) {
                $empleado->ISSS = 30;
                $empleado->ISSS_patron = 75;
            } else {
                $empleado->ISSS = $empleado->seguro->desEmpleadoAportacion * $empleado->salario_ganado;
                $empleado->ISSS = $empleado->ISSS / 100;
                $empleado->ISSS_patron = $empleado->seguro->desPatronAportacion * $empleado->salario_ganado;
                $empleado->ISSS_patron = $empleado->ISSS_patron / 100;
            }
            $empleado->AFP_nombre = $empleado->AFP->nombreAportacion;
            $empleado->AFP_empleado = $empleado->salario_ganado * $empleado->AFP->desEmpleadoAportacion;
            $empleado->AFP_empleado = $empleado->AFP_empleado / 100;
            $empleado->AFP_Patron = $empleado->salario_ganado * $empleado->AFP->desPatronAportacion;
            $empleado->AFP_Patron = $empleado->AFP_Patron / 100;
            $empleado->idAFP=$empleado->AFP->id;
            $empleado->descuentos_var = $empleado->descuentos()->where('estadoDescuento', true)->get();
            $empleado->descuento_prestamo = 0;
            $empleado->descuentos_alimeticios = 0;
            $empleado->otros = 0;
            foreach ($empleado->descuentos_var as $descuento) {
                if ($descuento->tipoDescuento == 1) $empleado->descuento_prestamo += $descuento->pago;
                else if ($descuento->tipoDescuento == 2) $empleado->descuentos_alimeticios += $descuento->pago;
                else $empleado->otros += $descuento->pago;
            }
            $empleado->total_descuentos = round($empleado->AFP_empleado,2)+$empleado->ISSS;
            $empleado->salario_descuentos = round($empleado->salario_ganado,2) - $empleado->total_descuentos;

            if ($empleado->salario_descuentos != 0) {
                //ajuste de renta
                if(intval($mes)==6 || intval($mes)==12) {
                    $ajustes=$empleado->ajusteRentas;
                    $salario_ajuste=$empleado->salario_descuentos;
                    $salario_afp_ajuste=0;
                    $salario_renta_ajuste=0;
                    foreach ($ajustes as $ajuste) {
                        $salario_ajuste+=$ajuste->salario;
                        $salario_afp_ajuste+=$ajuste->AFP;
                        $salario_renta_ajuste+=$ajuste->renta;
                    }
                    $salario_descuento_ajuste=$salario_ajuste-$salario_afp_ajuste;
                    if(intval($mes)==6) {
                        $renta = \App\Renta::where('semDesde', '<=', $salario_descuento_ajuste)->where('semHasta', '>=', $salario_descuento_ajuste)->get();
                        $salario_exceso = $salario_descuento_ajuste - $renta[0]->semSobreExceso;
                        $empleado->descuento_renta = ($salario_exceso * ($renta->last()->porcentaje / 100)) + $renta->last()->semCuotaFija;
                    }
                    else {
                        $renta = \App\Renta::where('anuDesde', '<=', $salario_descuento_ajuste)->where('anuHasta', '>=', $salario_descuento_ajuste)->get();
                        $salario_exceso = $salario_descuento_ajuste - $renta[0]->anuSobreExceso;
                        $empleado->descuento_renta = ($salario_exceso * ($renta->last()->porcentaje / 100)) + $renta->last()->anuCuotaFija;
                    }
                    $empleado->descuento_renta=$empleado->descuento_renta-$salario_renta_ajuste;
                    if($empleado->descuento_renta<0)
                        $empleado->descuento_renta=0;
                }
                //renta
                else {
                    $renta = \App\Renta::where('desde', '<=', $empleado->salario_descuentos)->where('hasta', '>=', $empleado->salario_descuentos)->get();
                    $salario_exceso = $empleado->salario_descuentos - $renta[0]->sobreExceso;
                    $empleado->descuento_renta = ($salario_exceso * ($renta->last()->porcentaje / 100)) + $renta->last()->cuotaFija;
                }
            } else {
                $empleado->descuento_renta = 0;
            }
            $empleado->total_descuentos = round($empleado->descuento_renta,2) + round($empleado->ISSS,2) + round($empleado->AFP_empleado,2);
            $empleado->liquido = round($empleado->salario_ganado,2) - $empleado->total_descuentos;
            $empleado->llegadaBandera = false;
            if ($empleado->liquido >= $empleado->descuento_tiempo) {
                $empleado->llegadaBandera = true;
                $empleado->total_descuentos += $empleado->descuento_tiempo;
            }
            $empleado->liquido = round($empleado->salario_ganado,2) - $empleado->total_descuentos;
            $empleado->tota_pre = $empleado->descuentos_alimeticios + $empleado->descuento_prestamo + $empleado->otros;
            $empleado->prestamoBandera = false;
            if ($empleado->liquido >= $empleado->tota_pre) {
                $empleado->prestamoBandera = true;
                $empleado->total_descuentos += $empleado->tota_pre;// le restamos la cuota alimenticia al liquido
            }
            $empleado->liquido = round($empleado->salario_ganado,2) - $empleado->total_descuentos;
        }
      // dd($empleados);
        return $empleados;
    }

}
