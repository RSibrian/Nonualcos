@extends ('plantilla')
@section('plantilla')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="ocre">
                    <i class="material-icons">work</i>
                </div>
                <div class="card-header card-header-icon" data-background-color="azul" data-toggle="modal" data-target="#myModal">
                    <i class="material-icons">help</i>

                </div>
                <div class="card-content">
                    <h4 class="card-title">Listado de Clasificaciones de Activos</h4>
                    <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="material-datatables">

                            <a href="{{ url("clasificaciones/create") }}" class="btn  btn-verde btn-round ">
                                <i class="material-icons">add</i>
                                Nuevo
                            </a>

                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>

                                    <th>#</th>
                                    <th>Codigo de Clasificacion</th>
                                    <th>Nombre de clasificacion</th>

                                    <th class="disabled-sorting " >Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>

                                    <th>#</th>
                                    <th>Codigo de Clasificacion</th>
                                    <th>Nombre de clasificacion</th>

                                    <th class="disabled-sorting " >Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                 <?php $cont=0;?>
                                @foreach ($tipos as $tipo)

                                    <tr>

                                        <?php $cont++;?>
                                        <td>{{$cont}}</td>
                                        <td>{{$tipo->codigoTipo}}</td>
                                        <td>{{$tipo->nombreTipo}}</td>

                                        <td>
                                            @can('proveedores.edit')
                                            <a title="Editar Clasificacion" href="{{ url("clasificaciones/{$tipo->id}/edit") }}" class="btn btn-xs btn-info btn-round ">
                                                <i class="material-icons">create</i>
                                            </a>
                                            @endcan
                                          <!--  <a title="Ver Activos" href="{{ url("clasificaciones/{$tipo->id}") }}" class="btn btn-xs btn-info btn-round">
                                                     <i class="material-icons">face</i></a>-->

                                                <a title="Ver clasificacion" href="{{ url("clasificaciones/{$tipo->id}") }}" class="btn btn-xs btn-info btn-round">
                                                    <i class="material-icons">visibility</i>
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
        $ayuda_title="Ayuda para la Tabla de Clasificaciones";
        $ayuda_body="Cada Clasificacion tiene 3 botones <br>
                     1- Este <i class='material-icons'>create</i>&nbsp; Icono es para editar el clasificacion      <br><br>
                     2- Este <i class='material-icons'>face</i> Icono es para ver los activos asignados a la Clasificacion <br><br>
                     3- Este <i class='material-icons'>visibility</i> Icono es para ver los datos de la clasificacion"
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
