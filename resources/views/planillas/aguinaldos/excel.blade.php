<?php
$mes=date("m");
$dias=date("t");
$anno=date("Y");
$actual=date("d/m/Y");

$fecha_fin_mes = date($anno."-".$mes."-01");
$inicio=date($anno."-".$mes."-01");

$fecha_fin_mes =date("Y-m-d", strtotime("$fecha_fin_mes +1 month"));
$ultimo =date("Y-m-d", strtotime("$fecha_fin_mes -1 days"));
?>
<table >
    <thead>
    <tr>
        <td colspan="9" align="center">ASOCIACIÓN DE MUNICIPIOS LOS NONUALCOS </td>

    </tr>
    <tr>
        <td colspan="9" align="center">PLANILLA DE SALARIOS MENSUAL - FONDOS CTA BANCO CUENTAS</td>
    </tr>
    <tr></tr>
    <tr>
        <td colspan="2"> PERIODO DE PAGO: DESDE: {{$inicio}}</td>
        <td colspan="1"> HASTA: {{$ultimo}}</td>
        <td></td>
        <td colspan="4">SISTEMA DE CONTRATACIÓN</td>
        <td></td>
    </tr>
    <tr>
        <td>MES</td>
        <td>{{$mes."/".$anno}}</td>
        <td colspan="2"></td>
        <td colspan="4">FECHA DE EMISIÓN: {{$actual}}</td>
        <td></td>
    </tr>

    <tr style="background: #00acc1">
        <th>#</th>
        <th>Nombres</th>
        <th>Cargo</th>
        <th>Expresion</th>
        <th>Dias</th>
        <th>Sueldos y Descuentos</th>
        <th>Total de descuentos</th>
        <th>Liquido a pagar</th>
        <th>Firma de recibido</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $cont=0;
        $total_salarios=0;
        $total_salarios=0;
        $total_ISSS=0;
        $total_AFP=0;
        $total_renta=0;
        $total_prestamo=0;
        $total_llegadas=0;
        $total_AFP_patron=0;
        $total_ISSS_patron=0;
        $total_descuentos_final=0;
        $total_liquido=0;
        $aportaciones=\App\Aportaciones::where('tipoAportacion',2)->get();
        foreach ($aportaciones as $aportacion) {
            $aportacion->desPatronAportacion=0;
        }
    ?>

    @foreach ($empleados as $empleado)
        <?php
        $total_salarios+=round($empleado->salario_ganado,2);
        $total_ISSS+=round($empleado->ISSS,2);
        $empleado->idAFP;
        foreach ($aportaciones as $aportacion) {
            if($aportacion->id==$empleado->idAFP)
                {
                    $aportacion->total+=$empleado->AFP_empleado;
                    $aportacion->total_patron+=$empleado->AFP_Patron;
                }
        }
        $total_renta+=round($empleado->descuento_renta,2);
        if($empleado->prestamoBandera)
            $total_prestamo+=round($empleado->tota_pre,2);
        $total_descuentos_final+=round($empleado->total_descuentos,2);
        $total_liquido+=round($empleado->liquido,2);;


        ?>
        <tr>
            <?php $cont++;?>
            <td>{{$cont}}</td>
            <td>{{$empleado->nombresEmpleado." ".$empleado->apellidosEmpleado}}</td>
            <td>{{$empleado->cargo->nombreCargo}} $&nbsp;{{\Helper::dinero($empleado->salarioBruto)}}</td>
            <td>0101</td>
            <td>{{  $empleado->dias_trabajados}}</td>
            <td>$&nbsp;{{\Helper::dinero(round($empleado->salario_ganado, 2))}}</td>
            <td></td>
            <td></td>
            <td>Cheque No.</td>
        </tr>
        <tr>
            <td></td>
            <td><b>Descuentos de ley</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{"DUI: $empleado->DUIEmpleado"}}</td>
        </tr>

        <tr>
            <td></td>
            <td>Renta</td>
            <td></td>
            <td></td>
            <td></td>
            <td style="color: #cc2127";>${{\Helper::dinero(round($empleado->descuento_renta, 2))}}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td></td>
            <th>Otros Descuentos</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @if($empleado->prestamoBandera==true)
        @foreach ($empleado->descuentos_var as $descuento)
            <tr>
                <td></td>
                @if($descuento->tipoDescuento==1)
                    <td>Prestamo {{$descuento->banco->ban_nombre}}</td>
                @endif
                @if($descuento->tipoDescuento==2)
                    <td>Cuota Alimentaria {{$descuento->banco->ban_nombre}}</td>
                @endif
                @if($descuento->tipoDescuento==3)
                    <td>Otros {{$descuento->banco->ban_nombre}}</td>
                @endif
                <td></td>
                <td></td>
                <td></td>
                <td style="color: #cc2127"; >${{\Helper::dinero(round($descuento->pago, 2))}}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
        @endif
        <tr>
            <td></td>
            <td><b>TOTAL:</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="color: #cc2127">$ {{\Helper::dinero(round($empleado->total_descuentos,2))}}</td>
            <td style="color: #1f648b">$ {{\Helper::dinero(round($empleado->liquido,2))}}</td>
            <td>FIRMA:</td>
        </tr>

        <tr style="background: #00acc1">
            <td colspan="9"></td>
        </tr>

    @endforeach


    </tbody>
