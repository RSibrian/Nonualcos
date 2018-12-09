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

       // echo  "permisos= ".$p." Maternidad= ".$m." Incapacidad= ".$i. "<br>";

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

        $total_descuentos= $descuento_renta+$ISSS+$AFP;
        $liquido=$salario_ganado-$total_descuentos;
        $tota_pre=$descuentos_alimeticios+$descuento_prestamo+$otros;
        $prestamoBandera=false;
        if($liquido>=$tota_pre){
            $prestamoBandera=true;
            $total_descuentos+=$tota_pre;// le restamos la cuota alimenticia al liquido
        }
        $liquido=$salario_ganado-$total_descuentos;

        ?>
        <tr>
            <?php $cont++;?>
            <td>{{$cont}}</td>
            <td>{{$empleado->nombresEmpleado." ".$empleado->apellidosEmpleado}}</td>
            <td>{{$empleado->cargo->nombreCargo}} $&nbsp;{{number_format($salario, 2, '.', ',')}}</td>
            <td>0101</td>
            <td>{{$dias_trabajados}}</td>
            <td>$&nbsp;{{number_format($salario_ganado, 2, '.', ',')}}</td>
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
            <td >{{$empleado->AFP->nombreAportacion}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td style="color: #cc2127; ">${{number_format($AFP, 2, '.', ',')}}</td>
            <td></td>
            <td></td>
            <td>{{"NIT: $empleado->NITEmpleado"}}</td>
        </tr>
        <tr>
            <td></td>
            <td>{{$empleado->seguro->nombreAportacion}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td style="color: #cc2127;">${{number_format($ISSS, 2, '.', ',')}}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>Renta</td>
            <td></td>
            <td></td>
            <td></td>
            <td style="color: #cc2127";>${{number_format($descuento_renta, 2, '.', ',')}}</td>
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
        @if($prestamoBandera==true)
        @foreach ($descuentos as $descuento)
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
                <td style="color: #cc2127"; >${{number_format($descuento->pago, 2, '.', ',')}}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
        @endif
        @if($i!=0)
        <tr>
            <td></td>
            <td><b>Dias de Incapacidad</b></td>
            <td></td>
            <td></td>
            <td>{{$i}}</td>
            <td></td>
            <td></td>
            <td ></td>
            <td></td>
        </tr>
        @endif
        @if($p!=0)
            <tr>
                <td></td>
                <td><b>Dias de Permisos</b></td>
                <td></td>
                <td></td>
                <td>{{$p}}</td>
                <td></td>
                <td></td>
                <td ></td>
                <td></td>
            </tr>
        @endif
        @if($m!=0)
            <tr>
                <td></td>
                <td><b>Dias de maternidad</b></td>
                <td></td>
                <td></td>
                <td>{{$m}}</td>
                <td></td>
                <td></td>
                <td ></td>
                <td></td>
            </tr>
        @endif
        <tr>
            <td></td>
            <td><b>TOTAL:</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="color: #cc2127">$ {{number_format(round($total_descuentos,2), 2, '.', ',')}}</td>
            <td style="color: #1f648b">$ {{number_format(round($liquido,2), 2, '.', ',')}}</td>
            <td>FIRMA:</td>
        </tr>

        <tr style="background: #00acc1">
            <td colspan="9"></td>
        </tr>

    @endforeach
    </tbody>
</table>