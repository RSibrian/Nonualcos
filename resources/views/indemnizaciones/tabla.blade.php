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
        <input type="hidden" id="fechaDes" value="{{Helper::fecha($fechaFin)}}">
        <input type="hidden" id="motivoDes" value="{{$motivo}}">

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
                <th>Acciones</th>
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
                <th>Acciones</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($indemnizaciones as $indemnizacion)
              <tr>
                <td></td>
                <td>{{$indemnizacion['empleado']->id}}</td>
                <td>{{$indemnizacion["empleado"]->fullName}}</td>
                <td>{{Helper::fecha($indemnizacion["empleado"]->fechaIngreso)}}</td>
                <td>$ {{Helper::dinero($indemnizacion["empleado"]->salarioBruto)}}</td>
                <td>$ {{Helper::dinero($indemnizacion["monto"])}}</td>
                <td>{{$indemnizacion["tiempo"]}}</td>
                <td class="text-right">
                  <button title="Procesar" id="procesar"  class="btn btn-xs btn-info btn-round">
                    <i class="material-icons">archive</i>
                  </button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          <div align="center" class="row">
          <a href="{{ route('indemnizaciones.index') }}" class='btn btn-ocre '>Regresar</a>
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
<!-- The Modal -->
<div class="modal" id="modal1">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title1" align="center">Desactivar Empleado</h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body1" align="center">
              <div style="font-size: 24px; color: brown; "> ¿De verdad desea desactivar este empleado?</div>
              <i class="material-icons" style="font-size:90px; color: #962b2be8;">warning</i>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-verde " id="desacc" data-dismiss="modal">Desactivar</button>
                <button type="button" class="btn btn-ocre" data-dismiss="modal">Cancelar</button>
            </div>

        </div>
    </div>
</div>

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
  $("#datatables tbody").on('click','tr',function() {
    datos = table.row( this ).data();
  //console.log( table.row( this ).data() );
  /* href="{{ url('indemnizaciones/bajaEmpleado/'.$indemnizacion['empleado']->id) }}"
  var idEmpleado=$("#empleado").val();
    var newUrl = "{{ route('indemnizaciones.darDeBaja') }}";
      var token="{{ csrf_token() }}";
      
      $.ajax({
        url:newUrl,
        headers:{'X-CSRF-TOKEN':token},
        dataType:'json',
        type:'POST',
        data:{idEmpleado},
        success:function(res){
          console.log(res);
          if (res=="true") {
            location.href="/";
          }
        },
        error:function(res){
        }
      });   */
  
});
 var datos= new Array();
$("#procesar").click(function(){
  datos = [];
 $(this).parents("tr").find("td").each(function(key, value){
   datos.push($(this).html());
 });
 datos.splice(0,1);
 datos.splice(6,1);
datos.push($('#fechaDes').val());
datos.push($('#motivoDes').val());
 console.log(datos);

      var newUrl = "{{ route('indemnizaciones.procesar') }}";
      var token="{{ csrf_token() }}";
      
      $.ajax({
        url:newUrl,
        headers:{'X-CSRF-TOKEN':token},
        dataType:'json',
        type:'POST',
        data:{datos},
        success:function(res){
          console.log(res);
          if (res=="true") {
            location.href="{{url('indemnizaciones/bajaEmpleado/'.$indemnizacion['empleado']->id)}}";
          }
        },
        error:function(res){
        }
      });
});

});
</script>
@endsection
