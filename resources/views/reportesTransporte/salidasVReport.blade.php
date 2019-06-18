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
    <br><div align="center" style="position: top:170px; z-index: 1;"><h3>Bitácora del: {{ \Helper::fecha($fechaInicio)}} ---- Al: {{\Helper::fecha($fechaFinal)}}</h3></div>
    <div>
        <table border="0" >
            <tr>
                <td width="33.33%" align="center" style="background-color:#FFFFFF"><h3>Placa: {{ $placa->numeroPlaca }}</h3></td>
                <td width="33.33%" align="center" style="background-color:#FFFFFF"><h3>Marca: {{ $placa->activo->marca }}</h3></td>
                <td width="33.33%" align="center" style="background-color:#FFFFFF"><h3>Tipo: {{$placa->activo->nombreActivo}}</h3></td>
            </tr>
        </table>
     </div>
    <table class="table-wrapper" border="0.5" style="text-align: center" >
        <thead>
        <tr>
            <th  rowspan="2">Fecha</th>
            <th colspan="3" width="20%">Salida</th>
            <th colspan="3" width="20%">Destino</th>
            <th rowspan="2">Distancia recorrida</th>
            <th rowspan="2">Combustible recibido (gls)</th>
            <th rowspan="2">Nombre de Conductor</th>
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
                <td>
                    @if (!(is_null($salida->hsalida)))
                        {{ date('g:i a', strtotime($salida->hsalida) ) }}
                    @else
                        {{ "--" }}
                    @endif
                </td>
                <td>
                    @if (!(is_null($salida->ksalida)))
                        {{ \Helper::kilometraje($salida->ksalida) }}
                    @else
                        {{ "--" }}
                    @endif
                </td>
                <td>
                    {{ $salida->lugarSalida }}
                </td>
                <td>
                    @if (!(is_null($salida->hllegada )))
                        {{ date('g:i a', strtotime($salida->hllegada)) }}
                    @else
                        {{ "--" }}
                    @endif
                </td>
                <td>
                    @if (!(is_null($salida->kllegada )))
                        {{ \Helper::kilometraje($salida->kllegada) }}
                    @else
                        {{ "--" }}
                    @endif
                </td>
                <td>{{ $salida->destinoTrasladarse }}</td>
                <td>
                    <?php $km=($salida->kllegada)-($salida->ksalida);
                       if ($km==0){
                           echo "--";
                       }else{
                           echo  $km." Km";
                       }
                    ?>
                </td>
                <td>
                    @if (!(is_null($salida->crecibidogls)) )
                        {{ \Helper::dinero($salida->crecibidogls) }}
                    @else
                        {{ "--" }}
                    @endif
                </td>
                <td>{{ $salida->nombresEmpleado." ".$salida->apellidosEmpleado }}</td>
                <td> </td>
            </tr>
        @endforeach
        </tbody>

    </table>
@endsection