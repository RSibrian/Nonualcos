@extends ('plantilla')
@section('plantilla')
    <style>
        #texto {
            margin:0;
            padding:0;
            color: #195BAA;
        }
        #ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        #li {
            float: left;
        }

        #li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        #li a:hover:not(.active) {
            background-color: #111;
        }

        .active {
            background-color: #195BAA;
        }
    </style>

    <div class="row">
        <div class="col-md-10 col-sm-offset-1">
            <div class="card card-profile">
                <div class="card-header card-header-icon" data-background-color="ocre">
                    <i class="material-icons">perm_identity</i>
                </div>
                <div class="card-avatar">
                    <a href="{{ asset( $persona->per_imagen) }}"  data-lightbox="galeria" data-title="Nombre: {{$persona->per_nombres}} {{$persona->per_apellidos}}" >
                        <img class="img" src="{{ asset( $persona->per_imagen) }}"  alt="{{$persona->per_nombres }}">
                    </a>
                </div>
                <div class="card-content">
                    <fieldset>
                        <input type="hidden" name="hi2" value="1">
                        <div class="form-group" align="left">
                            <table >
                                <tr>
                                    <td colspan="4" class="text-center"><h3 id="texto"><b>&nbsp;Información de la Persona </b></h3></td>
                                </tr>
                                <tr>
                                    <td><h4>Nombres: </h4></td>
                                    <td><h4> <b>&nbsp;{{$persona->per_nombres}}</b></h4></td>
                                    <td><h4>Apellidos: </h4></td>
                                    <td><h4> <b>&nbsp;{{$persona->per_apellidos}}</b></h4></td>
                                </tr>

                                <tr>
                                    <td><h4>Edad: </h4></td>
                                    <td><h4><b>&nbsp;{{$persona->per_fecha_nacimiento}}</b></h4></td>
                                    <td><h4>DUI: </h4></td>
                                    <td><h4><b>&nbsp;{{$persona->per_dui}}</b></h4></td>
                                </tr>

                                <tr>
                                    <td><h4>Genero: </h4></td>
                                    <td><h4><b>&nbsp;{{$persona->genero->ger_genero}}</b></h4></td>
                                    <td><h4>Estado Civil: </h4></td>
                                    <td><h4><b>&nbsp;{{$persona->estado_civil->est_nombre}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Dirreccion: </h4></td>
                                    <td colspan="3"><h4><b>&nbsp;{{$persona->per_dirreccion}}</b></h4></td>

                                </tr>

                                <tr>
                                    <td colspan="4" class="text-center"><h3 id="texto"><b>&nbsp;Información del Cargo </b></h3></td>
                                </tr>
                                <tr>
                                    <td><h4>Unidad: </h4></td>
                                    <td><h4><b>&nbsp;{{($persona_cargo->cargo->seccion->unidad)?$persona_cargo->cargo->seccion->unidad->uni_nombre:$persona_cargo->cargo->seccion->uni_nombre}} &nbsp;&nbsp;&nbsp;&nbsp;</b></h4></td>
                                    <td><h4>Cargo: </h4></td>
                                    <td><h4><b>&nbsp;{{$persona_cargo->cargo->car_nombre}}</b></h4></td>
                                </tr>

                                <?php $date = new DateTime($persona->per_fecha_contrato); ?>
                                <tr>
                                    <td><h4>Ingreso: </h4></td>
                                    <td><h4><b>&nbsp;{{$date->format('d/m/Y')}}</b></h4></td>
                                    <td><h4>Salario: </h4></td>
                                    <td><h4><b>$&nbsp;{{$salario->sal_salario}}</b></h4></td>
                                </tr>

                                <tr>
                                    <td><h4>Nivel: </h4></td>
                                    <td><h4><b>&nbsp;{{$persona_cargo->nivel->niv_nombre}}</b></h4></td>
                                    <td><h4>Tipo Contrato: </h4></td>
                                    <td><h4><b>&nbsp;{{$persona_cargo->tipo_contrato->tic_nombre}}</b></h4></td>
                                </tr>
                            </table>

                        </div>
                    </fieldset>


                </div>
            </div>
        </div>


    </div>
    <!-- end row -->
@stop
