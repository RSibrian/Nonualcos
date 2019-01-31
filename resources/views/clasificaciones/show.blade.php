@extends ('plantilla')
@section('plantilla')
    <div class="row">
        <div class="col-sm-offset-1 col-md-10">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="blue">
                    <i class="material-icons">work</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Clasificación -
                        <small class="category">Mostrando la Clasificación: <b>{{$clasificacionesActivos->nombreTipo}}</b></small>
                    </h4>

                    <fieldset>
                        <input type="hidden" name="hi2" value="1">
                        <div class="form-group ">
                            <table>

                                <tr>
                                    <td><h4>Código: </h4></td>
                                    <td><h4> <b>&nbsp;{{$clasificacionesActivos->codigoTipo}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Nombre: </h4></td>
                                    <td><h4> <b>&nbsp;{{$clasificacionesActivos->nombreTipo}}</b></h4></td>
                                </tr>

                                <tr>
                                    <td><h4>Clasificación según Ley: </h4></td>
                                    <td><h4><b>&nbsp;{{$clasificacionesActivos->tipoLeyes->nombreLey}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Porcentaje de depreciación: </h4></td>
                                    <td><h4><b>&nbsp;{{$clasificacionesActivos->tipoLeyes->valorProcentaje.' %'}}</b></h4></td>
                                </tr>
                            </table>
                            <div align="center">
                                <a href="{{ route('clasificaciones.index') }}" class='btn btn-ocre '>Regresar</a>
                            </div>
                        </div>
                    </fieldset>


                </div>
            </div>
        </div>


    </div>


    <!-- end row -->
@stop
