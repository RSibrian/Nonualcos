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


    <table class="table-wrapper" >
        <?php $count=0;?>
        <thead>
        <tr>
            <th>#</th>
            <th>Fecha de salida</th>
            <th>Destino</th>
            <th>Misión</th>
            <th>Número de vale</th>
            <th>Solicitante</th>
        </tr>
        </thead>
        <tbody>

        @foreach($data as $salida)
            <?php $count++;?>
            <tr>
                <td>{{$count}}</td>
                <td>{{\Helper::fecha($salida->fechaSalida)}}</td>
                <td>{{ $salida->destinoTrasladarse }}</td>
                @if (!(is_null($salida->mision)))
                    <td>{{ $salida->mision }}</td>
                @else
                    <td>{{ "No especificado" }}</td>
                @endif
                <td>{{ $salida->numeroVale }} </td>
                <td>{{ $salida->nombresEmpleado." ".$salida->apellidosEmpleado }}</td>
            </tr>
        @endforeach
        </tbody>

    </table>
@endsection