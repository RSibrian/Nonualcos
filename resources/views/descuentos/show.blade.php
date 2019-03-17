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
        <li id="li"><a href="{{ url("empleados/{$empleado->id}") }}">Datos Personales</a></li>
        @endcan
        @can('descuentos.show')
        <li id="li"  ><a class="active" href="{{ url("descuentos/{$empleado->id}") }}">Descuentos</a></li>
        @endcan
        @can('entradasSalidas.show')
        <li id="li"  ><a  href="{{ url("entradasSalidas/{$empleado->id}") }}">Llegadas Tardía</a></li>
        @endcan
        @can('incapacidades.show')
        <li id="li" style="float:right;"><a  href="{{ url("incapacidades/{$empleado->id}") }}">Incapacidades</a></li>
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
                    <h4 class="card-title">Descuentos de <b>{{$empleado->nombresEmpleado.' '.$empleado->apellidosEmpleado}}</b></h4>
                    <!--h5>Salario: {{--number_format($salario->sal_salario, 2, '.', ',')--}}</h5-->
                    <h5>Cuota Pendiente: {{number_format($sumatoria_prestamo, 2, '.', ',')}}</h5>
                    <h5>Cuota Maxima: {{number_format($cuota_max, 2, '.', ',')}}</h5>
                @can('descuentos.store')
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                        {!! Form::open(['route'=>'descuentos.store','method'=>'POST','autocomplete'=>'off', 'enctype'=>'multipart/form-data']) !!}
                        {!!Form::hidden('idEmpleado',$empleado->id,['id'=>'idEmpleado','class'=>'form-control'])!!}
                        <div class="tab-pane" id="account">
                            <div class="row">
                                <div  class="col-lg-10 col-sm-offset-1">
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="material-icons"> home </i>
                                                        </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">

                                                </label>
                                                <select name="tipoDescuento" id="tipoDescuento" class="form-control" required>
                                                    <option value=>Selecione el tipo de Descuento</option>
                                                    <option value="1">Prestamo</option>
                                                    <option value="2">Cuota Alimentaria </option>
                                                    <option value="3">Otros</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-10">
                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="material-icons"> home </i>
                                                        </span>
                                        <div class="form-group label-floating">
                                            <label class="control-label">

                                            </label>
                                            {!!Form::select('banco_id', $bancos,null,['placeholder'=>'seleccione el banco','required','id'=>'banco_id','class'=>'form-control'])!!}


                                        </div>
                                    </div>
                                </div>
                                    <div class="col-lg-6 ">
                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="material-icons">&nbsp;# </i>
                                                        </span>
                                        <div class="form-group label-floating">
                                            <label class="control-label"> Numero de cuenta
                                                <small></small>
                                            </label>
                                            {!!Form::number('numeroCuenta',null,['id'=>'numeroCuenta','class'=>'form-control'])!!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="material-icons"> &nbsp;$&nbsp; </i>
                                                        </span>
                                        <div class="form-group label-floating">
                                            <label class="control-label">$ Monto
                                            </label>
                                            {!!Form::number('pago',null,['id'=>'pago','class'=>'form-control','required','step' => '0.01'])!!}
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-lg-12 row">
                                        <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="material-icons">place</i>
                                                        </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Detalle:
                                                </label>
                                                {!! Form::textarea('observacionDescuento',null,['class'=>'form-control'  ,'rows'=>'2', 'style'=>'resize: both;']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class=" row row" >
                                        <span class="col-md-2  text-center" ><label ><code>*</code> PDF del comprobante:</label></span>
                                        <div class="col-md-6">
                                            {!!Form::file('pre_imagen2',['value'=>'Comprobante del prestamo', 'accept'=>'application/pdf','required'])!!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div align="center" class="row">
                            {!! Form::submit('Registrar',['class'=>'btn btn-verde glyphicon glyphicon-floppy-disk']) !!}
                            {!! Form::reset('Limpiar',['class'=>'btn btn-azul']) !!}
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
                                <th>Nombre del Banco</th>
                                <th>Numero de Cuenta</th>
                                <th>Monto</th>
                                <th>Explicación</th>
                                <th>Tipo</th>
                                <th>PDF Comprobante</th>


                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Nombre del Banco</th>
                                <th>Numero de Cuenta</th>
                                <th>Monto</th>
                                <th>Explicación</th>
                                <th>Tipo</th>
                                <th>PDF&nbsp;&nbsp;Comprobante&nbsp;Descuento</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $cont=0;?>
                            @foreach ($empleado->descuentos()->orderBy('id', 'desc')->get() as $descuento)
                                @include('descuentos.terminar')
                                <tr align="left">
                                    <td></td>
                                    <?php $cont++;?>
                                    <td>{{$cont}}</td>
                                    <td>{{$descuento->banco->ban_nombre}}</td>
                                    <td>{{$descuento->numeroCuenta}}</td>
                                    <td>{{$descuento->pago}}</td>
                                    <td>{{$descuento->observacionDescuento?:"Ninguna"}}</td>
                                    @if($descuento->tipoDescuento==1)
                                        <td>Préstamo</td>
                                    @endif
                                    @if($descuento->tipoDescuento==2)
                                        <td>Cuota Alimentaria</td>
                                    @endif
                                    @if($descuento->tipoDescuento==3)
                                        <td>Otros</td>
                                    @endif
                                    <td><a href="{{ asset($descuento->imagenInicio) }}" target="_blank" class="btn btn-xs btn-azul btn-round">
                                            <i class="material-icons">local_printshop</i>
                                              Inicio
                                        </a>
                                        @if($descuento->estadoDescuento==1)

                                            <button type="submit"  class="btn btn-xs btn-ocre btn-round" data-toggle="modal" data-target="#gridSystemModal2{{$descuento->id}}">Finalizar</button>

                                        @else
                                            <a href="{{ asset($descuento->imagenFinal) }}" target="_blank" class="btn btn-xs btn-azul btn-round">
                                                <i class="material-icons">local_printshop</i>
                                                Final
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
