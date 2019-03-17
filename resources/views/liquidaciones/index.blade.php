@extends ('plantilla')
@section('plantilla')
    <?php  date_default_timezone_set('America/El_Salvador'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="ocre">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="card-header card-header-icon" data-background-color="azul" data-toggle="modal" data-target="#myModal">
                    <i class="material-icons">help</i>

                </div>
                <div class="card-content">
                    <h4 class="card-title">Liquidar vales</h4>
                    <div class="toolbar">
                        @can('liquidaciones.create')
                            <a href="{{ route('liquidaciones.create') }}" class="btn btn-verde btn-round ">
                                <i class="material-icons">add</i>
                                Nuevo
                            </a>
                            <a class="btn btn-xs btn-ocre btn-round" data-toggle="modal" data-target="#exampleModal" title="Reporte General">
                                <i class="material-icons">assignment</i>
                            </a>
                            {{--route('liquidacion.reporteG') --}}

                        @endcan
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>No. de factura</th>
                                    <th>Vehículo</th>
                                    <th>Total en factura</th>
                                    <th class="disabled-sorting text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>No. de factura</th>
                                    <th>Vehículo</th>
                                    <th>Total en factura</th>
                                    <th class="text-right">Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php $cont=0;
                            ?>
                            @foreach($liquidaciones as $liquidacion)
                              <tr>
                                  <?php $cont++;?>
                                <td id="{{$liquidacion->id}}"></td>
                                <td>{{ $cont }}</td>
                                <td>{{ \Helper::fecha($liquidacion->fechaLiquidacion) }}</td>
                                <td>{{ $liquidacion->numeroFacturaLiquidacion }}</td>
                                      <?php $vehiculo= $liquidacion->vale;?>
                                      @foreach($vehiculo as $ve)
                                          <?php $placa=$ve->salida->vehiculo?>
                                      @endforeach
                                 <td>{{ $placa->numeroPlaca}}</td>
                                <td>{{ "$ ".$liquidacion->montoFacturaLiquidacion }}</td>
                                <td class="text-right">
                                  @can('liquidaciones.edit')
                                      <a href="{{ route('liquidaciones.edit', $liquidacion->id) }}"  class="btn btn-xs btn-info btn-round collapse ">
                                          <i title="Editar Liquidacion" class="material-icons" rel="tooltip">create</i>
                                      </a>
                                  @endcan
                                  <a href="{{ route('liquidaciones.show', $liquidacion->id) }}" class="btn btn-xs btn-info btn-round">
                                      <i title="Mostrar" class="material-icons" rel="tooltip">visibility</i>
                                  </a>
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
    <div class="col-md-1"></div>
    <?php
    $ayuda_title="Ayuda para la Tabla de Liquidaciones";
    $ayuda_body="Cada Liquidación tiene 3 botones <br>

                   1- Este <i class='material-icons'>visibility</i> Icono es para ver los datos de la liquidación"
    ?>
    @include('alertas.ayuda')

<style>
        td.details-control {
            background: url('http://www.datatables.net/examples/resources/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('http://www.datatables.net/examples/resources/details_close.png') no-repeat center center;
        }
</style>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Seleccione la Fecha de Inicio y Fin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                            <div class="form-group label-floating">
                                <label class="control-label">Fecha de inicio
                                    <small >(*)</small>
                                </label>
                                {!!Form::date('fechaI',$fechaInicio,['id'=>'fechaI','class'=>'form-control datepicker', 'max' => date('Y-m-d')])!!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                            <div class="form-group label-floating">
                                <label class="control-label">Fecha fin
                                    <small >(*)</small>
                                </label>
                                {!!Form::date('fechaF',$fechaFinal,['id'=>'fechaF','class'=>'form-control datepicker', 'max' => date('Y-m-d')])!!}
                            </div>
                        </div>
                    </div>
                    <div id="texto" align="center" style="color: red;"></div>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button id="generar" type="button" class="btn btn-verde">Descargar</button>
                </div>
            </div>
        </div>
    </div>
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
            "columns": [
                {
                    "className":      'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                { "data": "#" },
                { "data": "Fecha" },
                { "data": "No. de factura" },
                { "data": "Vehículo" },
                { "data": "Total en factura" },
                { "data": "Acciones" }
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }

        });

        var table = $('#datatables').DataTable();


        // Add event listener for opening and closing details
        $('#datatables tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var val=$(this).attr('id');

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                format(row.child,val);
                tr.addClass('shown');
            }
        } );

        $('.card .material-datatables label').addClass('form-group');
    });

    function format ( callback, val ) {
        var newUrl = "{{ route('liquidaciones.vales', ['liquidacion' => ':liquidacion']) }}";
        newUrl = newUrl.replace(':liquidacion', val);
        $.ajax({
            url:newUrl,
            dataType: "json",
            complete: function (response) {
                var data = JSON.parse(response.responseText);
                var cont=0;
                var thead = '',  tbody = '';
                thead = '<tr>'+
                        '<th>' +" # "+ '</th>'+
                        '<th>' +" Fecha "+ '</th>'+
                        '<th>' +" Número de vale "+ '</th>'+
                        '<th>' +" Unidad "+ '</th>'+
                        '<th>' +" Costo total de vale "+ '</th>'+
                        '</tr>';

                $.each(data, function (i, d) {
                    cont++;
                    tbody += '<tr>'+
                            '<td>' + cont + '</td>'+
                            '<td>' + (d.fechaCreacion).split("-").reverse().join("/")+ '</td>'+
                            '<td>' + d.numeroVale + '</td>'+
                            '<td>' + d.nombreUnidad + '</td>'+
                            '<td> $ ' + new Intl.NumberFormat("en-IN", { minimumFractionDigits:2 }).format( d.costoUnitarioVale)+ '</td>'+
                            '</tr>';
                });
                callback($("<table class='table' style='width:90%;'>" + thead + tbody + '</table>')).show();
            },
            error: function () {
                $('#output').html('Bummer: there was an error!');
            }
        });
    }

    $( function()
    {
        $( '#generar' ).on('click', function () {
            var fechaI = $("#fechaI").val();
            var fechaF = $("#fechaF").val();

            if (valida(fechaI,fechaF)==true){
               generar(fechaI,fechaF);
            }
        });

        function valida(fechaI,fechaF) {

            if (fechaI!=""){
                if (fechaF!=""){
                    document.getElementById("texto").innerHTML="";
                   if (compare_dates(fechaF, fechaI)) {
                       return true;
                   }else{
                       document.getElementById("texto").innerHTML="Fecha fin debe ser mayor que fecha inicio";
                   }
                } else{
                    document.getElementById("texto").innerHTML="Seleccione una fecha fin";
                }
            } else{
                document.getElementById("texto").innerHTML="Seleccione una fecha inicial";
            }

            return false;

        }

        function compare_dates(fechaF, fechaI)
        {
            fechaF= (fechaF).split("-").reverse().join("-");
            fechaI= (fechaI).split("-").reverse().join("-");

            var xMonth=fechaF.substring(3, 5);
            var xDay=fechaF.substring(0, 2);
            var xYear=fechaF.substring(6,10);
            var yMonth=fechaI.substring(3, 5);
            var yDay=fechaI.substring(0, 2);
            var yYear=fechaI.substring(6,10);
            if (xYear> yYear)
            {
                return(true)
            }
            else
            {
                if (xYear == yYear)
                {
                    if (xMonth> yMonth)
                    {
                        return(true)
                    }
                    else
                    {
                        if (xMonth == yMonth)
                        {
                            if (xDay> yDay)
                                return(true);
                            else
                                if (xDay == yDay)
                                    return(true);
                                else
                                return(false);
                        }
                        else
                            return(false);
                    }
                }
                else
                    return(false);
            }
        }
    });

    function generar(fechaI,fechaF) {
         var newUrl;
            newUrl = "{{route('liquidacion.reporteG', ['fechaI' => ':fechaI', 'fechaF' => ':fechaF'])}}";
            newUrl = newUrl.replace(':fechaI', fechaI);
            newUrl = newUrl.replace(':fechaF', fechaF);
            window.open(newUrl , '_blank');
    }
</script>
@endsection
