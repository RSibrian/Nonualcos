<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\planilla;
use App\Renta;
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
        $empleados=Empleado::all();
        return view('planillas.index',compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleados=Empleado::all();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\planilla  $planilla
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
        $mes=date("m");
        $dias=date("t");
        echo "mes actual = ".$mes."<br>";
        echo "dias del mes = ".$dias."<br>";
        $salario=$empleado->salarioBruto;
        $salario_diario=$salario/$dias;
        $salario_ganado=$salario_diario*$dias;

        if($salario_ganado>=1000)
        {
            $ISSS=30;
        }
        else
        {
            $ISSS = $empleado->seguro->desEmpleadoAportacion * $salario_ganado;
            $ISSS=$ISSS/100;
        }
        $AFP_nombre=$empleado->AFP->nombreAportacion;
        $AFP=$salario_ganado*$empleado->AFP->desEmpleadoAportacion;
        $AFP=$AFP/100;

        //salario ganado tengo descontar llegadas tardias?
        $salario_descuentos=$salario_ganado-$ISSS-$AFP;
        $renta=Renta::where('desde','<=',$salario_descuentos)->where('hasta','>=',$salario_descuentos)->get();
        $salario_exceso=$salario_descuentos-$renta->last()->sobreExceso;
        $descuento_renta = ($salario_exceso * ($renta->last()->porcentaje / 100)) + $renta->last()->cuotaFija;
        echo $empleado->nombresEmpleado."<br>";
        echo "Salario BRUTO = ".$salario."<br>";
        echo "Salario Diario = ".round($salario_diario,2)."<br>";
        echo "Salario Ganado = ".round($salario_ganado,2)."<br>";
        echo " ISSS = ". round($ISSS, 2)."<br>";
        echo $AFP_nombre."  = ". round($AFP, 2)."<br>";
        echo "Salario después de descuentos = ". round($salario_descuentos,2)."<br>";
        echo "tramo ".$renta->last()->tramo."<br>";
        echo "cuota fija = ".$renta->last()->cuotaFija."   -- Exceso = ".$salario_exceso.' ----- ';
        echo  "porcentaje = ".$renta->last()->porcentaje."<br>";
        echo "descontar de renta = ". $descuento_renta."<br>";
        $liquido=$salario_descuentos-$descuento_renta;
        echo "Líquido = ". $liquido."<br>";
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
        $empleados=Empleado::All();
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
}
