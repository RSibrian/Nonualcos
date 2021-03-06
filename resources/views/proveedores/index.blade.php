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
                    <h4 class="card-title">Listado Proveedores</h4>
                    <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <div class="material-datatables">
                        @can('proveedores.create')
                            <a href="{{ url("proveedores/create") }}" class="btn  btn-verde btn-round ">
                                <i class="material-icons">add</i>
                                Nuevo
                            </a>
                        @endcan
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>Nombre Empresa</th>
                                    <th>Encargado</th>
                                    <th>Telefono</th>
                                    <th>Tipo</th>
                                    <th class="disabled-sorting text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                  <th></th>
                                  <th>#</th>
                                  <th>Nombre Empresa</th>
                                  <th>Encargado</th>
                                  <th>Telefono</th>
                                  <th>Tipo</th>
                                    <th class="text-right">Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                 <?php $cont=0;?>
                                @foreach ($prov as $pro)
                                    <tr>
                                        <?php $cont++;?>
                                        <td></td>
                                        <td>{{$cont}}</td>
                                        <td>{{$pro->nombreEmpresa}}</td>
                                        <td>{{$pro->nombreEncargado}}</td>
                                        <td>{{$pro->telefonoProve}}</td>
                                        <td>
                                          @if($pro->tipoProveedor==1){{"Solo proveedor"}} @endif
                                          @if($pro->tipoProveedor==2){{"Solo Mantenimiento"}} @endif
                                          @if($pro->tipoProveedor==3){{"proveedor y Mantenimiento"}}  @endif
                                        </td>
                                        <td class="text-right">
                                            @can('proveedores.edit')
                                                <a href="{{ url("proveedores/{$pro->id}/edit") }}"  class="btn btn-xs btn-info btn-round ">
                                                    <i title="Editar proveedor" class="material-icons">create</i>&nbsp;

                                                </a>
                                            @endcan

                                            <a href="{{ url("proveedores/{$pro->id}") }}" class="btn btn-xs btn-info btn-round">
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
        $ayuda_title="Ayuda para la Tabla de Proveedores";
        $ayuda_body="Cada Unidad tiene 2 botones <br>
                     1- Este <i class='material-icons'>create</i>&nbsp; Icono es para editar el proveedor      <br><br>
                     3- Este <i class='material-icons'>visibility</i> Icono es para ver los datos del Proveedor"
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
