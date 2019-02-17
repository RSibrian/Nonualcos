@extends ('plantilla')
@section('plantilla')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="ocre">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Planilla</h4>
                    <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <?php
                    $mes=date("m");
                    $dias=date("t");
                    $anno=date("Y");
                    $fecha_fin_inicio = date($anno."-".$mes."-01");
                    $fecha_fin = date($anno."-".$mes."-".$dias);
                    $fecha_fin_mes =date("Y-m-d", strtotime("$fecha_fin_inicio +1 month"));

                    ?>
                    <a  aling='right' href="{{ url("aguinaldos/create/excel") }}" class="btn  btn-verde btn-round " title="Descargar Planilla en Archivo EXCEL">
                        <i class="material-icons"></i>
                        Aguinaldo de Empleados
                    </a>
                    <a  aling='right' href="{{ url("aguinaldos/create/reporte") }}"  target="_blank" class="btn  btn-ocre btn-round " title="Descargar Boletas en Archivo PDF">
                        <i class="material-icons"></i>
                        Boleta de pago
                    </a>
                    {!! Form::open(['route'=>'aguinaldos.store','method'=>'POST']) !!}
                    <input type="hidden" name="concepto" value="Pago de Aguinaldo {{$mes}} de {{$anno}} execto 608.34 ">
                    <div align="center" class="row">
                        {!! Form::submit('Procesar',['id'=>"agregar_permiso", "onclick"=>"myFunction()" ,'class'=>'btn btn-verde glyphicon glyphicon-floppy-disk']) !!}
                    </div>
                    {!! Form::close() !!}



                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%";>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>Número de DUI</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Unidad</th>
                                    <th>Cargo</th>
                                    <th>Salario</th>
                                    <th>Dias</th>
                                    <th>Salario Ganado</th>
                                    <th>ISSS</th>
                                    <th>AFP</th>
                                    <th>Renta</th>
                                    <th>LLegadas tarde</th>
                                    <th>Total de Descuentos</th>
                                    <th>Salario Neto</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>Número&nbsp;DUI</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Unidad</th>
                                    <th>Cargo</th>
                                    <th>Salario&nbsp;Personal </th>
                                    <th>Dias</th>
                                    <th>Salario Ganado</th>
                                    <th>ISSS</th>
                                    <th>AFP</th>
                                    <th>Renta</th>
                                    <th>LLegadas tarde</th>
                                    <th>Total de Descuentos</th>
                                    <th>Salario&nbsp;Neto</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                 <?php $cont=0;?>
                                @foreach ($empleados as $empleado)
                                    <tr>
                                        <td></td>
                                        <?php $cont++;?>
                                        <td>{{$cont}}</td>
                                        <td>{{$empleado->DUIEmpleado}}</td>
                                        <td>{{$empleado->nombresEmpleado}}</td>
                                        <td>{{$empleado->apellidosEmpleado}}</td>
                                        <td>{{$empleado->cargo->unidad->nombreUnidad}}</td>
                                        <td>{{$empleado->cargo->nombreCargo}}</td>
                                        <td>${{\Helper::dinero(round($empleado->salarioBruto,2))}}</td>
                                        <td>{{$empleado->dias_trabajados}}</td>
                                        <td>${{\Helper::dinero(round($empleado->salario_ganado,2))}}</td>
                                        <td>${{\Helper::dinero(round($empleado->ISSS,2))}}</td>
                                        <td>${{\Helper::dinero(round($empleado->AFP_empleado,2))}}</td>
                                        <td>${{\Helper::dinero(round($empleado->descuento_renta,2))}}</td>
                                        <td>${{\Helper::dinero(round($empleado->descuento_tiempo,2))}} </td>
                                        <td>${{\Helper::dinero(round($empleado->total_descuentos,2))}}</td>
                                        <td>${{\Helper::dinero(round($empleado->liquido,2))}}</td>
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
