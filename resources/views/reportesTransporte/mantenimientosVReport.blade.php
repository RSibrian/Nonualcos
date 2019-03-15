<?php $title="Mantenimientos Realizados"?>
@extends ('reportesTransporte.plantillaHorizontal')
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

    <br><div align="center" style="position: top:170px; z-index: 1;"><h3>Reporte de mantenimientos para vehículo placa {{ $placa->numeroPlaca }}</h3></div>
    <div align='center'  ><h3>Del: {{ \Helper::fecha($fechaInicio)}} ---- Al: {{\Helper::fecha($fechaFinal)}}</h3> </div>


    <table class="table-wrapper" >
        <?php $count=0;?>
        <thead>
        <tr>
            <th>#</th>
            <th>Código Inventario</th>
            <th>Artículo</th>
            <th>Fecha en taller</th>
            <th>Empresa Encargada</th>
            <th>Solicitante</th>
            <th>Fecha de Recepción</th>
            <th>Personal que Recibe</th>
            <th>Costo</th>
        </tr>
        </thead>
        <tbody>

        @foreach($data as $mantenimiento)
            <?php $count++;?>
            <tr>
                <td rowspan="2">{{$count}}</td>
                <td>{{$mantenimiento->Activos->codigoInventario}}</td>
                <td>{{$mantenimiento->Activos->nombreActivo}}</td>
                <td>{{\Helper::fecha($mantenimiento->fechaRecepcionTaller)}}</td>
                <td>{{ $mantenimiento->proveedores->nombreEmpresa }}</td>
                <td>{{ $mantenimiento->empleado1->fullname }}</td>
                <td>{{\Helper::fecha($mantenimiento->fechaRetornoTaller)}} </td>
                <td>{{ $mantenimiento->empleado2->fullname }}</td>
                <td>$ {{ \Helper::dinero($mantenimiento->costoMantenimiento)}}</td>
            </tr>
            <tr>
                <td colspan="2">Mantenimiento Realizado: </td>
                <td> {{ $mantenimiento->reparacionesRealizadas }}</td>
            </tr>
        @endforeach
        </tbody>

    </table>
@endsection