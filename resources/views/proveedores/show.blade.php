
@extends ('plantilla')
@section('plantilla')
    <div class="row">
      <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="blue">
                    <i class="material-icons">perm_identity</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Proveedor -
                        <small class="category">Mostrando Proveedor #{{$prov->id}}</small>
                    </h4>
                    <fieldset>
                        <div class="form-group ">
                            <table>
                                <tr>
                                    <td><h4>Empresa: </h4></td>
                                    <td><h4> <b>&nbsp;{{$prov->nombreEmpresa}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Encargado: </h4></td>
                                    <td><h4> <b>&nbsp;{{$prov->nombreEncargado}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Telefono: </h4></td>
                                    <td><h4> <b>&nbsp;{{$prov->telefonoProve}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Correo: </h4></td>
                                    <td><h4><b>{{$prov->email}}</b></h4></td>
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
<div class="col-md-1"></div>

    </div>


    <!-- end row -->
@stop
