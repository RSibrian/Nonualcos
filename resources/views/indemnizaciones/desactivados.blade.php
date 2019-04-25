@extends ('plantilla')
@section('plantilla')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-icon" data-background-color="ocre">
        <i class="material-icons">assignment</i>
      </div>
      
      <div class="card-content">
        <h4 class="card-title">Empleados desactivados / indemnizaciones</h4>
        <div class="material-datatables">

          <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" >
            <thead>
              <tr>
                <th></th>
                <th>ID</th>
                <th>Empleado</th>
                <th>Fecha de Ingreso</th>
                <th>Salario</th>
                <th>Indemnización</th>
                <th>Tiempo Laborado</th>
                <th>Fecha de finalización</th>
                <th>Motivo</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
              <th></th>
                <th>ID</th>
                <th>Empleado</th>
                <th>Fecha de Ingreso</th>
                <th>Salario</th>
                <th>Indemnización</th>
                <th>Tiempo Laborado</th>
                <th>Fecha de finalización</th>
                <th>Motivo</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($indemnizaciones as $indemnizacion)
              <tr>
                <td></td>
                <td>{{$indemnizacion->empleado->id}}</td>
                <td>{{$indemnizacion->empleado->fullName}}</td>
                <td>{{Helper::fecha($indemnizacion->empleado->fechaIngreso)}}</td>
                <td>$ {{Helper::dinero($indemnizacion->empleado->salarioBruto)}}</td>
                <td>$ {{Helper::dinero($indemnizacion->montoInd)}}</td>
                <td>{{$indemnizacion->motivoInd}}</td>
                <td>{{Helper::fecha($indemnizacion->fechaFinalización)}}</td>
                <td>{{$indemnizacion->tipoInd}}</td>
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
$ayuda_title="Ayuda para indemnizaciones";
$ayuda_body=""
?>
@include('alertas.ayuda')
@stop
@section('scripts')

<script type="text/javascript">
$(document).ready(function() {

  var table= $('#datatables').DataTable({
    "pagingType": "full_numbers",
    "lengthMenu": [
      [10, 25, 50, -1],
      [10, 25, 50, "All"]
    ],
    responsive: true,
    language: {
      search: "_INPUT_",
      searchPlaceholder: "Search records",
    },
  });


});
</script>
@endsection
