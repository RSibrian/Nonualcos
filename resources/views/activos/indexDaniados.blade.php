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
                  <h4 class="card-title">Listado Activos Dañados</h4>
                  <div class="toolbar">
                  <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">

                      <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                          <thead>
                              <tr>
                                  <th></th>
                                  <th>#</th>
                                  <th>Codigo</th>
                                  <th>Nombre</th>

                                  <th>Precio</th>
                                  <th>Unidad</th>
                                  <th>Persona Encargada</th>
                                  
                                  <th class="disabled-sorting text-right">Acciones</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                <th></th>
                                <th>#</th>
                                <th>Codigo</th>
                                <th>Nombre</th>

                                <th>Precio</th>
                                <th>Unidad</th>
                                <th>Persona Encargada</th>

                                  <th class="text-right">Todas&nbsp;Acciones&nbsp;de&nbsp;Activo</th>
                              </tr>
                          </tfoot>
                          <tbody>
                               <?php $cont=0;?>
                              @foreach ($activos as $activo)
                                  <tr>
                                      <td></td>
                                      <?php $cont++;?>
                                      <td>{{$cont}}</td>
                                      @if($activo->codigoInventario!=null)
                                      <td>{{$activo->codigoInventario}}</td>
                                    @else
                                      <td align='center'>{{'------'}}</td>
                                    @endif
                                      <td>{{$activo->nombreActivo}}</td>

                                        <td>${{number_format($activo->precio, 2, '.', ',')}}</td>
                                      @if($activo->codigoInventario!=null)
                                      <?php
                                          $traslado=$activo->activosUnidades->last();
                                      ?>
                                      <td>{{$traslado->unidad->nombreUnidad}}</td>
                                      <td>{{$traslado->empleado->nombresEmpleado}}</td>
                                    @else
                                    <td>{{'No asignado'}}</td>
                                    <td>{{'No asignado'}}</td>

                                  @endif

                                      <td class="text-right">
                                          @can('proveedores.edit')
                                          <a title="Dar Mantenimiento" href="{{ url("mantenimientos/create/{$activo->id}") }}" rel="tooltip" class="btn btn-xs btn-info btn-round">
                                              <i class="material-icons">
                                                  build
                                              </i>&nbsp;
                                          </a>
                                          @endcan

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
      $ayuda_title="Ayuda para la Tabla de Activo Fijo";
      $ayuda_body="Cada Activo tiene 3 botones <br>
                   1- Este <i class='material-icons'>create</i>&nbsp; Icono es para editar el Activo      <br><br>
                   2- Este <i class='material-icons'>dvr</i> Icono es para ver las asignaciones del Activo a Unidades y Empleados <br><br>
                   3- Este <i class='material-icons'>visibility</i> Icono es para ver los datos del Activo"
  ?>
  @include('alertas.ayuda')


  <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="desactivado">
            {!!Form::open()!!}
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                            <input type="hidden" name="modal_id_activo" id="modal_id_activo">
                            <input type="hidden" id='token' name="_token" value="{{ csrf_token() }}">

                        </button>

                        <h3>Desactivar Activo: <span class="violet"></span></h3>
                    </div>

                    <div class="modal-body">

                      <div class="col-sm-12 row">
                          <div class="input-group">
                              <span class="input-group-addon">
                                  <i class="material-icons">note_add</i>
                              </span>
                              <div class="form-group label-floating">
                                  <label class="control-label">Justificación:
                                  </label>
                                  {!!Form::text('ObservacionActivo',null,['id'=>'justificacion','class'=>'form-control'])!!}
                              </div>
                          </div>
                      </div>

                    <div class="col-sm-12 row">
                        <h5>¿Seguro que desea Desactivar el activo?</h5>
                    </div>
                    </div>

                    <div class="modal-footer">
                        <div class="row col-md-12">
                            <div class="col-md-8" align="left">
                                <h6>* Se cambiará el estado del activo a desactivado</h6>
                            </div>
                            <div class="col-md-2">
                              {!! link_to('#desactivado',$title='Aceptar',$attributes=['id'=>'btn_desactivado','class'=>'btn btn-sm btn-success btn-block glyphicon '],$secure=null)!!}



                            </div>
                            <div class="col-md-2">
                              {!! link_to('#',$title='Cancelar',$attributes=['data-dismiss'=>'modal','class'=>'btn btn-sm btn-ocre btn-block glyphicon '],$secure=null)!!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{Form::Close()}}
        </div>


@stop
@section('scripts')
<script type="text/javascript">
function activoDesactivado(activo_id)
{
  //console.log(activo_id);
  $("#modal_id_activo").val(activo_id);
  $('#desactivado').modal('show');
}

$('#btn_desactivado').click(function(){
  var activo=$('#modal_id_activo').val();
    var justificacion=$('#justificacion').val();
  var route='/Nonualcos/public/activos/baja/'+activo;
  var token=$('#token').val();
  $.ajax({
    url:route,
    headers:{'X-CSRF-TOKEN':token},
    dataType:'json',
    type:'PUT',
    data:{justificacion},
    success:function(res){
      $('#desactivado').modal('hide');
      $('#btn_'+activo).removeClass('btn-success')
      $('#btn_'+activo).toggleClass("btn-ocre");
      $('#btn_'+activo).removeAttr('onclick');
      $('#btn_'+activo).text("Desactivado");
      location.reload();

  },
  /*  error:function(res){
      alert("art");
    }*/


  });


});

</script>

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
