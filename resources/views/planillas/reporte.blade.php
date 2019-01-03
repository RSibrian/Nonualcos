<?php
$meses = array("default","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$mes=date("m");
$dias=date("t");
$anno=date("Y");
$fecha_fin_mes = date($anno."-".$mes."-01");
$fecha_fin_mes =date("Y-m-d", strtotime("$fecha_fin_mes +1 month"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta >
    <meta http-equiv="Content-Type" content="text/html;" charset="UTF-8">
    <title>Boleta de pago</title>
    <style>
        .page-break {
            page-break-after: always;
        }
        body {
            font-family: 'Source Sans Pro', sans-serif;
            font-weight: 300;
            font-size: 12px;
            width:100%;
            height: 100%;
        }
        section
        {
            width: 100%;
            height: 50%;

            opacity: 0.30;
        }
        .azul{
            background: rgba(76, 175, 80, 0.10)
        }
        /*background-image: url('/Nonualcos/public/img/escudo123.jpg');
        opacity: 0.30;*/
    </style>
</head>
<body>
<?php $cont=0;?>
@foreach ($empleados as $empleado)
    <?php
    $permisos=$empleado->permisos;
    $dias=date("t");
    $dias_permios_sin_goce=0;
    $dias_incapacidad=0;
    $dias_maternidad=0;
    $salario_x_incapacidad=0;
    $p=0;
    $i=0;
    $m=0;
    $diaPermisos=\App\Permiso::diaPermisoDB($empleado->id,$fecha_fin_mes);
    foreach ($diaPermisos as $diaPermiso)
    {
        //dd($diaPermiso);
        if($diaPermiso->tipoPermiso==2) $dias_permios_sin_goce+=$diaPermiso->dip_dias;
        else if ($diaPermiso->casoPermiso=="8") $dias_maternidad+=$diaPermiso->dip_dias;
        else if ($diaPermiso->tipoPermiso==4 || $diaPermiso->tipoPermiso==5) $dias_incapacidad+=$diaPermiso->dip_dias;
    }

    $dias_trabajados=$dias;
    $salario=$empleado->salarioBruto;
    $salario_diario=$salario/$dias;

    if($dias_trabajados>0)
        if($dias_trabajados>$dias_permios_sin_goce)
        {
            $p=$dias_permios_sin_goce;
            $dias_trabajados-=$dias_permios_sin_goce;
        }
        else{
            $p=$dias_trabajados;
            $dias_trabajados=$dias_trabajados-$p;
        }
    if($dias_trabajados>0){
        if($dias_trabajados>$dias_maternidad)
        {
            $m=$dias_maternidad;
            $dias_trabajados-=$dias_maternidad;
        }
        else{
            $m=$dias_trabajados;
            $dias_trabajados=$dias_trabajados-$m;
        }
    }
    if($dias_trabajados>0) {
        if($dias_trabajados>$dias_incapacidad)
        {
            $dias_trabajados-=$dias_incapacidad;
            $i=$dias_incapacidad;
            $salario_x_incapacidad=($salario_diario*0.25)*$dias_incapacidad;
        }
        else{
            $i=$dias_trabajados;
            $dias_trabajados=$dias_trabajados-$i;
            $salario_x_incapacidad=($salario_diario*0.25)*$i;
        }
    }
    $salario=$empleado->salarioBruto;//500
    $salario_diario=$salario/$dias;//500/31=16.1290
    $salario_ganado=$salario_diario*$dias_trabajados;//fataria descontar dias por permisos sin goce
    // y aplicar las incapacides
    $ISSS=0;
    $AFP=0;
    if($salario_ganado>=1000)
    {
        $ISSS=30;
    }
    else
    {
        $ISSS = $empleado->seguro->desEmpleadoAportacion * $salario_ganado;//3*500=
        $ISSS=$ISSS/100;//1500/100=15
    }
    $AFP_nombre=$empleado->AFP->nombreAportacion;//nombre
    $AFP=$salario_ganado*$empleado->AFP->desEmpleadoAportacion;//500*7.25=
    $AFP=$AFP/100;
    //salario ganado tengo descontar llegadas tardias?
    $descuentos=$empleado->descuentos()->where('estadoDescuento',true)->get();
    $descuento_prestamo=0;
    $descuentos_alimeticios=0;
    $otros=0;
    foreach ($descuentos as $descuento)
    {

        if($descuento->tipoDescuento==1) $descuento_prestamo+=$descuento->pago;
        else if($descuento->tipoDescuento==2) $descuentos_alimeticios+=$descuento->pago;
        else $otros+=$descuento->pago;

    }

    $total_descuentos=$AFP;
    $salario_descuentos=$salario_ganado-$total_descuentos;
    if($salario_descuentos!=0)
    {
        $renta=\App\Renta::where('desde','<=',$salario_descuentos)->where('hasta','>=',$salario_descuentos)->get();
        $salario_exceso=$salario_descuentos-$renta->first()->sobreExceso;
        $descuento_renta = ($salario_exceso * ($renta->last()->porcentaje / 100)) + $renta->last()->cuotaFija;
    }
    else {
        $salario_exceso=0;
        $descuento_renta=0;
    }
    $total_descuentos=$descuento_renta+$ISSS+$AFP;
    $liquido=$salario_ganado-$total_descuentos;
    $tota_pre=$descuentos_alimeticios+$descuento_prestamo+$otros;
    $prestamoBandera=false;
    if($liquido>=$tota_pre){
        $prestamoBandera=true;
        $total_descuentos+=$tota_pre;// le restamos la cuota alimenticia al liquido
    }
    $liquido=$salario_ganado-$total_descuentos;
    ?>
    @for($i=0;$i<2;$i++)
        <section>
            <table height=50% width="100%"  border="0"  >
                <tr>
                    <td colspan="6" align="center">ASOCIACIÓN DE MUNICIPIOS LOS NONUALCOS</td>
                </tr>
                <tr>
                    <td colspan="6" align="center">Boleta de Pago Corespondiente al mes de {{$meses[$mes]}} del {{$anno}}</td>
                </tr>
                <tr>
                    <th>DUI: </th>
                    <td>{{$empleado->DUIEmpleado}}</td>
                    <th>Nombre del empleado: </th>
                    <td colspan="4">{{"$empleado->nombresEmpleado $empleado->apellidosEmpleado"}}</td>

                </tr>
                <?php $date = new DateTime($empleado->fechaIngreso); ?>
                <tr>
                    <td colspan="2"><b>Unidad:</b> {{$empleado->cargo->unidad->nombreUnidad}}</td>
                    <td colspan="2"><b>Cargo:</b> {{$empleado->cargo->nombreCargo}}</td>
                    <th>Fecha Ingreso: </th>
                    <td>{{$date->format('d/m/Y')}}</td>
                </tr>
                <tr>
                    <th>Dias Laborados: </th>
                    <td>{{$dias_trabajados}}</td>
                    <th>Horas Laboradas: </th>
                    <td>8</td>
                    <th>Régimen Laboral </th>
                    <td>{{$empleado->sistemaContratacion}}</td>
                </tr>
                <tr><td colspan="6">&nbsp;</td></tr>
            </table >
            <table  height=50% width="100%" >
                <tr class="azul">
                    <th colspan="2">Concepto</th>
                    <th colspan="2">Haberes</th>
                    <th colspan="2">Descuentos</th>
                </tr>
                <tr>
                    <td colspan="2">Salario</td>
                    <td colspan="2">$ {{number_format(round($salario_ganado,2), 2, '.', ',')}}</td>
                    <td colspan="2" >-</td>
                </tr>
                <tr>
                    <td colspan="2">Descuentos minutos tarde: </td>
                    <td colspan="2">-</td>
                    <td colspan="2" align="left">-</td>
                </tr>
                <tr>
                    <td colspan="2">{{$empleado->seguro->nombreAportacion}}</td>
                    <td colspan="2">-</td>
                    <td colspan="2" align="left">$ {{number_format($ISSS, 2, '.', ',')}}</td>
                </tr>
                <tr>
                    <td colspan="2">{{$empleado->AFP->nombreAportacion}}</td>
                    <td colspan="2">-</td>
                    <td colspan="2" align="left">$ {{number_format($AFP, 2, '.', ',')}}</td>
                </tr>
                <tr>
                    <td colspan="2">Retención de Renta: </td>
                    <td colspan="2">-</td>
                    <td colspan="2" align="left">$ {{number_format($descuento_renta, 2, '.', ',')}}</td>
                </tr>

                @if($prestamoBandera)
                    @foreach ($descuentos as $descuento)
                        <tr>
                            @if($descuento->tipoDescuento==1)
                                <td colspan="2">Prestamo {{$descuento->banco->ban_nombre}}</td>
                            @endif
                            @if($descuento->tipoDescuento==2)
                                <td colspan="2">Cuota Alimentaria {{$descuento->banco->ban_nombre}}</td>
                            @endif
                            @if($descuento->tipoDescuento==3)
                                <td colspan="2">Otros {{$descuento->banco->ban_nombre}}</td>
                            @endif
                            <td colspan="2">-</td>
                            <td colspan="2">$ {{number_format($descuento->pago, 2, '.', ',')}}</td>

                        </tr>
                    @endforeach
                @endif
                <tr style="border-bottom: 6px solid red;">
                    <td></td>
                    <td colspan="1" align="right" style="border-top: 3px solid black;"> Totales</td>
                    <td colspan="2" style="border-bottom: 3px solid black; border-top: 3px solid black;">$ {{number_format(round($salario_ganado,2), 2, '.', ',')}}</td>
                    <td colspan="2" style="border-bottom: 3px solid black; border-top: 3px solid black;" align="left">$ {{number_format(round($total_descuentos,2), 2, '.', ',')}}</td>
                </tr>

                <tr class="azul">
                    <td></td>
                    <td></td>
                    <td  colspan="2" align="right"><b>Total a Pagar</b></td>
                    <td colspan="2" align="left"><b>$ {{number_format(round($liquido,2), 2, '.', ',')}}</b></td>
                </tr>

                <tr>
                    <td colspan="6"></td>
                </tr>
                <tr>
                    <td colspan="6"></td>
                </tr>

            </table>
            <table border="0"  height=50% width="100%" >
                <tr><td colspan="6">&nbsp;</td></tr>
                <tr><td colspan="6">&nbsp;</td></tr>
                <tr>
                    <td colspan="3" align="center">________________________________________</td>
                    <td colspan="3" align="center">________________________________________</td>
                </tr>
                <tr>
                    <td colspan="3" align="center">
                        Lic. Fredy Aristides Rodriguez Carranza
                    </td>
                    <td colspan="3" align="center">
                        {{"$empleado->nombresEmpleado $empleado->apellidosEmpleado"}}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="center">Contador</td>
                    <td colspan="3" align="center">
                        @if($empleado->generoEmpleado=='Masculino')
                            Empleado
                        @else
                            Empleada
                        @endif
                    </td>
                </tr>
            </table>
        </section>

    @endfor
    <div class="page-break"></div>
@endforeach
</body>
</html>
