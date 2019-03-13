@extends ('plantilla')
@section('plantilla')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-icon" data-background-color="ocre">
        <i class="material-icons">assignment</i>
      </div>
      
      <div class="card-content">
        <h4 class="card-title">Pasivo Laboral (indemnizaciones) </h4>
        <h4 style="text-align: center">Al <strong>{{Helper::fecha($fechaFin)}}</strong> Motivo: <strong>{{$motivo}}</strong></h4>
        <div class="material-datatables">

          <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" >
            <thead>
              <tr>
                <th></th>
                <th>#</th>
                <th>Empleado</th>
                <th>Fecha de Ingreso</th>
                <th>Salario</th>
                <th>Indemnización</th>
                <th>Tiempo Laborado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>#</th>
                <th>Empleado</th>
                <th>Fecha de Ingreso</th>
                <th>Salario</th>
                <th>Indemnización</th>
                <th>Tiempo Laborado</th>
                <th>Acciones</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($indemnizaciones as $indemnizacion)
              <tr>
                <td></td>
                <td>{{$loop->iteration}}</td>
                <td>{{$indemnizacion["empleado"]->fullName}}</td>
                <td>{{Helper::fecha($indemnizacion["empleado"]->fechaIngreso)}}</td>
                <td>$ {{Helper::dinero($indemnizacion["empleado"]->salarioBruto)}}</td>
                <td>$ {{Helper::dinero($indemnizacion["monto"])}}</td>
                <td>{{$indemnizacion["tiempo"]}}</td>
                <td class="text-right">
                  <a title="Procesar" href="{{ url('indemnizaciones/bajaEmpleado/'.$indemnizacion['empleado']->id) }}" class="btn btn-xs btn-info btn-round">
                    <i class="material-icons">edit</i>
                  </a>
                  <!-- <a target="_blank" title="imprimir solicitud" href="{{ url('') }}" class="btn  btn-info btn-round btn-xs">
                  <i class="material-icons">print</i>
                </a> -->
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          <div align="center" class="row">
          <a href="{{ route('indemnizaciones.index') }}" class='btn btn-default '>Regresar</a>
          </div>

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
