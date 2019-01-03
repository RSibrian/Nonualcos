@extends ('plantilla')
@section('plantilla')
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
                                <td>{{ $liquidacion->fechaLiquidacion }}</td>
                                <td>{{ $liquidacion->numeroFacturaLiquidacion }}</td>
                                      <?php $vehiculo= $liquidacion->vale;?>
                                      @foreach($vehiculo as $ve)
                                          <?php $placa=$ve->salida->vehiculo?>
                                      @endforeach
                                 <td>{{ $placa->numeroPlaca}}</td>
                                <td>{{ "$ ".$liquidacion->montoFacturaLiquidacion }}</td>
                                <td class="text-right">
                                  @can('vales.edit')
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
    $ayuda_body="Cada Activo tiene 3 botones <br>

                   1- Este <i class='material-icons'>visibility</i> Icono es para ver los datos del Activo"
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
        $.ajax({
            url:'/liquidaciones/'+val+'/vales',
            dataType: "json",
            complete: function (response) {
                var data = JSON.parse(response.responseText);
                var cont=0;
                var thead = '',  tbody = '';
                thead = '<tr>'+
                        '<th>' +" # "+ '</th>'+
                        '<th>' +" Fecha "+ '</th>'+
                        '<th>' +" Número de vale "+ '</th>'+
                        //'<th>' +" Solicitante "+ '</th>'+
                        '<th>' +" Costo total de vale "+ '</th>'+
                        '</tr>';

                $.each(data, function (i, d) {
                    cont++;
                    tbody += '<tr>'+
                            '<td>' + cont + '</td>'+
                            '<td>' + d.fechaCreacion + '</td>'+
                            '<td>' + d.numeroVale + '</td>'+
                           // '<td>' + d.nombresEmpleado+' '+d.apellidosEmpleado + '</td>'+
                            '<td>' + d.costoUnitarioVale+ '</td>'+
                            '</tr>';
                });
                callback($("<table class='table' style='width:90%;'>" + thead + tbody + '</table>')).show();
            },
            error: function () {
                $('#output').html('Bummer: there was an error!');
            }
        });
    }
</script>
@endsection
