@extends ('plantilla')
@section('plantilla')
<style>
    /* Hidding the radiobuttons &amp; checkboxes */
    input[type="radio"], input[type="checkbox"] {
        display: none;
    }
    /* Styling background */
    label i:first-child {
        color: gray;
    }
    /* Hidding the "check" status of inputs */
    input[type="radio"] + label .fa-circle,
    input[type="checkbox"] + label .fa-check  {
        display: none;
    }
    /* Styling the "check" status */
    input[type="radio"]:checked + label .fa-circle,
    input[type="checkbox"]:checked + label .fa-check {
        display: block;
        color: DarkTurquoise;
    }
    /* Styling checkboxes */
    input[type="checkbox"]:checked + label .fa-check {
        position: relative;
        left: .125em;
        bottom: .125em;
    }
    /* Styling radiobuttons */
    input[type="radio"]:checked + label .fa-circle-o {
        display: none;
    }
</style>
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
        <h4 class="card-title">Pasivo Laboral (indemnizaciones)</h4>
        <div class="toolbar">
          <!--        Here you can write extra buttons/actions for the toolbar              -->
        </div>
        <div class="material-datatables">

          {!! Form::open(['route'=>'indemnizaciones.make','method'=>'POST','autocomplete'=>'off']) !!}

          <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" >
            <thead>
              <tr>
                <th></th>
                <th>#</th>
                <th>Empleado</th>
                <th>Fecha de Ingreso</th>
                <th>Salario</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>#</th>
                <th>Empleado</th>
                <th>Fecha de Ingreso</th>
                <th>Salario</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($empleados as $empleado)
              <tr>
                <td><div class="checkbox" style="display: inline">
                    <label>
                      {{ Form::checkbox('empleadosId[]',$empleado->id,null,[ 'id'=>"check{$empleado->id}"]) }}
                    </label>
                </div></td>
                <td>{{$loop->iteration}}</td>
                <td>{{$empleado->fullName}}</td>
                <td>{{Helper::fecha($empleado->fechaIngreso)}}</td>
                <td>$ {{Helper::dinero($empleado->salarioBruto)}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div align="center" class="row">
            <?php $fechaFin=Carbon\Carbon::now()->endOfMonth(); ?>
            <div class="form-group">
       <label class="col-lg-2" style="color: black;">Fecha de corte: </label>
       <div class="col-lg-3">
         {!!Form::date('fechaFin',$fechaFin,['id'=>'fechaFin','class'=>'form-control datepicker'])!!}
       </div>
       <label class="col-lg-2" style="color: black;">Motivo: </label>
       <div class="col-lg-3">
         <select class="form-control" name="motivo" id="motivo">
           <option value="Despido">Despido</option>
           <option value="Renuncia Voluntaria">Renuncia Voluntaria</option>
         </select>
       </div>
     </div>
        </div>


          <div align="center" class="row">
          {!! Form::submit('Mostrar',['id'=>"mostrar_indemnizacion", "onclick"=>"myFunction()" ,'class'=>'btn btn-verde']) !!}
          </div>
      {!! Form::close() !!}

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
$ayuda_title="Ayuda para la Tabla de Pasivo Laboral";
$ayuda_body="La tabla muestra los empleados activos. <br>
1- Para calcular la indemnización aproximada del empleado seleccionelo en la lista,<br>
2- Luego seleccione la fecha supuesta de terminación y el motivo,<br>
3- Presione el botón mostrar"
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

function myFunction() {
    table=$('#datatables').DataTable();
    table.destroy();
    table= $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
            [-1],
            ["Todos"]
        ],
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records",
        }

    });
}
</script>
@endsection