</table>


<table>
    <tr>
        <td></td>
        <th colspan="2" align="center">Total de Fondos de Pensiones Empleados</th>
        <td></td>
        <th colspan="2" align="center">Total de Fondos de Pensiones Patron</th>
    </tr>
    <tr>
        <td></td>
        <th>Aportacion</th>
        <th>Total</th>
        <td></td>
        <th>Aportacion</th>
        <th>Total</th>
    </tr>

    @foreach ($aportaciones as $aportacion)
        <tr>
            <td></td>
            <td>{{$aportacion->nombreAportacion}}</td>
            <td> $ {{\Helper::dinero(round($aportacion->total,2))}}</td>
            <td></td>
            <td>{{$aportacion->nombreAportacion}}</td>
            <td> $ {{\Helper::dinero(round($aportacion->total_patron,2))}}</td>
        </tr>
    @endforeach
    <tr>
        <td></td>
        <th>Total</th>
        <td>$ {{\Helper::dinero(round($total_AFP,2))}}</td>
        <td></td>
        <th>Total</th>
        <td>$ {{\Helper::dinero(round($total_AFP_patron,2))}}</td>
    </tr>
</table>
<table>

    <tr>
        <th></th>
        <th>Concepto</th>
        <th>Montos</th>
    </tr>
    <tr>
        <td></td>
        <td>Total Salarios </td>
        <td align="right">$ {{\Helper::dinero(round($total_salarios,2))}}</td>
    </tr>
    <tr>
        <td></td>
        <td>Total de ISSS</td>
        <td align="right">  ${{\Helper::dinero(round($total_ISSS,2))}}</td>
        <td>ISSS patronal</td>
        <td align="right">  ${{\Helper::dinero(round($total_ISSS_patron,2))}}</td>
    </tr>
    <tr>
        <td></td>
        <td>Total de AFP</td>
        <td align="right"> $ {{\Helper::dinero(round($total_AFP,2))}}</td>
    </tr>
    <tr>
        <td></td>
        <td>Total de Retención de Renta</td>
        <td align="right"> $ {{\Helper::dinero(round($total_renta,2))}}</td>
    </tr>
    <tr>
        <td></td>
        <td>Total de Llegadas Tarde</td>
        <td align="right"> $ {{\Helper::dinero(round($total_llegadas,2))}}</td>
    </tr>

    <tr>
        <td></td>
        <td>Total de Prestamos</td>
        <td align="right"> $ {{\Helper::dinero(round($total_prestamo,2))}}</td>
    </tr>

    <tr>
        <td></td>
        <th>Total de Descuentos</th>
        <td align="right"> $ {{\Helper::dinero(round($total_descuentos_final,2))}}</td>
    </tr>

</table>
<table>
    <tr>
        <td></td>
        <th>Total a pagar</th>
        <td align="right"> $ {{\Helper::dinero(round($total_liquido,2))}}</td>
    </tr>
</table>


