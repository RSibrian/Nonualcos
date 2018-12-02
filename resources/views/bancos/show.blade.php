@extends ('plantilla')
@section('plantilla')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="ocre">
                    <i class="material-icons">perm_identity</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Cargo -
                        <small class="category">Mostrando el cargo: {{$cargo->car_nombre}}</small>
                    </h4>

                    <fieldset>
                        <input type="hidden" name="hi2" value="1">
                        <div class="form-group ">
                            <table>
                                <tr>
                                    <td><h4>Codigo de Orden: </h4></td>
                                    <td><h4> <b>&nbsp;{{($cargo->seccion->unidad)?$cargo->seccion->unidad->uni_orden:$cargo->seccion->uni_orden}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Codigo de la Unidad: </h4></td>
                                    <td><h4> <b>&nbsp;{{($cargo->seccion->unidad)?$cargo->seccion->unidad->uni_codigo:$cargo->seccion->uni_codigo}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Nombre de la Unidad: </h4></td>
                                    <td><h4> <b>&nbsp;{{($cargo->seccion->unidad)?$cargo->seccion->unidad->uni_nombre:$cargo->seccion->uni_nombre}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Codigo de la Sección: </h4></td>
                                    <td><h4> <b>&nbsp;{{$cargo->seccion->uni_codigo}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Nombre de la Sección: </h4></td>
                                    <td><h4> <b>&nbsp;{{$cargo->seccion->uni_nombre}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Nombre del cargo: </h4></td>
                                    <td><h4><b>&nbsp;{{$cargo->car_nombre}}</b></h4></td>
                                </tr>
                            </table>

                        </div>
                    </fieldset>


                </div>
            </div>
        </div>
        <div class="col-md-4 row">
            <div class="card card-profile">
                <div class="card-avatar">
                    <a href="#pablo">
                        <img class="img" src="/RecursosHumanos/public/img/logo.jpg" />
                    </a>
                </div>
                <div class="card-content">
                    <h6 class="category text-gray">Alcaldia Municipal</h6>
                    <h4 class="card-title">Ilobasco</h4>
                    <p class="description">
                        Histórica Ciudad, en el Departamento de Cabañas pueblo hermoso y laborioso, con gente cálida y sincera, ILOBASCO, TIERRA DE ARTESANOS.
                    </p>
                    <a href="https://www.facebook.com/AlcaldiaIlobasco/"  target="_blank" class="btn btn-just-icon btn-round btn-facebook"><i class="fa fa-facebook"> </i></a>

                </div>
            </div>
        </div>

    </div>


    <!-- end row -->
@stop

