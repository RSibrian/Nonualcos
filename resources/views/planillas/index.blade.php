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
                        echo " Mes : ".$mes;
                        echo " Dias : ". $dias;
                        echo " Año : ". $anno;

                    ?>
                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%";>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>Numero de DUI</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Codigo</th>
                                    <th>Cargo</th>
                                    <th>Salario</th>
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
                                    <th>Numero&nbsp;DUI</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Codigo</th>
                                    <th>Cargo</th>
                                    <th>Salario&nbsp;Personal </th>
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
                                    <?php
                                        $salario=$empleado->salarioBruto;//500
                                        $salario_diario=$salario/$dias;//500/31=16.1290
                                        $salario_ganado=$salario_diario*$dias;//fataria descontar dias por permisos sin goce
                                            // y aplicar las incapacides
                                        $ISSS=0;
                                        $AFP=0;
                                        if($salario_ganado>=1000)
                                        {
                                            $ISSS=30;
                                        }
                                        else
                                        {
                                           $ISSS = $empleado->seguro->desEmpleadoAportacion * $salario_ganado;//3*500=
                                           $ISSS=$ISSS/100;//1500/100=15
                                        }
                                        $AFP_nombre=$empleado->AFP->nombreAportacion;//nombre
                                        $AFP=$salario_ganado*$empleado->AFP->desEmpleadoAportacion;//500*7.25=
                                        $AFP=$AFP/100;
                                        //salario ganado tengo descontar llegadas tardias?
                                        $total_descuentos=$ISSS+$AFP;
                                        $salario_descuentos=$salario_ganado-$total_descuentos;
                                        $renta=\App\Renta::where('desde','<=',$salario_descuentos)->where('hasta','>=',$salario_descuentos)->get();
                                                                    //0.01   <= 450=si              y       472 >= 450 = si
                                        $salario_exceso=$salario_descuentos-$renta->first()->sobreExceso;
                                        $descuento_renta = ($salario_exceso * ($renta->last()->porcentaje / 100)) + $renta->last()->cuotaFija;
                                        $total_descuentos+=  $descuento_renta;
                                        $liquido=$salario_ganado-$total_descuentos;

                                    ?>
                                    <tr>
                                        <td></td>
                                        <?php $cont++;?>
                                        <td>{{$cont}}</td>
                                        <td >{{$empleado->DUIEmpleado}}</td>
                                        <td>{{$empleado->nombresEmpleado}}</td>
                                        <td>{{$empleado->apellidosEmpleado}}</td>
                                        <td>{{$empleado->cargo->unidad->nombreUnidad}}</td>
                                        <td>{{$empleado->cargo->nombreCargo}}</td>
                                        <td>$&nbsp;{{number_format($salario, 2, '.', ',')}}</td>
                                        <td>${{number_format($ISSS, 2, '.', ',')}}</td>
                                        <td>${{number_format($AFP, 2, '.', ',')}}</td>
                                        <td>${{number_format($descuento_renta, 2, '.', ',')}}</td>
                                        <td>$ - </td>
                                        <td>$ {{number_format(round($total_descuentos,2), 2, '.', ',')}}</td>
                                        <td>$ {{number_format(round($liquido,2), 2, '.', ',')}}</td>
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
