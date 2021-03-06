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

        table th{
            background: #F5F5F5;
        }

    </style>

    <div align="center"><h3>Reporte general de Liquidaciones </h3></div>
    <div align="center"> Rango de fechas: {{ \Helper::fecha($fechaI) }} - {{ \Helper::fecha($fechaF) }} </div>
    @foreach ($liquidaciones as $liquidacion )
        <?php
        $cont=0;
        $vehiculos = $liquidacion->vale;
        foreach ($vehiculos as $vehiculo )
        {
            $placa = $vehiculo->salida->vehiculo->numeroPlaca;
        }
        ?>
        <div class="cuerpo">
            <br>
            <table>
                <tr>
                    <th class="columna borde" align="center"><h4>Fecha de liquidación: <br></h4></th>
                    <th class="columna borde" align="center"><h4> <b>{{ \Helper::fecha($liquidacion->fechaLiquidacion) }} </b></h4></th>
                    <th class="columna borde" align="center"><h4>Número de factura: <br></h4></th>
                    <th class="columna borde" align="center"><h4> <b> {{ $liquidacion->numeroFacturaLiquidacion }} </b></h4></th>
                    <th class="columna borde" align="center"><h4>Vehículo: <br></h4></th>
                    <th class="columna borde" align="center"><h4> <b> {{ $placa }} </b></h4></th>
                </tr>
            </table>
            <fieldset>
                <table>
                    <tr>
                        <th class="columna borde" align="center"></th>
                        <th class="columna borde" align="center"><h4>#</h4></th>
                        <th class="columna borde" align="center"><h4>Fecha</h4></th>
                        <th class="columna borde" align="center"><h4>Número de vale</h4></th>
                        <th class="columna borde" align="center"><h4>Unidad</h4></th>
                        <th class="columna borde" align="center"><h4>Valor ($)</h4></th>
                    </tr>
                    @foreach($vehiculos as $vale)
                        <?php
                          $cont++;
                          $unidad=$vale->salida->empleados->cargo->unidad->nombreUnidad;
                        ?>
                            <tr>
                                <td class="borde padding-td"></td>
                                <td class="borde padding-td"> {{ $cont }} </td>
                                <td class="borde padding-td"> {{ \Helper::fecha($vale->fechaCreacion) }} </td>
                                <td class="borde padding-td"> {{ $vale->numeroVale }} </td>
                                <td class="borde padding-td"> {{ $unidad  }} </td>
                                <td class="borde padding-td"> {{ "$ ". \Helper::dinero($vale->costoUnitarioVale) }} </td>
                            </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" class="columna borde derecha"><h4>Monto en factura: <br></h4></td>
                        <td class="columna borde"><h4> <b> {{ "$ ". \Helper::dinero($liquidacion->montoFacturaLiquidacion) }}</b></h4></td>
                    </tr>
                </table>
            </fieldset>

        </div>
    @endforeach

@endsection