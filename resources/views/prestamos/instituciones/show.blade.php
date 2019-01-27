@extends ('plantilla')
@section('plantilla')
    <div class="row">
        <div class=" col-sm-offset-1  col-md-10">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="blue">
                    <i class="material-icons">perm_identity</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">institución -
                        <small class="category">Mostrando institución #{{$institucion->id}}</small>
                    </h4>


                    <fieldset>
                        <input type="hidden" name="hi2" value="1">
                        <div class="form-group ">
                            <table>
                                <tr>
                                    <td><h4>Nombre:  </h4></td>
                                    <td><h4> <b>&nbsp;{{$institucion->nombreInstitucion}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Telefon:  </h4></td>
                                    <td><h4> <b>&nbsp;{{$institucion->telefonoInstitucion}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Dirección:  </h4></td>
                                    <td><h4> <b>&nbsp;{{$institucion->direccionInstitucion}}</b></h4></td>
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

