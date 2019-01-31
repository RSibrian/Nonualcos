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
    <ul id="ul">
        <li id="li"><a class="active" href="{{ url("empleados/{$empleado->id}") }}">Datos Personales</a></li>
        <li id="li"  ><a href="{{ url("descuentos/{$empleado->id}") }}">Descuentos</a></li>
        <li id="li"  ><a href="{{ url("entradasSalidas/{$empleado->id}") }}">Llegadas Tardía</a></li>
        <li id="li" style="float:right;"><a  href="{{ url("incapacidades/{$empleado->id}") }}">Incapacidades</a></li>
        <li id="li" style="float:right;" ><a  href="{{ url("permisos/{$empleado->id}") }}">Permisos</a></li>
    </ul>
    <div class="row">
        <div class="col-md-10 col-sm-offset-1">
            <div class="card card-profile">
                <div class="card-header card-header-icon" data-background-color="blue">
                    <i class="material-icons">person</i>
                </div>
                <div class="card-avatar">
                    <a href="{{ asset( $empleado->imagenEmpleado) }}"  data-lightbox="galeria" data-title="Nombre: {{$empleado->nombresEmpleado}} {{$empleado->apellidosEmpleado}}" >
                        <img class="img" src="{{ asset( $empleado->imagenEmpleado) }}"  alt="{{$empleado->nombresEmpleado }}">
                    </a>
                </div>
                <div class="card-content">
                    <fieldset>
                        <input type="hidden" name="hi2" value="1">
                        <div class="form-group" align="left">
                            <table >
                                <tr>
                                    <td colspan="4" class="text-center"><h3 id="texto"><b>&nbsp;Información del Empleado </b></h3></td>
                                </tr>
                                <tr>
                                    <td><h4>Nombres: </h4></td>
                                    <td><h4> <b>&nbsp;{{$empleado->nombresEmpleado}}</b></h4></td>

                                </tr>
                                <tr>
                                    <td><h4>Apellidos: </h4></td>
                                    <td><h4> <b>&nbsp;{{$empleado->apellidosEmpleado}}</b></h4></td>
                                </tr>
            <?php
            $edad= \Carbon\Carbon::now()->diffInYears($empleado->fechaNacimientoEmpleado);
            ?>
                                <tr>
                                    <td><h4>Fecha de Nacimiento: </h4></td>
                                    <td><h4><b>{{\Helper::fecha($empleado->fechaNacimientoEmpleado)}} ({{$edad}} años)</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>DUI: </h4></td>
                                    <td><h4><b>&nbsp;{{$empleado->DUIEmpleado}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>NIT: </h4></td>
                                    <td><h4><b>&nbsp;{{$empleado->NITEmpleado}}</b></h4></td>
                                </tr>
                                <?php $telefonos=$empleado->telefonosEmpleado;?>
                                <tr>
                                    <td><h4>Teléfono(s): </h4></td>
                                    <?php if (empty($telefonos[0])): ?>
                                      <td><h4><b>{{"Ninguno"}}</b></h4></td>
                                      <?php else: ?>
                                    <?php foreach ($telefonos as $tel): ?>
                                      <td><h4><b>|  {{$tel->telefonoEmpleado}} - {{$tel->tipoTelefono}} | </b></h4></td>
                                    <?php endforeach; ?>
                                  <?php endif; ?>

                                </tr>
                                <tr>
                                    <td><h4>Género: </h4></td>
                                    <td><h4><b>&nbsp;{{$empleado->generoEmpleado}}</b></h4></td>

                                </tr>
                                <tr>
                                    <td><h4>Estado Civil: </h4></td>
                                    <td><h4><b>&nbsp;{{$empleado->estadoCivilEmpleado}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Dirección: </h4></td>
                                    <td colspan="3"><h4><b>&nbsp;{{$empleado->dirreccionEmpleado}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Observaciones: </h4></td>
                                    <td><h4><b>&nbsp;{{$empleado->observacionEmpleado?:"Ninguna"}}</b></h4></td>
                                </tr>

                                <tr>
                                    <td colspan="4" class="text-center"><h3 id="texto"><b>&nbsp;Información del Cargo </b></h3></td>
                                </tr>
                                <tr>
                                    <td><h4>Unidad: </h4></td>
                                    <td><h4><b>&nbsp;{{$empleado->cargo->unidad->nombreUnidad}} &nbsp;&nbsp;&nbsp;&nbsp;</b></h4></td>

                                </tr>
                                <tr>
                                    <td><h4>Cargo: </h4></td>
                                    <td><h4><b>&nbsp;{{$empleado->cargo->nombreCargo}}</b></h4></td>
                                </tr>

                                <tr>
                                    <td><h4>Fecha de Ingreso: </h4></td>
                                    <td><h4><b>{{\Helper::fecha($empleado->fechaIngreso)}}</b></h4></td>

                                </tr>
                                <tr>
                                    <td><h4>Salario: </h4></td>
                                    <td><h4><b>$&nbsp;{{$empleado->salarioBruto}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Tipo de Contrato: </h4></td>
                                    <td><h4><b>&nbsp;{{$empleado->sistemaContratacion}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Seguro Social: </h4></td>
                                    <td><h4><b>&nbsp;{{$empleado->seguro->nombreAportacion}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4># Afiliación del seguro: </h4></td>
                                    <td><h4><b>&nbsp;{{$empleado->numeroSeguro?:"Ninguno"}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>AFP: </h4></td>
                                    <td><h4><b>&nbsp;{{$empleado->AFP->nombreAportacion}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4># Afiliación de la AFP: </h4></td>
                                    <td><h4><b>&nbsp;{{$empleado->numeroAFP?:"Ninguno"}}</b></h4></td>
                                </tr>

                            </table>
                            <div align="center">
                                <a href="{{ route('empleados.index') }}" class='btn btn-ocre '>Regresar</a>
                            </div>
                        </div>
                    </fieldset>


                </div>
            </div>
        </div>


    </div>
    <!-- end row -->
@stop
