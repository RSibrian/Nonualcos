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
      @can('empleados.index')
      <li id="li"><a  href="{{ url("empleados/{$empleado->id}") }}">Datos Personales</a></li>
      @endcan
      @can('descuentos.show')
      <li id="li"  ><a  href="{{ url("descuentos/{$empleado->id}") }}">Descuentos</a></li>
      @endcan
      @can('entradasSalidas.show')
      <li id="li"  ><a  href="{{ url("entradasSalidas/{$empleado->id}") }}">Llegadas Tardía</a></li>
      @endcan
      @can('incapacidades.show')
      <li id="li" style="float:right;"><a class="active"  href="{{ url("incapacidades/{$empleado->id}") }}">Incapacidades</a></li>
      @endcan
      @can('permisos.show')
      <li id="li" style="float:right;" ><a  href="{{ url("permisos/{$empleado->id}") }}">Permisos</a></li>
      @endcan
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-profile">
                <div class="card-header card-header-icon" data-background-color="ocre">
                    <i class="material-icons">assignment</i>
                </div>
                <div   class="card-avatar">
                    <a href="{{ asset( $empleado->imagenEmpleado) }}"  data-lightbox="galeria" data-title="Nombre: {{$empleado->nombresEmpleado}} {{$empleado->apellidosEmpleado}}" >
                        <img align="left" class="img" src="{{ asset( $empleado->imagenEmpleado) }}"  alt="{{$empleado->nombresEmpleado }}">
                    </a>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Incapacidades de <b>{{$empleado->nombresEmpleado.' '.$empleado->apellidosEmpleado}}</b></h4>
                    <h6 class="campoObligatorio">los campos con ( * ) son obligatorios</h6>
                    @can('incapacidades.store')
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                        {!! Form::open(['route'=>'incapacidades.store','method'=>'POST','autocomplete'=>'off', 'enctype'=>'multipart/form-data']) !!}
                        {!!Form::hidden('idEmpleado',$empleado->id,['id'=>'idEmpleado','class'=>'form-control'])!!}
                        <div class="tab-pane" id="account">
                            <div class="row">
                                <div  class="col-lg-10 col-sm-offset-1">

                                    <div class="col-lg-10">
                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="material-icons"> chrome_reader_mode</i>
                                                        </span>
                                        <div class="form-group label-floating">
                                            <label class="control-label"><code>*</code>Seleccione motivo de incapacidad

                                            </label>
                                            <select name="casoPermiso" id="perm_tipo" class="form-control" placeholder='Seleccione el tipo de permiso' required>
                                                <option value=></option>
                                                <option value="4">Enfermedad Común</option>
                                                <option value="5">Enfermedad Profesional</option>
                                                <option value="6">Accidente Común</option>
                                                <option value="7">Accidente de Trabajo</option>
                                                <option value="8">Maternidad</option>
                                                <option value="9">Paternidad</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="material-icons"> description </i>
                                                        </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label"><code>*</code>Seleccione tipo de incapacidad

                                                </label>
                                                <select name="tipoPermiso" id="perm_caso" class="form-control" placeholder='Seleccione el tipo de permiso' required>
                                                    <option value=></option>
                                                    <option value="4">Inicial</option>
                                                    <option value="5">Prórroga</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 ">
                                        <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class=""><b>&nbsp; Fecha del</b></i>
                                                        </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">
                                                </label>
                                                {!!Form::date('fechaPermisoInicio',$date,['id'=>'perm_fecha_inicio','class'=>'form-control datepicker'])!!}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 ">
                                        <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i ><b>al</b></i>
                                                        </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label ">
                                                </label>
                                                {!!Form::date('fechaPermisoFinal',null,['id'=>'perm_fecha_final','class'=>'form-control datepicker'])!!}

                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 row">
                                        <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="material-icons">assignment_turned_in</i>
                                                        </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Observación:
                                                </label>
                                                {!! Form::textarea('motivoPermiso',null,['class'=>'form-control'  ,'rows'=>'2', 'style'=>'resize: both;']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class=" row row" >
                                        <span class="col-md-2  text-center" ><label >PDF del comprobante:</label></span>
                                        <div class="col-md-6">
                                            {!!Form::file('permisoPdf2',['value'=>'Elija la incapacidad', 'accept'=>'application/pdf'])!!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div align="center" class="row">
                            {!! Form::submit('Registrar',['class'=>'btn btn-verde glyphicon glyphicon-floppy-disk']) !!}
                            {!! Form::reset('Limpiar',['class'=>'btn btn-azul']) !!}
                            <a href="{{ url("empleados") }}" class='btn btn-ocre '>Regresar</a>
                        </div>
                        {!! Form::close() !!}

                    </div>
                    @endcan
                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%";>
                            <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Final</th>
                                <th>Motivo</th>
                                <th>Tipo</th>
                                <th>Explicación</th>

                                <th>PDF</th>


                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Final</th>
                                <th>Motivo</th>
                                <th>Tipo</th>
                                <th>Explicación</th>

                                <th>PDF</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $cont=0;?>
                            @foreach ($empleado->permisos()->where('perm_opcion',true)->orderBy('id', 'desc')->get() as $incapacidad)
                                @include('incapacidades.terminar')
                                <tr align="left">
                                    <td></td>
                                    <?php $cont++;?>
                                    <td>{{$cont}}</td>
                                    <?php $date = new DateTime($incapacidad->fechaPermisoInicio); ?>
                                    <td>{{$date->format('d/m/Y')}}</td>
                                    @if($incapacidad->fechaPermisoFinal!=null)
                                        <?php $date2 = new DateTime($incapacidad->fechaPermisoFinal); ?>
                                        <td>{{$date2->format('d/m/Y')}}</td>
                                    @else
                                        <td>{{$date->format('d/m/Y')}}</td>
                                    @endif

                                    @if($incapacidad->casoPermiso==4)
                                        <td>Enfermedad Común</td>
                                    @endif
                                    @if($incapacidad->casoPermiso==5)
                                        <td>Enfermedad Profesional</td>
                                    @endif
                                    @if($incapacidad->casoPermiso==6)
                                        <td>Accidente Común</td>
                                    @endif
                                    @if($incapacidad->casoPermiso==7)
                                        <td>Accidente de Trabajo</td>
                                    @endif
                                    @if($incapacidad->casoPermiso==8)
                                        <td>Maternidad</td>
                                    @endif
                                    @if($incapacidad->casoPermiso==9)
                                        <td>Paternidad</td>
                                    @endif

                                    @if($incapacidad->tipoPermiso==4)
                                        <td>Inicial</td>
                                    @endif
                                    @if($incapacidad->tipoPermiso==5)
                                        <td>Prórroga</td>
                                    @endif
                                    <td>{{$incapacidad->motivoPermiso?:"Ninguna"}}</td>

                                    <td>
                                        @if($incapacidad->permisoPdf==null)
                                            <button type="submit"  class="btn btn-xs btn-ocre btn-round" data-toggle="modal" data-target="#gridSystemModal2{{$incapacidad->id}}">Agregar Comprobante</button>
                                        @else
                                            <a href="{{ asset($incapacidad->permisoPdf) }}" target="_blank" class="btn btn-xs btn-azul btn-round">
                                            <i class="material-icons">local_printshop</i>
                                            Imprimir
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
    <!-- end row -->
@stop
@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatables').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                }

            });


            var table = $('#datatables').DataTable();

            // Edit record
            table.on('click', '.edit', function() {
                $tr = $(this).closest('tr');

                var data = table.row($tr).data();
                alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
            });

            // Delete a record
            table.on('click', '.remove', function(e) {
                $tr = $(this).closest('tr');
                table.row($tr).remove().draw();
                e.preventDefault();
            });

            //Like record
            table.on('click', '.like', function() {
                alert('You clicked on Like button');
            });

            $('.card .material-datatables label').addClass('form-group');
        });
    </script>
@endsection
