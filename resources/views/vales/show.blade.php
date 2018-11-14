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
                                            <td><h4> <b> {{ $_show->fechaSalida }}</b></h4></td>
                                        </tr>
                                    </table>
                            </div>
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Vehículo: <br></h4></td>
                                        <td><h4> <b> {{ $_show->numeroPlaca }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>

                        </div>

                        <div class="col-sm-6">
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Destino: <br></h4></td>
                                        <td><h4> <b> {{ $_show->destinoTrasladarse }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Solicitante: <br></h4></td>
                                        <td><h4> <b> {{ $_show->nombresEmpleado.' '.$_show->apellidosEmpleado }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Misión: <br></h4></td>
                                        <td><h4> <b> {{ $_show->mision }}</b></h4></td>
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
                                        <td><h4> <b> {{ $_show->fechaCreacion }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Gasolinera: <br></h4></td>
                                        <td><h4> <b> {{ $_show->gasolinera }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Número de galones: <br></h4></td>
                                        <td><h4> <b> {{ $_show->galones }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>

                        </div>

                        <div class="col-sm-6">
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Código de vale: <br></h4></td>
                                        <td><h4> <b> {{ $_show->numeroVale }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Tipo de combustible: <br></h4></td>
                                        <td><h4> <b> {{ $_show->tipoCombustible }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Costo de vale: <br></h4></td>
                                        <td><h4> <b> {{ $_show->costoUnitarioVale }}</b></h4></td>
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
                                        <td><h4> <b> {{ $_show->autoriza }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>

                        </div>

                        <div class="col-sm-6">
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Empleado que recibe: <br></h4></td>
                                        <td><h4> <b> {{ $_show->recibe }}</b></h4></td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                        <div class="col-sm-6 col-sm-offset-4">
                            <div class="input-group">
                                <table>
                                    <tr>
                                        <td><h4>Estado de entrega: <br></h4></td>
                                        <td><h4> <b>
                                           @if( $_show->estadoEntregadoVal==1)
                                            {{ "Entregado" }}
                                           @else
                                             {{ "No entregado" }}
                                           @endif
                                                </b></h4></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </fieldset>

                    <div align="center">
                        <a href="{{ URL::previous() }}" class='btn btn-ocre '>Regresar</a>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- end row -->
@stop