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
                    <h4 class="card-title">Cargos de la Unidad: <b>{{$unidad->nombreUnidad}}</b></h4>
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="material-datatables">
                        @can('unidads.create')
                          <a href="{{ url("cargos/create") }}" class="btn  btn-verde btn-round ">
                              <i class="material-icons">add</i>
                              Nuevo

                          </a>
                        @endcan
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                            <tr>

                                <th>#</th>
                                <th>Codigo</th>
                                <th>Unidad</th>
                                <th>Nombre  del Cargo</th>

                                <th class="disabled-sorting text-center" >Acciones</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>

                                <th>#</th>
                                <th>Codigo</th>
                                <th>Unidad</th>
                                <th>Nombre del cargo</th>

                                <th class="text-right" >Acciones&nbsp;del&nbsp;Cargo</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $cont=0;?>
                            @foreach ($unidad->cargos as $cargo)

                                <tr>

                                    <?php $cont++;?>
                                    <td>{{$cont}}</td>
                                    <td>{{$cargo->unidad->codigoUnidad}}</td>
                                    <td>{{$cargo->unidad->nombreUnidad}}</td>
                                    <td>{{$cargo->nombreCargo}}</td>
                                    <td>

                                        @can('proveedores.edit')
                                          <a title="Editar" href="{{ url("cargos/{$cargo->id}/edit") }}" rel="tooltip" class="btn btn-xs btn-info btn-round">
                                              <i class="material-icons">
                                                  create
                                              </i>&nbsp;
                                          </a>
                                          <a title="Ver cargo" href="{{ url("cargos/{$cargo->id}") }}" class="btn btn-xs btn-info btn-round">
                                              <i class="material-icons">visibility</i>
                                          </a>
                                        @endcan
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
    <?php
        $ayuda_title="Ayuda para la Tabla de Cargos";
        $ayuda_body="Cada Cargo tiene 2 botones <br>
                     1- Este <i class='material-icons'>create</i>&nbsp; Icono es para editar el cargo      <br><br>

                     2- Este <i class='material-icons'>visibility</i> Icono es para ver los datos del cargo"
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
