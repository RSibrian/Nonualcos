<?php

namespace App\Http\Controllers;

use App\AjusteRenta;
use App\DiaPermiso;
use App\Empleado;
use App\EmpleadoPlanilla;
use App\planilla;
use App\Renta;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class AguinaldoController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($exento)
    {
        $empleados=AguinaldoController::aguinaldo($exento);
        $date=date("d-m-Y");

        Excel::create("Planilla de empleados $date ", function ($excel) use ($empleados) {
            $excel->setTitle("Title");
            $excel->sheet("Planilla Empleados", function ($sheet) use ($empleados) {

                $sheet->loadView('planillas.aguinaldos.excel')->with('empleados', $empleados);
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
        $empleados = AguinaldoController::aguinaldo($request['exoneracion']);
        Planilla::create([
            'concepto'=>$request['concepto'],
            'mes'=>13,
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
                'dias'=>0,
                'salarioDevengado'=>round($empleado->salario_ganado,2),
                'ISSS'=>0,
                'idAFP'=>$empleado->idAFP,
                'AFP'=>0,
                'renta'=>round($empleado->descuento_renta,2),
                'totalDescuentos'=>round($empleado->total_descuentos,2),
                'sueldoNeto'=>round($empleado->liquido,2),
                'llegadasTarde'=>0,
                'ISSSPatronal'=>0,
                'AFPPatronal'=>0
            ]);
            AjusteRenta::create([
                'idEmpleado'=>$empleado->id,
                'salario'=>round($empleado->exceso_aguinaldo,2),
                'AFP'=>0,
                'renta'=>round($empleado->descuento_renta,2)
            ]);
        }
          return redirect('/empleadoPlanillas')->with('create','Se ha Guardado con exito la planilla');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\planilla  $planilla
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request )
    {
      $exento=$request['exoneracion'];
      $empleados=AguinaldoController::aguinaldo($request['exoneracion']);
      return view('planillas.aguinaldos.index',compact('empleados','exento'));

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
    public function reporte($exento)
    {
        $empleados=AguinaldoController::aguinaldo($exento);
        $date = date('d-m-Y');
        $date1 = date('g:i:s a');
        $vistaurl="planillas.aguinaldos.reporte";
        $view =  \View::make($vistaurl, compact('empleados', 'date','date1'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper('letter', 'portrait');
        //$pdf->setPaper('A4', 'landscape');
        //return $pdf->download('Reporte planillas '.$date.'.pdf');
        return $pdf->stream('Reporte Aguinaldo '.$date.'.pdf');
    }
    static function aguinaldo($exento)
    {
        $mes = date("m");
        $anno = date("Y");
        $fecha_fin_mes = date($anno . "-" . $mes . "-01");
        $fecha_fin_mes = date("Y-m-d", strtotime("$fecha_fin_mes +1 month"));
        $empleados=Empleado::all()->where('estadoEmpleado',1);//orderBy('apellidosEmpleado', 'asc')->get();
        foreach ($empleados as $empleado) {
            $dias = date("t");
            $empleado->dias_permios_sin_goce = 0;
            $empleado->dias_incapacidad = 0;
            $empleado->dias_maternidad = 0;
            $empleado->p = 0;
            $empleado->i = 0;
            $empleado->m = 0;
            $empleado->llegadas_tarde = $empleado->entradasSalidas()->where('estado', 1)->get();
            $empleado->descuento_tiempo = 0;

            $empleado->diaPermisos_var = \App\Permiso::diaPermisoDB($empleado->id, $fecha_fin_mes);

            $empleado->dias_trabajados = $dias;
            $salario = $empleado->salarioBruto;
            $empleado->salario_diario = $salario / $dias;
            $empleado->salario_ganado = $empleado->salarioBruto;
            $empleado->ISSS = 0;
            $empleado->ISSS_patron = 0;
            $empleado->AFP_empleado = 0;
            $empleado->AFP_Patron = 0;

            $empleado->AFP_nombre = $empleado->AFP->nombreAportacion;
            $empleado->AFP_empleado = $empleado->salario_ganado * $empleado->AFP->desEmpleadoAportacion;
            $empleado->AFP_empleado = $empleado->AFP_empleado / 100;
            $empleado->idAFP=$empleado->AFP->id;
            $empleado->descuentos_var = $empleado->descuentos()->where('estadoDescuento', true)->where('tipoDescuento',2)->get();
            $empleado->descuento_prestamo = 0;
            $empleado->descuentos_alimeticios = 0;
            $empleado->otros = 0;
            foreach ($empleado->descuentos_var as $descuento) {
               $empleado->descuentos_alimeticios = $empleado->salario_ganado*0.30;
            }
            $empleado->total_descuentos = round($empleado->AFP_empleado,2);
            $empleado->salario_descuentos = round($empleado->salario_ganado,2) - $empleado->total_descuentos;
            $empleado->exceso_aguinaldo=0;
            if(($empleado->salarioBruto-$empleado->descuentos_alimeticios)>=$exento) {
                $empleado->exceso_aguinaldo = ($empleado->salarioBruto-$empleado->descuentos_alimeticios) - $exento;
                //if ($empleado->exceso_aguinaldo < \App\Renta::find(1)->hasta) {
                    $total_Renta = $empleado->salario_descuentos + $empleado->exceso_aguinaldo;
                    if ($empleado->salario_descuentos != 0) {
                        $renta = \App\Renta::where('desde', '<=', $empleado->salario_descuentos)->where('hasta', '>=', $empleado->salario_descuentos)->get();
                        $salario_exceso = $empleado->salario_descuentos - $renta[0]->sobreExceso;
                        $empleado->descuento_renta_menor = ($salario_exceso * ($renta->last()->porcentaje / 100)) + $renta->last()->cuotaFija;

                    } else {
                        $empleado->descuento_renta = 0;
                    }
                    if ($empleado->salario_descuentos != 0) {
                        $renta = \App\Renta::where('desde', '<=', $total_Renta)->where('hasta', '>=', $total_Renta)->get();
                        $salario_exceso = $total_Renta - $renta[0]->sobreExceso;
                        $empleado->descuento_renta_mayor = ($salario_exceso * ($renta->last()->porcentaje / 100)) + $renta->last()->cuotaFija;

                    } else {
                        $empleado->descuento_renta = 0;
                    }
                    $empleado->descuento_renta =  $empleado->descuento_renta_mayor-$empleado->descuento_renta_menor;
            }
            $empleado->total_descuentos = round($empleado->descuento_renta,2);
            $empleado->AFP_empleado=0;
            $empleado->liquido = round($empleado->salario_ganado,2) - $empleado->total_descuentos;
            $empleado->llegadaBandera = false;

            $empleado->tota_pre = $empleado->descuentos_alimeticios;
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
