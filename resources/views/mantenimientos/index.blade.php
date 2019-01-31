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
        <h4 class="card-title">Listado Mantenimientos de Activos</h4>
        <div class="toolbar">
          <!--        Here you can write extra buttons/actions for the toolbar              -->
        </div>
        <div class="material-datatables">
          <!-- @can('unidads.create') -->
          <a href="{{ url("mantenimientos/create") }}" class="btn  btn-verde btn-round ">
            <i class="material-icons">add</i>
            Nuevo

          </a>
          <a  aling='right' href="{{ route('mantenimientos.generarReporte') }}" class="btn  btn-ocre btn-round ">
              <i class="material-icons">print</i>
            </a>
          <!-- @endcan -->
          <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
            <thead>
              <tr>
                <th></th>
                <th>#</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Fecha en taller</th>
                <th>Empresa encargada</th>
                <th>Fecha de recepción</th>
                <th class="disabled-sorting text-right">Acciones</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>#</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Fecha en taller</th>
                <th>Empresa encargada</th>
                <th>Fecha de retorno</th>
                <th class="text-right">Acciones</th>
              </tr>
            </tfoot>
            <tbody>
              <?php $cont=0;?>
              @foreach ($mantenimientos as $mantenimiento)
              <tr>
                <td></td>
                <?php $cont++;
                ?>
                <td>{{$cont}}</td>
                <td>{{$mantenimiento->Activos->codigoInventario?:"------------------"}}</td>
                <td>{{$mantenimiento->Activos->nombreActivo}}</td>
                 <td>{{\Helper::fecha($mantenimiento->fechaRecepcionTaller) }}</td>
                 <td>{{$mantenimiento->proveedores->nombreEmpresa}}</td>
                 <?php if (isset($mantenimiento->fechaRetornoTaller)): ?>
                   <td>{{\Helper::fecha($mantenimiento->fechaRetornoTaller)}}</td>
                   <?php else: ?>
                   <td>{{"en proceso"}}</td>
                 <?php endif; ?>
                <td class="text-right">
                  <!-- @can('proveedores.edit') -->
                  <a title="Editar mantenimiento" href="{{ url("mantenimientos/{$mantenimiento->id}/edit") }}" rel="tooltip" class="btn btn-xs btn-info btn-round">
                    <i class="material-icons">
                      create
                    </i>
                  </a>
                  <!-- @endcan -->
                  <a title="Ver Mantenimiento" href="{{ url("mantenimientos/{$mantenimiento->id}") }}" class="btn btn-xs btn-info btn-round">
                    <i class="material-icons">visibility</i>
                  </a>
                  <a target="_blank" title="imprimir solicitud" href="{{ url("mantenimientos/generarSolicitud/{$mantenimiento->id}") }}" class="btn  btn-info btn-round btn-xs">
              <i class="material-icons">print</i>
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
$ayuda_title="Ayuda para la Tabla de Mantenimiento de Activo Fijo";
$ayuda_body="Cada mantenimiento tiene 3 botones <br>
1- Este <i class='material-icons'>create</i> Icono es para editar los datos del mantenimiento  <br><br>
2- Este <i class='material-icons'>visibility</i> Icono es para ver el detalle del mantenimiento<br><br>
3- Este <i class='material-icons'>print</i> Icono es para imprimir la solicitud de mantenimiento"
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
