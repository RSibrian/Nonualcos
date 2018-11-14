@extends ('plantilla')
@section('plantilla')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="ocre">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Cargos de la Unidad: <b>{{$unidad->nombreUnidad}}</b></h4>
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="material-datatables">

                            <a href="{{ url("cargos/create") }}" class="btn  btn-azul btn-round ">
                                <i class="material-icons">add</i>
                                Nuevo
                            </a>
                    
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Codigo</th>
                                <th>Unidad</th>
                                <th>Nombre  del Cargo</th>
                                <th></th>
                                <th></th>
                                <th class="disabled-sorting text-center" >Acciones</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Codigo</th>
                                <th>Unidad</th>
                                <th>Nombre del cargo</th>
                                <th></th>
                                <th></th>
                                <th class="text-right" >Acciones&nbsp;del&nbsp;Cargo</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php $cont=0;?>
                            @foreach ($unidad->cargos as $cargo)

                                <tr>
                                    <td></td>
                                    <?php $cont++;?>
                                    <td>{{$cont}}</td>
                                    <td>{{$cargo->unidad->codigoUnidad}}</td>
                                    <td>{{$cargo->unidad->nombreUnidad}}</td>
                                    <td>{{$cargo->nombreCargo}}</td>
                                    <td>
                                        @can('proveedores.edit')
                                            <a href="{{ url("cargos/{$cargo->id}/edit") }}" class="btn btn-xs btn-verde btn-round ">
                                                <i class="material-icons">
                                                    create
                                                </i>&nbsp;
                                                Editar
                                            </a>
                                        @endcan
                                    </td>
                                    <td >
                                        @can('users.asignarrole')
                                            <a href="{{ url("cargos/{$cargo->id}") }}" class="btn btn-xs btn-ocre btn-round">
                                                <i class="material-icons">face</i>
                                                Personal
                                            </a>
                                        @endcan
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ url("cargos/{$cargo->id}") }}" class="btn btn-xs btn-azul btn-round">
                                            <i class="material-icons">visibility</i>&nbsp;
                                            Mostrar
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
