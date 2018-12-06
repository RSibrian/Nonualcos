@extends ('plantilla')
@section('plantilla')
    <div class="row">
        <div class=" col-sm-offset-1  col-md-10">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="blue">
                    <i class="material-icons">perm_identity</i>
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
                                            <td><h4> <b> {{ $salida->fechaSalida }}</b></h4></td>
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
                                            <td><h4> <b> {{ "No disponible" }}</b></h4></td>
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
                                        <td><h4> <b> {{ $vale->fechaCreacion }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Gasolinera: <br></h4></td>
                                        <td><h4> <b> {{ $vale->gasolinera }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Número de galones: <br></h4></td>
                                        <td><h4> <b> {{ $vale->galones }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Estado de liquidación: <br></h4></td>
                                        <td><h4> <b>
                                                    @if( $vale->estadoLiquidacionVal==1)
                                                        {{ "Liquidado" }}
                                                    @else
                                                        {{ "No liquidado" }}
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
                                        <td><h4>Número de vale: <br></h4></td>
                                        <td><h4> <b> {{ $vale->numeroVale }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Tipo de combustible: <br></h4></td>
                                        <td><h4> <b> {{ $vale->tipoCombustible }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Costo de vale: <br></h4></td>
                                        <td><h4> <b> {{ $vale->costoUnitarioVale }}</b></h4></td>
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
                                        <td><h4>Empleado que autoriza: <br></h4></td>
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
                                                        {{ "No entregado" }}
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
                                        <td><h4>Empleado que recibe: <br></h4></td>
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
                                                        {{ "No recibido" }}
                                                    @endif
                                                </b></h4></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6 col-sm-offset-4">

                        </div>
                    </fieldset>

                    <div align="center">
                        <a href="{{ url()->previous() }}" class='btn btn-ocre '>Regresar</a>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- end row -->
@stop