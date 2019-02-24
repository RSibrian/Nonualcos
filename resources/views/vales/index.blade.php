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
                    <h4 class="card-title">Gestión de Vales</h4>
                    <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="material-datatables">
                        @can('vales.create')
                            <a href="{{ route('vales.create') }}" class="btn  btn-verde btn-round ">
                                <i class="material-icons">add</i>
                                Nuevo
                            </a>
                        @endcan

                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Unidad</th>
                                    <th>Solicitante</th>
                                    <th>Galones</th>
                                    <th>Costo total vale</th>
                                    <th>Entrega</th>
                                    <th>Devolución</th>
                                    <th class="disabled-sorting text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Unidad</th>
                                    <th>Solicitante</th>
                                    <th>Galones</th>
                                    <th>Costo total vale</th>
                                    <th>Entrega</th>
                                    <th>Devolución</th>
                                    <th class="text-right">Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody class="text-center">
                            <?php $cont=0;?>
                            <?php //echo dd($_vales) ?>
                             @foreach($_vales as $vale)
                              <tr>
                                  <td></td>
                                  <?php $cont++;?>
                                <td>{{ $cont }}</td>
                                <td>
                                  <p>{{ date('d-m-Y', strtotime($vale->fechaCreacion)) }}</p>
                                </td>
                                  <td>
                                      <?php $unidad=$vale->salida->empleados->cargo->unidad; ?>
                                      <p>
                                          {{ $unidad->nombreUnidad }}
                                      </p>
                                  </td>
                                <td>
                                    <?php $nombre=$vale->salida->empleados; ?>
                                  <p>
                                       {{ $nombre->nombresEmpleado.' '.$nombre->apellidosEmpleado }}
                                  </p>
                                </td>
                                  <td>
                                      <p>
                                          @if ( $vale->galones==null)
                                              {{ 'No especificado' }}
                                          @else
                                              {{ $vale->galones }}
                                          @endif
                                      </p>
                                  </td>
                                  <td>
                                      <p>
                                          @if ( $vale->costoUnitarioVale==null)
                                              {{ 'No especificado' }}
                                          @else
                                              {{ '$ '.$vale->costoUnitarioVale }}
                                          @endif

                                      </p>
                                  </td>
                                <td>
                                    {{ $vale->estadoEntregadoVal?'Si':'No'
                                    }}
                                </td>
                                <td>
                                    {{ $vale->estadoRecibidoVal?'Si':'No'
                                    }}
                                </td>
                                <td class="text-right">
                                  @can('users.edit')
                                      <a href="{{ route('vales.edit', $vale->id) }}"  class="btn btn-xs btn-info btn-round ">
                                          <i title="Editar vale" class="material-icons" rel="tooltip">create</i>
                                      </a>
                                  @endcan
                                  <a href="{{ route('vales.show', $vale->id) }}" class="btn btn-xs btn-info btn-round " >
                                      <i title="Mostrar Vale" class="material-icons"  rel="tooltip">visibility</i>
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
    $ayuda_title="Ayuda para la Tabla de Vale";
    $ayuda_body="Cada Vale tiene 3 botones <br>
                   1- Este <i class='material-icons'>create</i>&nbsp; Icono es para editar el vale     <br><br>
                   2- Este <i class='material-icons'>visibility</i> Icono es para ver los datos del vale"
    ?>
    @include('alertas.ayuda')
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

        $('#table-filter').on('change', function(){
            table.search(this.value).draw();
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
