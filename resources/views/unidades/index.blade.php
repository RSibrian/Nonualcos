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
                    <h4 class="card-title">Listado Unidades</h4>
                    <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="material-datatables">
                        @can('unidades.create')
                            <a href="{{ url("unidades/create") }}" class="btn  btn-verde btn-round ">
                                <i class="material-icons">add</i>
                                Nuevo

                            </a>
                        @endcan
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>Codigo</th>
                                    <th>Nombre  de la Unidad</th>
                                    <th class="disabled-sorting text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>Codigo</th>
                                    <th>Nombre de la Unidad</th>
                                    <th class="text-right">Acciones&nbsp;de&nbsp;la&nbsp;Unidad</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                 <?php $cont=0;?>
                                @foreach ($unidades as $unidad)
                                    <tr>
                                        <td></td>
                                        <?php $cont++;?>
                                        <td>{{$cont}}</td>
                                        <td>{{$unidad->codigoUnidad}}</td>
                                        <td>{{$unidad->nombreUnidad}}</td>
                                        <td class="text-right">
                                            @can('unidades.edit')
                                            <a title="Editar proveedor" href="{{ url("unidades/{$unidad->id}/edit") }}" rel="tooltip" class="btn btn-xs btn-info btn-round">
                                                <i class="material-icons">
                                                    create
                                                </i>&nbsp;
                                            </a>
                                          
                                                 <a title="Mostrar Cargos" href="{{ url("unidades/{$unidad->id}/cargos") }}" class="btn btn-xs btn-info btn-round">
                                                     <i class="material-icons">dvr</i>
                                                 </a>
                                            @endcan

                                                <a title="Ver Unidad" href="{{ url("unidades/{$unidad->id}") }}" class="btn btn-xs btn-info btn-round">
                                                    <i class="material-icons">visibility</i>&nbsp;
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
    <?php
        $ayuda_title="Ayuda para la Tabla de Unidades";
        $ayuda_body="Cada Unidad tiene 3 botones <br>
                     1- Este <i class='material-icons'>create</i>&nbsp; Icono es para editar la unidad      <br><br>
                     2- Este <i class='material-icons'>dvr</i> Icono es para ver los cargos de la unidad <br><br>
                     3- Este <i class='material-icons'>visibility</i> Icono es para ver los datos de la unidad"
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
