<?php $title="Liquidaciones"?>
@extends ('reportesTransporte.plantillaVertical')
@section('reporte')

    <style>

        fieldset{
            border: 1px solid #ccc;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table td {
            text-align: center;
        }

        .derecha {
            text-align: right;
            padding-right: 57px;
        }

        .columna{
            padding: -8px;
        }

        .borde{
            border-bottom: 1px solid #ccc;
        }

        .padding-td{
            padding: 8px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

    </style>

    <?php
    $vehiculos = $liquidacion->vale;
    foreach ($vehiculos as $vehiculo )
    {
        $placa = $vehiculo->salida->vehiculo;
    }
    ?>

    <div align="center"><h3>DETALLE DE LIQUIDACIÓN PARA VEHÍCULO CON PLACA {{ $placa->numeroPlaca }}</h3></div>

    <div class="cuerpo">
        <br>
            <table>
                <tr>
                    <td class="columna borde"><h4>Fecha de liquidación: <br></h4></td>
                    <td class="columna borde"><h4> <b> {{ date('d-m-Y', strtotime($liquidacion->fechaLiquidacion)) }}</b></h4></td>
                    <td class="columna borde"><h4>Número de factura: <br></h4></td>
                    <td class="columna borde"><h4> <b> {{ $liquidacion->numeroFacturaLiquidacion }}</b></h4></td>
                </tr>
            </table>

        <br>
        <fieldset>
            <table>
                <tr>
                    <td class="columna borde"></td>
                    <td class="columna borde"><h4>#</h4></td>
                    <td class="columna borde"><h4>Fecha</h4></td>
                    <td class="columna borde"><h4>Número de vale</h4></td>
                    <td class="columna borde"><h4>Unidad</h4></td>
                    <td class="columna borde"><h4>Valor ($)</h4></td>
                </tr>
                <?php $cont=0; ?>
                @foreach($vales as $vale)
                    <tr>
                        <?php $cont++; ?>
                            <td class="borde padding-td"></td>
                            <td class="borde padding-td"> {{ $cont }} </td>
                            <td class="borde padding-td"> {{ date('d-m-Y', strtotime($vale->fechaCreacion)) }} </td>
                            <td class="borde padding-td"> {{ $vale->numeroVale }} </td>
                            <td class="borde padding-td"> {{ $vale->nombreUnidad  }} </td>
                            <td class="borde padding-td"> {{ "$ ".$vale->costoUnitarioVale }} </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" class="columna borde derecha"><h4>Monto de factura: <br></h4></td>
                    <td class="columna borde"><h4> <b> {{ "$ ".$liquidacion->montoFacturaLiquidacion }}</b></h4></td>
                </tr>
            </table>
        </fieldset>
    </div>

@endsection