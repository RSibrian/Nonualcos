@extends ('plantilla')
@section('plantilla')
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10" >
            <div class="card">
                    <div class="card-header card-header-icon" data-background-color="blue">
                        <i class="material-icons">featured_play_list</i>
                    </div>
                <div class="card-content">
                    <h4 class="card-title">Vales -
                        <small class="category">Mostrando Vale </small>
                    </h4>

                    <br>
                    <fieldset style="border: 1px solid #ccc; padding: 10px">
                        <legend><small>Datos de salida</small></legend>

                        <div class="col-sm-6">
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Fecha Salida: <br></h4></td>
                                        <td><h4> <b> {{ date('d-m-Y', strtotime($salida->fechaSalida)) }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Vehículo: <br></h4></td>
                                        <td><h4> <b> {{ $vehiculo->numeroPlaca }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>

                        </div>

                        <div class="col-sm-6">
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Destino: <br></h4></td>
                                        <td><h4> <b> {{ $salida->destinoTrasladarse }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Solicitante: <br></h4></td>
                                        <td><h4> <b> {{ $nombre->nombresEmpleado.' '.$nombre->apellidosEmpleado }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Misión: <br></h4></td>
                                        @if(!(is_null($salida->mision)))
                                            <td><h4> <b> {{ $salida->mision }}</b></h4></td>
                                        @else
                                            <td><h4> <b> {{ "No Especificado" }}</b></h4></td>
                                        @endif
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                    <br>
                    <fieldset style="border: 1px solid #ccc; padding: 10px">
                        <legend><small>Datos de Vale</small></legend>

                        <div class="col-sm-6">
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Fecha: <br></h4></td>
                                        <td><h4> <b> {{ date('d-m-Y', strtotime($vale->fechaCreacion)) }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Número de vale: <br></h4></td>
                                        <td><h4> <b> {{ $vale->numeroVale }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Gasolinera: <br></h4></td>
                                        <td><h4> <b> {{ $vale->gasolinera }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Tipo de combustible: <br></h4></td>
                                        <td><h4> <b>
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
                                </table>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Número de galones: <br></h4></td>
                                        <td><h4><b>
                                                    @if ($vale->galones!=null)
                                                        {{ $vale->galones }}
                                                    @else
                                                        {{ "No especificado" }}
                                                    @endif
                                                </b></h4></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Costo de galones: <br></h4></td>
                                        <td><h4><b>
                                                    @if ($vale->costoGalones!=null)
                                                        {{ "$ ".$vale->costoGalones }}
                                                    @else
                                                        {{ "No especificado" }}
                                                    @endif
                                                </b></h4></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        @if ($vale->aceite==1)
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <table>
                                        <tr>
                                            <td><h4>Aceite: <br></h4></td>
                                            <td><h4> <b> {{ "Si" }}</b></h4></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <table>
                                        <tr>
                                            <td><h4>Costo de aceite: <br></h4></td>
                                            <td><h4> <b> {{ "$ ".$vale->costoAceite }}</b></h4></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endif

                        @if ($vale->grasa==1)
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <table>
                                        <tr>
                                            <td><h4>Grasa: <br></h4></td>
                                            <td><h4> <b> {{ "Si" }}</b></h4></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <table>
                                        <tr>
                                            <td><h4>Costo de grasa: <br></h4></td>
                                            <td><h4> <b> {{ "$ ".$vale->costoGrasa }}</b></h4></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endif

                        @if ($vale->otro!=null)
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <table>
                                        <tr>
                                            <td><h4>Otro: <br></h4></td>
                                            <td><h4> <b> {{ $vale->otro }}</b></h4></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <table>
                                        <tr>
                                            <td><h4>Costo de {{ $vale->otro }} : <br></h4></td>
                                            <td><h4> <b> {{ "$ ".$vale->costoOtro }}</b></h4></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endif

                        <div class="col-sm-6">
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Estado: <br></h4></td>
                                        <td><h4> <b>
                                                    @if( $vale->estadoLiquidacionVal==1)
                                                        {{ "Liquidado" }}
                                                    @else
                                                        {{ "Pendiente" }}
                                                    @endif
                                                </b></h4></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Monto total de vale: <br></h4></td>
                                        <td><h4> <b> {{ "$ ".$vale->costoUnitarioVale }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </fieldset>
                    <br>

                    <fieldset style="border: 1px solid #ccc; padding: 10px">
                        <legend><small>Datos de entrega</small></legend>

                        <div class="col-sm-6">
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Autoriza: <br></h4></td>
                                        <td><h4> <b> {{ $autoriza->nombresEmpleado.' '.$autoriza->apellidosEmpleado }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Estado de entrega: <br></h4></td>
                                        <td><h4> <b>
                                                    @if( $vale->estadoEntregadoVal==1)
                                                        {{ "Entregado" }}
                                                    @else
                                                        {{ "Pendiente" }}
                                                    @endif
                                                </b></h4></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Recibe: <br></h4></td>
                                        <td><h4> <b> {{ $recibe->nombresEmpleado.' '.$recibe->apellidosEmpleado }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Estado de devolución: <br></h4></td>
                                        <td><h4> <b>
                                                    @if( $vale->estadoRecibidoVal==1)
                                                        {{ "Recibido" }}
                                                    @else
                                                        {{ "Pendiente" }}
                                                    @endif
                                                </b></h4></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </fieldset>

                    <div align="center">
                        <a href="{{ url()->previous() }}" class='btn btn-ocre '>Regresar</a>
                        <a target="_blank" href="{{ route('vales.reporte', $vale->id) }}" class="btn  btn-ocre ">
                            Descargar
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>

    <!-- end row -->
@stop