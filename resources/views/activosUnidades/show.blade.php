
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

        <li id="li"><a  href="{{ url("activos/{$activo->id}") }}">Datos Activo</a></li>
        @if($activo->codigoInventario!=null)
        <li id="li"  ><a class="active" href="{{ url("activosUnidades/{$activo->id}") }}">Traslado</a></li>
        @else
        <li id="li"  ><a class="active" href="{{ url("activosUnidades/{$activo->id}") }}">Asignar</a></li>
      @endif
      @if($activo->precio>=600 && $activo->codigoInventario!=null)
      <li id="li" style="float:right;"><a  href="{{ url("depreciaciones/{$activo->id}") }}">Depreciación</a></li>
      @endif
        <li id="li" style="float:right;"><a href="{{ url("activos/mantenimientosUnidades/{$activo->id}") }}">Mantenimiento</a></li>
        <li id="li" style="float:right;" ><a href="">Préstamo</a></li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-profile">
                <div class="card-header card-header-icon" data-background-color="ocre">
                    <i class="material-icons">assignment</i>
                </div>

                <div class="card-content">
                  @if($activo->codigoInventario!=null)
                  <h4 class="card-title">Traslados de <b>{{$activo->nombreActivo}}</b></h4>
                  @else
                  <h4 class="card-title">Asignar Activo <b>{{$activo->nombreActivo}}</b></h4>
                @endif

                    @can('unidads.create')
                        <div class="toolbar">
                          @if($activo->codigoInventario!=null)
                          <br> <h4 class="title">Crear Nuevo Traslado </h4>
                          @else
                          <br> <h4 class="title">Crear Asignación </h4>
                        @endif

                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                            {!!Form::open(['route'=>'activosUnidades.store','method'=>'POST','autocomplete'=>'off', 'enctype'=>'multipart/form-data']) !!}
                            {!!Form::hidden('idActivo',$activo->id,['id'=>'idActivo','class'=>'form-control'])!!}
                            <div class="tab-pane" id="account">
                                <div class="row">
                                    <div  class="col-lg-10 col-sm-offset-1">
                                      <div class="col-sm-10 row">
                                          <div class="input-group">
                                              <span class="input-group-addon">
                                                  <i class="material-icons">apps</i>
                                              </span>
                                              <div class="form-group label-floating">
                                                  <label class="control-label">
                                                  </label>
                                                {!!Form::select('idUnidad',$unidades,null,['id'=>'idUnidad','class'=>'form-control','placeholder'=>'Selecione una Unidad (requerido)','required'])!!}
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-sm-10 row">
                                          <div class="input-group">
                                                      <span class="input-group-addon">
                                                          <i class="material-icons">date_range</i>
                                                      </span>
                                              <div class="form-group label-floating">
                                                  <label class="control-label"><code>*</code>Fecha de Asignación
                                                      <small></small>
                                                  </label>
                                                  {!!Form::date('fechaInicioUni',$date,['id'=>'fechaInicioUni','class'=>'form-control datepicker'])!!}

                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-sm-10 row">
                                          <div class="input-group">
                                              <span class="input-group-addon">
                                                  <i class="material-icons">apps</i>
                                              </span>
                                              <div class="form-group label-floating">
                                                  <label class="control-label">
                                                  </label>
                                                {!!Form::select('idEmpleado',$empleados,null,['id'=>'idEmpleado','class'=>'form-control','placeholder'=>'Selecione un Encargado (requerido)','required'])!!}
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-sm-10 row">
                                          <div class="input-group">
                                              <span class="input-group-addon">
                                                  <i class="material-icons">description</i>
                                              </span>
                                              <div class="form-group label-floating">
                                                  <label class="control-label">Observación:
                                                  </label>
                                                {!!Form::text('observacionUni',null,['id'=>'observacionUni','class'=>'form-control'])!!}

                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                </div>
                            </div>


                            <div align="center" class="row">
                                {!! Form::submit('Registrar',['class'=>'btn btn-verde glyphicon glyphicon-floppy-disk']) !!}
                                {!! Form::reset('Limpiar',['class'=>'btn btn-azul']) !!}
                                	<a href="{{ URL::previous() }}" class='btn btn-ocre '>Regresar</a>
                            </div>
                            {!! Form::close() !!}

                        </div>
                    @endcan
                    <br>
                    <h4 class="card-title">Historial de Traslados del Activo: <b>{{$activo->codigoInventario}}</b></h4>
                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%";>
                            <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Final</th>
                                <th>Unidad</th>
                                <th>Empleado</th>
                              </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Final</th>
                                <th>Unidad</th>
                                <th>Empleado</th>

                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $cont=0;?>
                            @foreach ($activo->activosUnidades()->orderBy('id', 'desc')->get() as $traslado)
                              <?php //dd($traslado);?>
                                <tr align="left">
                                    <td></td>
                                    <?php $cont++;?>
                                    <td>{{$cont}}</td>
                                    <?php $date = new DateTime($traslado->fechaInicioUni); ?>
                                    <td>{{$date->format('d/m/Y')}}</td>
                                    @if($traslado->fechaFinalUni==null)
                                      <td>Actual</td>
                                    @else
                                      <?php $date1 = new DateTime($traslado->fechaFinalUni); ?>
                                    <td>{{$date1->format('d/m/Y')}}</td>
                                  @endif
                                    <td>{{$traslado->unidad->nombreUnidad}}</td>
                                    <td>{{$traslado->empleado->nombresEmpleado." ".$traslado->empleado->apellidosEmpleado}}</td>

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
    <script>
        $('#idUnidad').on('change',function(e){
            var empleados=$("#idEmpleado");
            var unidad=$("#idUnidad").find('option:selected');
            var ruta="/Nonualcos/public/activos/create/"+unidad.val();
            $.get(ruta,function(res){
                empleados.empty();
                empleados.append("<option value>Seleccione un Encargado (requerido)</option>");
                $(res).each(function(key,value){
                    empleados.append("<option value="+value.id+">"+value.nombresEmpleado+" "+value.apellidosEmpleado+"</option>");
                });
            });
        });

    </script>
@endsection
