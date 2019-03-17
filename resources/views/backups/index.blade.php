@extends ('plantilla')
@section('plantilla')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="ocre">
                    <i class="material-icons">assignment</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Listado Backups</h4>
                    <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>

                    <div class="material-datatables">
                      @can('auditoria.index')
                            <a href="{{ url('backups/create') }}" class="btn  btn-success btn-round ">
                                <i class="material-icons">add</i>
                                Nuevo
                            </a>
                      @endcan
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                  <th>Archivo</th>
                                  <th>Kilobytes</th>
                                  <th>Fecha</th>
                                    <th class="disabled-sorting text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                  <th>Archivo</th>
                                  <th>Kilobytes</th>
                                  <th>Fecha</th>
                                  <th class="text-right">Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody>
                              @if(count($backups)>0)
                                 <?php $cont=0;?>
                                 @foreach($backups as $backup)
                                       <tr>
                                           <td>{{ $backup['file_name'] }}</td>
                                           <td>{{ $backup['file_size'] }}</td>
                                           <td>{{ $backup['last_modified'] }}</td>
                                           <td class="text-right">
                               <a class="btn btn-xs btn-default"
                                  href="{{ url('backups/download/'.$backup['file_name']) }}"><i
                                       class="fa fa-cloud-download"></i> Descargar</a>
                               <a class="btn btn-xs btn-danger" data-button-type="delete"
                                  href="{{ url('backups/delete/'.$backup['file_name']) }}"><i class="fa fa-trash-o"></i>
                                   Borrar</a>
</td>
                                       </tr>
                                @endforeach
                              @else
                                <p>No Datos de Backups</p>
                              @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
        <!-- Button to Open the Modal -->



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
