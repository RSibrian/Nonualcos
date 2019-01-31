@extends ('plantilla')
@section('plantilla')
<style>
td.details-control {
  background: url('img/details_open.png') no-repeat center center;
  cursor: pointer;
}
tr.shown td.details-control {
  background: url('img/details_close.png') no-repeat center center;
}

tr.shown {
  color: white !important;
  background: linear-gradient(60deg, #2a88bd, #195BAA);
}
</style>
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
        <h4 class="card-title">Auditoría </h4>
        <div class="toolbar">
        </div>
        <div class="material-datatables">
          <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th></th>
                <th>#</th>
                <th>Tipo</th>
                <th>Acción</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th></th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>#</th>
                <th>Tipo</th>
                <th>Acción</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th></th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($audits as $audit)
              <tr>
                <td></td>
                <td>{{$loop->iteration}}</td>
                <td>@lang('messages.'.$audit->auditable_type)</td>
                <td>@lang('messages.'.$audit->event)</td>
                <td>{{$audit->user->empleado?$audit->user->empleado->nombresEmpleado." ".$audit->user->empleado->apellidosEmpleado:$audit->user->name}}</td>
                <td>{{ $audit->created_at->format('d/m/Y') }}</td>
                <td>{{ $audit->created_at->format('h:i:s a') }}</td>
                <td>{{$audit->id}}</td>
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
3- Este <i class='material-icons'>visibility</i> Icono es para ver los datos del cargo"
?>
@include('alertas.ayuda')
@stop
@section('scripts')

<script type="text/javascript">
/* Formatting function for row details - modify as you need */
function format (rowData,callback) {
  console.log(rowData);
  var id=rowData[7];
  var newUrl = "{{ route('auditoria.details', ['id' => ':id']) }}";
  newUrl=newUrl.replace(':id',id);
  var token="{{ csrf_token() }}";
  $.ajax({
    url: newUrl,
    headers:{'X-CSRF-TOKEN':token},
    type: 'GET',
    dataType:'json',
    success: function(data){
      callback(data).show();
    },
    error:function(result){
      console.log(result);
      throw "Error ...";
    }
  });
}
    $(document).ready(function() {
        var table= $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "columnDefs": [ {
            "targets": 0,
            "data": null,
            "className":'details-control',
            "orderable":false,
            "defaultContent": ''
        },
        {
          "targets": 7,
          "visible":false,
          "orderable":false,
          "searchable": false,
        }
        ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }

        });
        $('#datatables tbody').on( 'click', 'td.details-control', function () {
          var tr = $(this).closest('tr');
          var row = table.row( tr );
          var rowData=row.data();
          if ( row.child.isShown() ) {
              // This row is already open - close it
              row.child.hide();
              tr.removeClass('shown');
          }
          else {
              // Open this row
              format(rowData,row.child);
              tr.addClass('shown');
          }
    } );
    });
</script>
@endsection
