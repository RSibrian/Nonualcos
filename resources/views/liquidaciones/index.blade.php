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
                            <a href="{{ route('RLiquidaciones') }}" class="btn btn-xs btn-ocre btn-round" title="Reporte General">
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
                                <td>{{ "$ ". \Helper::dinero($liquidacion->montoFacturaLiquidacion) }}</td>
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

@stop
@section('scripts')
    {!!Html::script('js/liquidacionIndex.js')!!}
    <script>
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
                var newUrl = "{{ route('liquidaciones.vales', ['liquidacion' => ':liquidacion']) }}";
                newUrl = newUrl.replace(':liquidacion', val);
                tr.addClass('shown');
                format(row.child,val, newUrl);
            }
        } );
    </script>

@endsection
