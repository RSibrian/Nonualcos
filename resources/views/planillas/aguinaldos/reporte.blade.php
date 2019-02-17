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
            height: 49%;
            opacity: 0.3;
        }
        .azul{
            background: rgba(76, 175, 80, 0.10)
        }


    </style>
</head>
<body>
<?php $cont=0;
    $total_empleado=count($empleados);
?>
@foreach ($empleados as $empleado)
    <?php
    $cont++;
    ?>
    @for($i=0;$i<2;$i++)
        <section>
            <table height="50%" width="100%"  border="0"  >
                <tr >
                    <td colspan="6" align="center">ASOCIACIÓN DE MUNICIPIOS LOS NONUALCOS</td>
                </tr>
                <tr>
                    <td colspan="6" align="center">Boleta de Pago Corespondiente al mes de {{$meses[intval($mes)]}} del {{$anno}}</td>
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
                    <td>{{$empleado->dias_trabajados}}</td>
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
                    <th colspan="2" align="center">Haberes</th>
                    <th colspan="2" align="center">Descuentos</th>
                </tr>
                <tr>
                    <td colspan="2">Salario</td>
                    <td colspan="2" align="right">$ {{\Helper::dinero(round($empleado->salario_ganado,2))}}</td>
                    <td colspan="2" align="right">-</td>
                </tr>
                <tr>
                    <td colspan="2">{{$empleado->seguro->nombreAportacion}}</td>
                    <td colspan="2" align="right">-</td>
                    <td colspan="2" align="right">$ {{\Helper::dinero(round($empleado->ISSS,2))}}</td>
                </tr>
                <tr>
                    <td colspan="2">{{$empleado->AFP->nombreAportacion}}</td>
                    <td colspan="2" align="right">-</td>
                    <td colspan="2" align="right">$ {{\Helper::dinero(round($empleado->AFP_empleado,2))}}</td>
                </tr>
                <tr>
                    <td colspan="2">Retención de Renta: </td>
                    <td colspan="2" align="right">-</td>
                    <td colspan="2" align="right">$ {{\Helper::dinero(round($empleado->descuento_renta,2))}}</td>
                </tr>
                @if($empleado->descuento_tiempo>0 && $empleado->llegadaBandera)
                    <tr>
                        <td colspan="2">Descuento Llegada tarde: </td>
                        <td colspan="2" align="right">-</td>
                        <td colspan="2" align="right">$ {{\Helper::dinero(round($empleado->descuento_tiempo,2))}}</td>
                    </tr>
                @endif
                @if($empleado->prestamoBandera)
                    @foreach ($empleado->descuentos_var as $descuento)
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
                            <td colspan="2" align="right">-</td>
                            <td colspan="2" align="right">$ {{\Helper::dinero(round($descuento->pago,2))}}</td>

                        </tr>
                    @endforeach
                @endif
                <tr style="border-bottom: 6px solid red;">
                    <td></td>
                    <td colspan="1" align="right" style="border-top: 3px solid black;"> Totales</td>
                    <td colspan="2" style="border-bottom: 3px solid black; border-top: 3px solid black;" align="right">$ {{\Helper::dinero(round($empleado->salario_ganado,2))}}</td>
                    <td colspan="2" style="border-bottom: 3px solid black; border-top: 3px solid black;" align="right">$ {{\Helper::dinero(round($empleado->total_descuentos,2))}}</td>
                </tr>

                <tr class="azul">
                    <td></td>
                    <td></td>
                    <td  colspan="2" align="right"><b>Total a Pagar</b></td>
                    <td colspan="2" align="left"><b>$ {{\Helper::dinero(round($empleado->liquido,2))}}</b></td>
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
    @if($total_empleado!=$cont)
    <div class="page-break"></div>
    @endif
@endforeach
</body>
</html>

