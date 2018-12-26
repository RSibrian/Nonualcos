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
        <li id="li"><a  href="{{ url("empleados/{$empleado->id}") }}">Datos Personales</a></li>
        <li id="li"  ><a href="{{ url("descuentos/{$empleado->id}") }}">Descuentos</a></li>
        <li id="li"  ><a  class="active" href="{{ url("entradasSalidas/{$empleado->id}") }}">Llegadas Tardias</a></li>
        <li id="li" style="float:right;"><a href="{{ url("incapacidades/{$empleado->id}") }}">Incapacidades</a></li>
        <li id="li" style="float:right;" ><a  href="{{ url("permisos/{$empleado->id}") }}">Permisos</a></li>

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
                  <h4 class="card-title">Llegadas Tardias de <b>{{$empleado->nombresEmpleado.' '.$empleado->apellidosEmpleado}}</b></h4>
                  <h4 class="card-title">Salario <b>$ {{$empleado->salarioBruto}}</b></h4>

                    @can('unidads.create')
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                        {!! Form::open(['route'=>'entradasSalidas.store','method'=>'POST','autocomplete'=>'off', 'enctype'=>'multipart/form-data']) !!}
                        {!!Form::hidden('idEmpleado',$empleado->id,['id'=>'idEmpleado','class'=>'form-control'])!!}
                        <?php
                        $salarioDia=$empleado->salarioBruto/31;
                        $salarioHora=$salarioDia/8;
                        $salarioMinutos=$salarioHora/60;
                        ?>
                        {!!Form::hidden('salarioHora',$salarioHora,['id'=>'salarioHora','class'=>'form-control'])!!}
                        <div class="tab-pane" id="account">
                            <div class="row">
                                <div  class="col-lg-10 col-sm-offset-1">



                                    <div class="col-sm-5 ">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class=""><b>&nbsp; Fecha del </b></i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">
                                                </label>
                                                {!!Form::date('fechaInicio',$date,['id'=>'fechaInicio','class'=>'form-control datepicker'])!!}

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-5 ">
                                        <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i ><b>al</b></i>
                                                        </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label ">
                                                </label>
                                                {!!Form::date('fechaFin',$date2,['id'=>'fechaFin','class'=>'form-control datepicker'])!!}

                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-5 row">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">alarm</i>
                                            </span>
                                            <div class="form-group ">
                                                <label class="control-label"><code>*</code>Tiempo Total:
                                                </label>
                                                {!! Form::time('tiempoHora',null,['id'=>'tiempoHora','class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-5 row">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">$</i>
                                            </span>
                                            <div class="form-group">
                                                <label class="control-label">Total a Descontar:
                                                </label>
                                                {!! Form::number('costoTiempo2',0,['id'=>'costoTiempo2','class'=>'form-control', 'step'=>"2" ,'rows'=>'2', 'style'=>'resize: both;','disabled']) !!}
                                                {!!Form::hidden('costoTiempo',0,['id'=>'costoTiempo','class'=>'form-control'])!!}
                                            </div>
                                        </div>
                                    </div>
                                    <br>

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
                                <th>Fecha Inicio</th>
                                <th>Fecha Final</th>
                                <th>Tiempo Total</th>
                                <th>Total a descontar</th>



                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                              <th></th>
                              <th>#</th>
                              <th>Fecha Inicio</th>
                              <th>Fecha Final</th>
                              <th>Tiempo Total</th>
                              <th>Total a descontar</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $cont=0;?>
                            @foreach ($entradasSalidas as $entradaSalida)
                                <tr align="left">
                                    <td></td>
                                    <?php $cont++;?>
                                    <td>{{$cont}}</td>
                                    <?php $date = new DateTime($entradaSalida->fechaInicio); ?>
                                    <td>{{$date->format('d/m/Y')}}</td>

                                    <?php $date2 = new DateTime($entradaSalida->fechaFin); ?>
                                    <td>{{$date2->format('d/m/Y')}}</td>

                                    <td>{{$entradaSalida->tiempoHora}}</td>
                                    <td>{{$entradaSalida->costoTiempo}}</td>


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
    <script  type="text/javascript">
    $('#tiempoHora').on('change',function(e){
      var salario=$("#salarioHora").val();
      var tiempoHora=$("#tiempoHora").val();
      //console.log(salario);
      var d = new Date("0001-01-01T"+tiempoHora);
      hora = d.getHours()*salario;
      minutos=d.getMinutes()*(salario/60);
      var costo= hora+minutos;
      var costoTiempo=$("#costoTiempo").val(costo.toFixed(2));
      var costoTiempo2=$("#costoTiempo2").val(costo.toFixed(2));


    });
    </script>
@endsection
