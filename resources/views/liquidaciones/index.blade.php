@extends ('plantilla')
@section('plantilla')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="ocre">
                    <i class="material-icons">assignment</i>
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
                                <td></td>
                                <td>{{ $cont }}</td>
                                <td>{{ $liquidacion->fechaLiquidacion }}</td>
                                <td>{{ $liquidacion->numeroFacturaLiquidacion }}</td>
                                      <?php $vehiculo= $liquidacion->vale;?>
                                      @foreach($vehiculo as $ve)
                                          <?php $placa=$ve->salida->vehiculo?>
                                      <td>{{ $placa->numeroPlaca}}</td>
                                      @endforeach
                                <td>{{ "$ ".$liquidacion->montoFacturaLiquidacion }}</td>
                                <td class="text-right">
                                  @can('vales.edit')
                                      <a href="{{ route('liquidaciones.edit', $liquidacion->id) }}"  class="btn btn-xs btn-info btn-round ">
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
