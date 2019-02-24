<?php $title="Vales"?>
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
       .titulo {
            padding: -5px;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        .izquierda {
            text-align: left;
        }

        .derecha {
            text-align: right;
            padding-right: 57px;
        }

        .centro{
            text-align: center;
        }

        td{
            padding: -8px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }
        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

    </style>

    <div align="center"><h3>DETALLE DE VALE No. {{ $vale->numeroVale }}</h3></div>

    <div class="cuerpo">
        <br>
                    <fieldset>
                        <legend><small>Datos de salida</small></legend>
                        <table>
                            <tr>
                                <td><h4>Fecha de salida:</h4></td>
                                <td><h4> <b> {{ date('d-m-Y', strtotime($salida->fechaSalida)) }}</b></h4></td>
                                <td><h4>Destino:</h4></td>
                                <td><h4> <b> {{ $salida->destinoTrasladarse }}</b></h4></td>
                            </tr>
                            <tr>
                                <td><h4>Vehículo:</h4></td>
                                <td><h4> <b> {{ $vehiculo->numeroPlaca }}</b></h4></td>
                                <td><h4>Solicitante: </h4></td>
                                <td><h4> <b> {{ $nombre->nombresEmpleado.' '.$nombre->apellidosEmpleado }}</b></h4></td>
                            </tr>
                            <tr>
                                <td class="centro"><h4>Misión:</h4>
                                </td>
                                <td colspan="3" class="izquierda">
                                    @if(!(is_null($salida->mision)))
                                        <h4> <b> {{ $salida->mision }}</b></h4>
                                    @else
                                        <h4> <b> {{ "No especificada" }}</b></h4>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </fieldset>
        <br>
                   <fieldset>
                       <legend><small>Datos de vale</small></legend>

                       <table>
                           <tr>
                               <td><h4>Fecha:</h4></td>
                               <td><h4> <b> {{ date('d-m-Y', strtotime($vale->fechaCreacion)) }}</b></h4></td>
                               <td><h4>Gasolinera:</h4></td>
                               <td><h4> <b> {{ $vale->gasolinera }}</b></h4></td>
                           </tr>
                           <tr>
                               <td><h4>Tipo de combustible:</h4></td>
                               <td>
                                   <h4> <b>
                                           @if ($vale->tipoCombustible==1)
                                               {{ "Diesel" }}
                                           @endif
                                           @if ($vale->tipoCombustible==2)
                                               {{ "Regular" }}
                                           @endif
                                           @if ($vale->tipoCombustible==3)
                                               {{ "Especial" }}
                                           @endif
                                       </b></h4>
                               </td>
                               <td><h4>Número de galones:</h4></td>
                               <td>
                                   <h4><b>
                                           @if ($vale->galones!=null)
                                               {{ $vale->galones }}
                                           @else
                                               {{ "No especificado" }}
                                           @endif
                                       </b></h4>
                               </td>
                           </tr>
                           <tr>
                               <td colspan="3" class="derecha"><h4>Costo de galones:</h4>
                               </td>
                               <td  class="centro" >
                                   <h4><b>
                                           @if ($vale->costoGalones!=null)
                                               {{ "$ ".$vale->costoGalones }}
                                           @else
                                               {{ "No especificado" }}
                                           @endif
                                       </b></h4>
                               </td>
                           </tr>
                           @if ($vale->aceite==1)
                               <tr>
                                   <td> <h4>Aceite:</h4></td>
                                   <td> <h4> <b> {{ "Si" }}</b></h4></td>
                                   <td><h4>Costo de aceite: </h4></td>
                                   <td><h4> <b> {{ "$ ".$vale->costoAceite }}</b></h4></td>
                               </tr>
                           @endif
                           @if ($vale->grasa==1)

                               <tr>
                                   <td><h4>Grasa:</h4></td>
                                   <td><h4> <b> {{ "Si" }}</b></h4></td>
                                   <td><h4>Costo de grasa: </h4></td>
                                   <td><h4> <b> {{ "$ ".$vale->costoGrasa }}</b></h4></td>
                               </tr>
                           @endif
                           @if ($vale->otro!=null)

                               <tr>
                                   <td><h4>Otro: <br></h4></td>
                                   <td> <h4> <b> {{ $vale->otro }}</b></h4></td>
                                   <td><h4>Costo de {{ $vale->otro }} :</h4></td>
                                   <td><h4> <b> {{ "$ ".$vale->costoOtro }}</b></h4></td>
                               </tr>
                           @endif
                           <tr>
                               <td colspan="3" class="derecha"><h4>Monto total de vale: </h4>
                               </td>
                               <td class="centro"><h4> <b> {{ "$ ".$vale->costoUnitarioVale }}</b></h4></td>
                           </tr>
                       </table>
                   </fieldset>
        <br>
                   <fieldset>
                       <legend><small>Datos de entrega</small></legend>
                       <table>
                           <tr>
                               <td><h4>Autoriza:</h4></td>
                               <td> <h4> <b> {{ $autoriza->nombresEmpleado.' '.$autoriza->apellidosEmpleado }}</b></h4></td>
                               <td> <h4>Recibe:</h4></td>
                               <td><h4> <b> {{ $recibe->nombresEmpleado.' '.$recibe->apellidosEmpleado }}</b></h4></td>
                           </tr>
                           <tr>
                               <td class="centro"><h4>Estado de devolución:</h4>
                               </td>
                               <td colspan="3" class="izquierda">
                                   <h4> <b>
                                           @if( $vale->estadoRecibidoVal==1)
                                               {{ "Recibido" }}
                                           @else
                                               {{ "Pendiente" }}
                                           @endif
                                       </b></h4>
                               </td>
                           </tr>
                       </table>
                   </fieldset>

@endsection