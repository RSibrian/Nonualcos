@extends ('plantilla')
@section('plantilla')
    <div class="row">
        <div class="col-sm-offset-1 col-md-10">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="blue">
                    <i class="material-icons">work</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Cargo -
                        <small class="category">Mostrando el cargo: <b>{{$cargo->nombreCargo}}</b></small>
                    </h4>

                    <fieldset>
                        <input type="hidden" name="hi2" value="1">
                        <div class="form-group ">
                            <table>

                                <tr>
                                    <td><h4>Codigo de la Unidad: </h4></td>
                                    <td><h4> <b>&nbsp;{{$cargo->unidad->codigoUnidad}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Nombre de la Unidad: </h4></td>
                                    <td><h4> <b>&nbsp;{{$cargo->unidad->nombreUnidad}}</b></h4></td>
                                </tr>

                                <tr>
                                    <td><h4>Nombre del cargo: </h4></td>
                                    <td><h4><b>&nbsp;{{$cargo->nombreCargo}}</b></h4></td>
                                </tr>
                            </table>
                            <div align="center">
                                <a href="{{ URL::previous() }}" class='btn btn-ocre '>Regresar</a>
                            </div>
                        </div>
                    </fieldset>


                </div>
            </div>
        </div>


    </div>


    <!-- end row -->
@stop
