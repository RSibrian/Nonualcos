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
        <h4 class="card-title">Dar de Baja a Empleado </h4>
        <h4 style="text-align: center"><strong>Empleado: {{$empleado->fullName}} </strong></h4>
        <input type="hidden" id="empleado" value="{{$empleado->id}}">
        <h4 style="text-align: center">Movimientos pendientes de empleado</h4>
       
         <div class="material-datatables">

          <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" >
            <thead>
              <tr>
                <th></th>
                <th>#</th>
                <th></th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>#</th>
                <th></th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Acciones</th>
              </tr>
            </tfoot>
            <tbody>
            <?php $count=1; ?>
              @foreach ($activos as $activoU)
              <tr>
                <td></td>
                <td>{{$count }}</td>
                <?php $count++; ?>
                <td>{{$activoU->activo->codigoInventario}}</td>
                <td>{{$activoU->activo->nombreActivo}}</td>
                <td>Activos Asignados</td>
                <td class="text-right">
                  <a target="_blank" title="Mover" href="{{ url('/activosUnidades/'.$activoU->activo->id) }}" rel="tooltip" class="btn btn-xs btn-info btn-round">
                    <i class="material-icons">
                      edit
                    </i>
                  </a>
                </td>
              </tr>
              @endforeach

              @foreach ($descuentos as $desc)
              <tr>
                <td></td>
                <td>{{$count }}</td>
                <?php $count++; ?>
                <td>$ {{\Helper::dinero($desc->pago)}}</td>
                <td>{{$desc->observacion? $desc->observacion : 'descuento' }}</td>
                <td>Descuentos de empleado</td>
                <td class="text-right">
                  <a target="_blank" title="Desactivar descuento" href="{{ url('/descuentos/'.$empleado->id) }}" rel="tooltip" class="btn btn-xs btn-info btn-round">
                    <i class="material-icons">
                      edit
                    </i>
                  </a>
                </td>
              </tr>
              @endforeach

              @foreach ($vales as $vale)
              <tr>
                <td></td>
                <td>{{$count }}</td>
                <?php $count++; ?>
                <td>Vale: {{ $vale->numeroVale }}</td>
                <td>Vale</td>
                <td>Vale no devuelto</td>
                <td class="text-right">
                  <a target="_blank" title="Desactivar descuento" href="{{ url('/vales/'.$vale->id) }}" rel="tooltip" class="btn btn-xs btn-info btn-round">
                    <i class="material-icons">
                      edit
                    </i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div align="center" class="row">
              <a href="{{ route('index') }}" class='btn btn-ocre '>Cancelar</a>
              <button id="recarga" class='btn btn-azul '>Recargar tabla</button>
              @if($count<=1)
              <button id="procesar" class='btn btn-verde '>Procesar</a>
              @endif
          </div>
      
      </div> 

      </div>
    <!--  end card  -->
  </div>
  <!-- end col-md-12 -->
</div>
<!-- end row -->
<?php
$ayuda_title="Ayuda para desactivar perfil de empleado";
$ayuda_body="Debe finalizar cualquier movimiento pendiente del usuario para poder desactivarlo. <br>
Use el botón <i class='material-icons'>edit</i> para ejecutar la acción correspondiente.<br>
- Si hay registros en la tabla y ya los finalizó presione el botón 'recargar Tabla'. <br>
- Si no hay registros en la tabla presion el botón 'Procesar' para deshabilitar el empleado";
?>
@include('alertas.ayuda')
@stop
@section('scripts')

<script type="text/javascript">
$(function() {
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

  $('#recarga').click(function () {
    location.reload();
  });

  $('#procesar').click(function () {
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
      });
  });

});

</script>
@endsection
