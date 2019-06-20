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
                  <h4 class="card-title">Listado Vehiculos -
                      <small class="category">Historial de salidas</small> -
                      <small class="category">Historial de mantenimientos</small>
                  </h4>

                  <div class="material-datatables">
                      <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                          <thead>
                              <tr>
                                  <th></th>
                                  <th>#</th>
                                  <th>Codigo</th>
                                  <th>Placa</th>
                                  <th>Nombre</th>
                                  <th>Adquisicion</th>
                                  <th>Precio</th>
                                  <th>Unidad</th>
                                  <th>Encargado</th>
                                  <th class="disabled-sorting text-right">Acciones</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                <th></th>
                                <th>#</th>
                                <th>Codigo</th>
                                <th>Placa</th>
                                <th>Nombre</th>
                                <th>Adquisicion</th>
                                <th>Precio</th>
                                <th>Unidad</th>
                                <th>Encargado</th>
                                  <th class="text-right">Acciones</th>
                              </tr>
                          </tfoot>
                          <tbody>
                               <?php $cont=0;?>
                              @foreach ($vehiculos as $vehiculo)
                                  <tr>
                                      <td></td>
                                      <?php $cont++;?>
                                      <td>{{$cont}}</td>
                                      @if($vehiculo->activo->codigoInventario!=null)
                                      <td>{{$vehiculo->activo->codigoInventario}}</td>
                                       @else
                                      <td align='center'>{{'------'}}</td>
                                       @endif
                                      

                                      <td>{{$vehiculo->numeroPlaca}}</td>
                                      <td>{{$vehiculo->activo->nombreActivo}}</td>
                                      <td>{{\Helper::fecha($vehiculo->activo->fechaAdquisicion)}}</td>
                                      <td>{{"$ ". \Helper::dinero($vehiculo->activo->precio)}}</td>
                                      @if($vehiculo->activo->codigoInventario!=null)
                                      <?php
                                          $traslado=$vehiculo->activo->activosUnidades->last();
                                      ?>
                                      <td>{{$traslado->unidad->nombreUnidad}}</td>
                                      <td>{{$traslado->empleado->nombresEmpleado." ".$traslado->empleado->apellidosEmpleado}}</td>
                                    @else
                                    <td>{{'No asignado'}}</td>
                                    <td>{{'No asignado'}}</td>
                                      @endif

                                      <td class="text-right">
                                          @can('activos.index')
                                              <a title="Reporte Mantenimiento" href="{{ route('HiVe.index', $vehiculo->id ) }}" rel="tooltip" class="btn btn-xs btn-info btn-round">
                                                  <i class='material-icons' rel='tooltip'>build</i>
                                              </a>
                                          @endcan
                                          @can('vales.index')
                                          <a title="Ver salidas" href="{{ route('salidas', $vehiculo->id ) }}" rel="tooltip" class="btn btn-xs btn-info btn-round">
                                              <i class='material-icons' rel='tooltip'>departure_board</i>
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
      $ayuda_title="Ayuda para la Tabla de Vehiculos";
      $ayuda_body="Cada Vehiculo tiene un boton <br>
                   1- Este <i class='material-icons'>create</i>&nbsp; Icono es para editar el Activo "

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
