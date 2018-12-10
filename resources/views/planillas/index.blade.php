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
                    $fecha_fin_mes = date($anno."-".$mes."-01");
                    $fecha_fin_mes =date("Y-m-d", strtotime("$fecha_fin_mes +1 month"));

                    ?>
                    <a  aling='right' href="{{ url("planillas/create/excel") }}" class="btn  btn-verde btn-round ">
                        <i class="material-icons"></i>
                        Planilla de Empleados
                    </a>
                    <a  aling='right' href="{{ url("planillas/create/reporte") }}"  target="_blank" class="btn  btn-ocre btn-round ">
                        <i class="material-icons"></i>
                        boleta de pago
                    </a>



                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%";>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>Numero de DUI</th>
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
                                    <th>Numero&nbsp;DUI</th>
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
                                    <?php
                                    $permisos=$empleado->permisos;
                                    $dias=date("t");
                                    $dias_permios_sin_goce=0;
                                    $dias_incapacidad=0;
                                    $dias_maternidad=0;
                                    $salario_x_incapacidad=0;
                                    $p=0;
                                    $i=0;
                                    $m=0;
                                    $diaPermisos=\App\Permiso::diaPermisoDB($empleado->id,$fecha_fin_mes);
                                    foreach ($diaPermisos as $diaPermiso)
                                    {
                                        //dd($diaPermiso);
                                        if($diaPermiso->tipoPermiso==2) $dias_permios_sin_goce+=$diaPermiso->dip_dias;
                                        else if ($diaPermiso->casoPermiso=="8") $dias_maternidad+=$diaPermiso->dip_dias;
                                        else if ($diaPermiso->tipoPermiso==4 || $diaPermiso->tipoPermiso==5) $dias_incapacidad+=$diaPermiso->dip_dias;
                                    }

                                    $dias_trabajados=$dias;
                                    $salario=$empleado->salarioBruto;
                                    $salario_diario=$salario/$dias;

                                    if($dias_trabajados>0)
                                        if($dias_trabajados>$dias_permios_sin_goce)
                                        {
                                            $p=$dias_permios_sin_goce;
                                            $dias_trabajados-=$dias_permios_sin_goce;
                                        }
                                        else{
                                            $p=$dias_trabajados;
                                            $dias_trabajados=$dias_trabajados-$p;
                                        }
                                    if($dias_trabajados>0){
                                        if($dias_trabajados>$dias_maternidad)
                                        {
                                            $m=$dias_maternidad;
                                            $dias_trabajados-=$dias_maternidad;
                                        }
                                        else{
                                            $m=$dias_trabajados;
                                            $dias_trabajados=$dias_trabajados-$m;
                                        }
                                    }
                                    if($dias_trabajados>0) {
                                        if($dias_trabajados>$dias_incapacidad)
                                        {
                                            $dias_trabajados-=$dias_incapacidad;
                                            $i=$dias_incapacidad;
                                            $salario_x_incapacidad=($salario_diario*0.25)*$dias_incapacidad;
                                        }
                                        else{
                                            $i=$dias_trabajados;
                                            $dias_trabajados=$dias_trabajados-$i;
                                            $salario_x_incapacidad=($salario_diario*0.25)*$i;
                                        }
                                    }

                                //    echo  "permisos= ".$p." Maternidad= ".$m." Incapacidad= ".$i. "<br>";

                                        $salario=$empleado->salarioBruto;//500
                                        $salario_diario=$salario/$dias;//500/31=16.1290
                                        $salario_ganado=$salario_diario*$dias_trabajados;//fataria descontar dias por permisos sin goce
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
                                        $descuentos=$empleado->descuentos()->where('estadoDescuento',true)->get();
                                        $descuento_prestamo=0;
                                        $descuentos_alimeticios=0;
                                        $otros=0;
                                        foreach ($descuentos as $descuento)
                                        {

                                            if($descuento->tipoDescuento==1) $descuento_prestamo+=$descuento->pago;
                                            else if($descuento->tipoDescuento==2) $descuentos_alimeticios+=$descuento->pago;
                                            else $otros+=$descuento->pago;

                                        }

                                        $total_descuentos=$AFP;
                                        $salario_descuentos=$salario_ganado-$total_descuentos;
                                    if($salario_descuentos!=0)
                                    {
                                        $renta=\App\Renta::where('desde','<=',$salario_descuentos)->where('hasta','>=',$salario_descuentos)->get();
                                        $salario_exceso=$salario_descuentos-$renta->first()->sobreExceso;
                                        $descuento_renta = ($salario_exceso * ($renta->last()->porcentaje / 100)) + $renta->last()->cuotaFija;
                                    }
                                    else {
                                        $salario_exceso=0;
                                        $descuento_renta=0;
                                    }
                                        $total_descuentos=$descuento_renta+$ISSS+$AFP;
                                        $liquido=$salario_ganado-$total_descuentos;
                                        $tota_pre=$descuentos_alimeticios+$descuento_prestamo+$otros;
                                        $prestamoBandera=false;
                                        if($liquido>=$tota_pre){
                                            $prestamoBandera=true;
                                            $total_descuentos+=$tota_pre;// le restamos la cuota alimenticia al liquido
                                        }
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
                                        <td>$&nbsp;{{number_format($empleado->salarioBruto, 2, '.', ',')}}</td>
                                        <td>{{$dias_trabajados}}</td>
                                        <td>$&nbsp;{{number_format($salario_ganado, 2, '.', ',')}}</td>
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
