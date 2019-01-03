<?php $title="Vales"?>
@extends ('reporte.plantillaVertical')
@section('reporte')

    <br><div align="center"><h3>DETALLE DE VALE No. {{ $vale->numeroVale }}</h3></div>

    <table  class="table-wrapper">
        <thead>
        <tr><td colspan="4"><legend>Datos de salida</legend></td></tr>
        </thead>
        <tr>
            <td><h4>Fecha Salida: <br></h4></td>
            <td><h4> <b> {{ $salida->fechaSalida }}</b></h4></td>
            <td><h4>Destino: <br></h4></td>
            <td><h4> <b> {{ $salida->destinoTrasladarse }}</b></h4></td>
        </tr>

        <tr>
            <td><h4>Vehículo: <br></h4></td>
            <td><h4> <b> {{ $vehiculo->numeroPlaca }}</b></h4></td>
            <td><h4>Solicitante: <br></h4></td>
            <td><h4> <b> {{ $nombre->nombresEmpleado.' '.$nombre->apellidosEmpleado }}</b></h4></td>
        </tr>

        <tr>
            <td colspan="2"><h4>Misión: <br></h4></td>
            @if(!(is_null($salida->mision)))
                <td colspan="2"><h4> <b> {{ $salida->mision }}</b></h4></td>
            @else
                <td colspan="2"><h4> <b> {{ "No asignada" }}</b></h4></td>
            @endif

        </tr>
    </table>
    <br>
    <br>
    <table class="table-wrapper">
        <thead>
        <tr>
            <td colspan="4"><legend>Datos de Vale</legend></td>
        </tr>
        </thead>

        <tr>
            <td><h4>Fecha: <br></h4></td>
            <td><h4> <b> {{ $vale->fechaCreacion }}</b></h4></td>
            <td><h4>Número de vale: <br></h4></td>
            <td><h4> <b> {{ $vale->numeroVale }}</b></h4></td>
        </tr>
        <tr>
            <td colspan="2"><h4>Gasolinera: <br></h4></td>
            <td colspan="2"><h4> <b> {{ $vale->gasolinera }}</b></h4></td>
        </tr>
        <tr>
            <td colspan="2"><h4>Tipo de combustible: <br></h4></td>
            <td colspan="2"><h4> <b>
                        @if ($vale->tipoCombustible==1)
                            {{ "Diesel" }}
                        @endif
                        @if ($vale->tipoCombustible==2)
                            {{ "Regular" }}
                        @endif
                        @if ($vale->tipoCombustible==3)
                            {{ "Especial" }}
                        @endif
                    </b></h4></td>
        </tr>
        <tr>
            <td><h4>Número de galones: <br></h4></td>
            <td><h4><b>
                        @if ($vale->galones!=null)
                            {{ $vale->galones }}
                        @else
                            {{ "No especificado" }}
                        @endif
                    </b></h4></td>
            <td><h4>Costo de galones: <br></h4></td>
            <td><h4><b>
                        @if ($vale->costoGalones!=null)
                            {{ "$ ".$vale->costoGalones }}
                        @else
                            {{ "No especificado" }}
                        @endif
                    </b></h4></td>
        </tr>
        @if ($vale->aceite==1)
            <tr>
                <td><h4>Aceite: <br></h4></td>
                <td><h4> <b> {{ "Si" }}</b></h4></td>
                <td><h4>Costo de aceite: <br></h4></td>
                <td><h4> <b> {{ "$ ".$vale->costoAceite }}</b></h4></td>
            </tr>
        @endif
        @if ($vale->grasa==1)
            <tr>
                <td><h4>Grasa: <br></h4></td>
                <td><h4> <b> {{ "Si" }}</b></h4></td>
                <td><h4>Costo de grasa: <br></h4></td>
                <td><h4> <b> {{ "$ ".$vale->costoGrasa }}</b></h4></td>
            </tr>
        @endif
        @if ($vale->otro!=null)
            <tr>
                <td><h4>Otro: <br></h4></td>
                <td><h4> <b> {{ $vale->otro }}</b></h4></td>
                <td><h4>Costo de {{ $vale->otro }} : <br></h4></td>
                <td><h4> <b> {{ "$ ".$vale->costoOtro }}</b></h4></td>
            </tr>
        @endif
        <tr>
            <td><h4>Estado de liquidación: <br></h4></td>
            <td><h4> <b>
                        @if( $vale->estadoLiquidacionVal==1)
                            {{ "Liquidado" }}
                        @else
                            {{ "No liquidado" }}
                        @endif
                    </b></h4></td>
            <td><h4>Monto total de vale: <br></h4></td>
            <td><h4> <b> {{ "$ ".$vale->costoUnitarioVale }}</b></h4></td>
        </tr>
    </table>
    <br>
    <br>
    <table class="table-wrapper">
        <thead>
        <tr>
            <td colspan="4"><legend>Datos de entrega</legend></td>
        </tr>
        </thead>
        <tr>
            <td><h4>Empleado que autoriza: <br></h4></td>
            <td><h4> <b> {{ $autoriza->nombresEmpleado.' '.$autoriza->apellidosEmpleado }}</b></h4></td>
            <td><h4>Empleado que recibe: <br></h4></td>
            <td><h4> <b> {{ $recibe->nombresEmpleado.' '.$recibe->apellidosEmpleado }}</b></h4></td>
        </tr>
        <tr>
            <td><h4>Estado de entrega: <br></h4></td>
            <td><h4> <b>
                        @if( $vale->estadoEntregadoVal==1)
                            {{ "Entregado" }}
                        @else
                            {{ "No entregado" }}
                        @endif
                    </b></h4></td>
            <td><h4>Estado de devolución: <br></h4></td>
            <td><h4> <b>
                        @if( $vale->estadoRecibidoVal==1)
                            {{ "Recibido" }}
                        @else
                            {{ "No recibido" }}
                        @endif
                    </b></h4></td>
        </tr>
    </table>

@endsection