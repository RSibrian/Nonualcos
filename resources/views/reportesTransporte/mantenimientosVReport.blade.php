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
            padding: 8px;
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

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

    </style>

    <br><div align="center" style="position: top:170px; z-index: 1;"><h3>Reporte General Manto. de Vehículos</h3></div>
    <div align='center'  ><h3>Del: {{Carbon\Carbon::parse($fechaInicio)->format('d/m/Y')}} ---- Al: {{Carbon\Carbon::parse($fechaFinal)->format('d/m/Y')}}</h3> </div>


    <table class="table-wrapper" >
        <?php $count=0;?>
        <thead>
        <tr>
            <th>#</th>
            <th>Código Inventario</th>
            <th>Artículo</th>
            <th>Fecha en taller</th>
            <th>Empresa Encargada</th>
            <th>Personal que solicita</th>
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
                <td>{{$mantenimiento->fechaRecepcionTaller->format('d-m-Y')}}</td>
                <td>{{ $mantenimiento->proveedores->nombreEmpresa }}</td>
                <td>{{ $mantenimiento->empleado1->nombresEmpleado.' '.$mantenimiento->empleado1->apellidosEmpleado }}</td>
                <td>{{$mantenimiento->fechaRetornoTaller->format('d-m-Y')}}</td>
                <td>{{ $mantenimiento->empleado2->nombresEmpleado.' '.$mantenimiento->empleado2->apellidosEmpleado }}</td>
                <td>$ {{$mantenimiento->costoMantenimiento}}</td>
            </tr>
            <tr>
                <td colspan="2">Mantenimiento Realizado: </td>
                <td> {{ $mantenimiento->reparacionesRealizadas }}</td>
            </tr>
        @endforeach
        </tbody>

    </table>
@endsection