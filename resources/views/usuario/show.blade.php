
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
                    <h4 class="card-title">Usuario -
                        <small class="category">Mostrando Usuario #{{$user->id}}</small>
                    </h4>
                    <fieldset>
                        <div class="form-group ">
                            <table>
                                <tr>
                                    <td><h4>Nombre: </h4></td>
                                    <td><h4> <b>&nbsp;{{$user->name}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Correo: </h4></td>
                                    <td><h4><b>{{$user->email}}</b></h4></td>
                                </tr>
                            </table>

                        </div>


                    </fieldset>


                </div>
            </div>
        </div>
<div class="col-md-1"></div>

    </div>


    <!-- end row -->
@stop
