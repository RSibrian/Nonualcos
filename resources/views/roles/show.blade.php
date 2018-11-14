@extends ('plantilla')
@section('plantilla')
    <div class="row">
      <div class="col-md-1 row"></div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="azul">
                    <i class="material-icons">perm_identity</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Roles -
                        <small class="category">Mostrando Rol #{{$role->id}}</small>
                    </h4>

                    <fieldset>
                        <input type="hidden" name="hi2" value="1">
                        <div class="form-group ">
                            <table>
                                <tr>
                                    <td><h4>Nombre: </h4></td>
                                    <td><h4> <b>&nbsp;{{$role->name}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>slug: </h4></td>
                                    <td><h4><b>&nbsp;{{$role->slug}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Descripción: </h4></td>
                                    <td><h4><b>&nbsp;{{$role->description}}</b></h4></td>
                                </tr>
                            </table>

                        </div>
                    </fieldset>


                </div>
            </div>
        </div>
      <div class="col-md-1 row"></div>

    </div>


    <!-- end row -->
@stop
