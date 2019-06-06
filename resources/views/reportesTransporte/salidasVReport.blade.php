<?php $title="Salidas Realizadas"?>
@extends ('reportesTransporte.plantillaVertical')
@section('reporte')

    <style>

        table {
            border-collapse: collapse;
            width: 100%;
        }
        table td th{
            text-align: center;
        }

        th td{
            padding: 5px 20px;
        }

        table th {
            color: white;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }
        th {
            background-color: #4f8ba0;
            color: white;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

    </style>

    <br><div align="center" style="position: top:170px; z-index: 1;"><h3>Reporte de salidas para vehículo placa {{ $placa->numeroPlaca }}</h3></div>
    <div align='center'  ><h3>Del: {{ \Helper::fecha($fechaInicio)}} ---- Al: {{\Helper::fecha($fechaFinal)}}</h3> </div>


    <table class="table-wrapper" border="0.5" >
        <thead>
        <tr>
            <th  rowspan="2">Fecha</th>
            <th colspan="3">Salida</th>
            <th colspan="3">Destino</th>
            <th rowspan="2">Distancia Recorrida</th>
            <th rowspan="2">Combustible recibido en GLS</th>
            <th rowspan="2">Nombre del conductor</th>
            <th rowspan="2">Firma de conductor</th>
        </tr>
        <tr>
            <th>Hora</th>
            <th>Kilometraje</th>
            <th>Lugar</th>
            <th>Hora</th>
            <th>Kilometraje</th>
            <th>Lugar</th>
        </tr>
        </thead>
        <tbody>

        @foreach($data as $salida)
            <tr>
                <td>{{\Helper::fecha($salida->fechaSalida)}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $salida->destinoTrasladarse }}</td>
                <td></td>
                <td></td>
                <td>{{ $salida->nombresEmpleado." ".$salida->apellidosEmpleado }}</td>
                <td> </td>
            </tr>
        @endforeach
        </tbody>

    </table>
@endsection