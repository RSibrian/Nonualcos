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
                    <h4 class="card-title">Listado Usuarios</h4>
                    <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="material-datatables">
                        @can('users.create')
                            <a href="{{ url("users/create") }}" class="btn btn-verde btn-round " title="Agregar usuario">
                                <i class="material-icons">add</i>
                                Nuevo

                            </a>
                        @endcan
                            <a  aling='right' target="_blank" href="{{ url("users/reporte") }}" class="btn  btn-ocre btn-round " title="imprimir reporte de usuarios">
                                <i class="material-icons">save_alt</i>

                            </a>

                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Empleado</th>
                                    <th>Correo</th>
                                    <th class="disabled-sorting text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Empleado</th>
                                    <th>Correo</th>
                                    <th class="text-right">Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                 <?php $cont=0;?>
                                @foreach ($user as $u)
                                    <tr>
                                        <?php $cont++;?>
                                        <td></td>
                                        <td>{{$cont}}</td>
                                        <td>{{$u->name}}</td>
                                            <td>{{$u->idEmpleado? $u->empleado->nombresEmpleado.' '.$u->empleado->apellidosEmpleado : "No consignado"}}</td>
                                        <td>{{$u->email}}</td>
                                        <td class="text-right">
                                            @can('users.edit')
                                                <a title="Editar Usuario"href="{{ url("users/{$u->id}/edit") }}"  class="btn btn-xs btn-info btn-round ">
                                                    <i title="Editar Usuario" class="material-icons">create</i>&nbsp;

                                                </a>
                                            @endcan
                                            @can('users.asignarrole')
                                                <a title="Asignar Rol"  href="{{ url("users/{$u->id}/asignarrole") }}" class="btn btn-xs btn-info btn-round">
                                                    <i class="material-icons">lock_outline</i>&nbsp;

                                                </a>
                                            @endcan
                                            <a title="Mostrar" href="{{ url("users/{$u->id}") }}" class="btn btn-xs btn-info btn-round">
                                                <i title="Mostrar" class="material-icons">visibility</i>
                                                &nbsp;
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
        $ayuda_title="Ayuda para la Tabla de Usuarios";
        $ayuda_body="Cada Usuario tiene 3 botones <br>
                     1- Este <i class='material-icons'>create</i>&nbsp; Icono es para editar el Usuario      <br><br>
                     2- Este <i class='material-icons'>lock_outline</i> Icono es para asignar rol al usuario <br><br>
                     3- Este <i class='material-icons'>visibility</i> Icono es para ver los datos del Usuario"
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
