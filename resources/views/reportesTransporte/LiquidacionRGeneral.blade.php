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

    foreach ($liquidaciones as $liquidacion )
    {
       echo $liquidacion;
    }
    ?>

    <div align="center"><h3>DETALLE DE LIQUIDACIÓN PARA VEHÍCULO CON PLACA </h3></div>

    <div class="cuerpo">
        <br>
        <table>
            <tr>
                <td class="columna borde"><h4>Fecha de liquidación: <br></h4></td>
                <td class="columna borde"><h4> <b> </b></h4></td>
                <td class="columna borde"><h4>Número de factura: <br></h4></td>
                <td class="columna borde"><h4> <b> </b></h4></td>
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

            </table>
        </fieldset>
    </div>

@endsection