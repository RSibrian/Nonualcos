@extends ('plantilla')
@section('plantilla')
  <style>
      #texto {
          margin:0;
          padding:0;
          color: #195BAA;
      }
      #ul {
          list-style-type: none;
          margin: 0;
          padding: 0;
          overflow: hidden;
          background-color: #333;
      }

      #li {
          float: left;
      }

      #li a {
          display: block;
          color: white;
          text-align: center;
          padding: 14px 16px;
          text-decoration: none;
      }

      #li a:hover:not(.active) {
          background-color: #111;
      }

      .active {
          background-color: #195BAA;
      }
  </style>
  <ul id="ul">
      <li id="li"><a  href="{{ url("activos/{$activo->id}") }}">Datos Activo</a></li>
      @if($activo->codigoInventario!=null)
      <li id="li"  ><a href="{{ url("activosUnidades/{$activo->id}") }}">Traslado</a></li>
      @else
      <li id="li"  ><a href="{{ url("activosUnidades/{$activo->id}") }}">Asignar</a></li>
    @endif
      <li id="li" style="float:right;"><a href="">Depreciación</a></li>
      <li id="li" style="float:right;"><a class="active" href="{{ url("activos/mantenimientosUnidades/{$activo->id}") }}">Mantenimiento</a></li>
      <li id="li" style="float:right;" ><a href="">Préstamo</a></li>
  </ul>
  <div class="row">
    <div class="col-md-12">
      <div class="card">


        <div class="card-content">
          <h4 class="card-title" align='center'>Listado Mantenimientos del Activo :{{$activo->nombreActivo}}</h4>
          <div class="toolbar">
            <!--        Here you can write extra buttons/actions for the toolbar              -->
          </div>
          <div class="material-datatables">
            <!-- @can('unidads.create') -->
            <a href="{{ url("mantenimientos/create/{$activo->id}") }}" class="btn  btn-verde btn-round ">
              <i class="material-icons">add</i>
              Nuevo

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
                  <th>Fecha de recepción</th>
                  <th>Personal que Recibe</th>
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
                  <th>Fecha de retorno</th>
                  <th>Personal que entrega</th>
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
                   <td>{{$mantenimiento->fechaRecepcionTaller->format('d/m/Y') }}</td>
                  <td>{{$mantenimiento->fechaRetornoTaller->format('d/m/Y')}}</td>
                  <td>{{$mantenimiento->Empleado1->nombresEmpleado.' '.$mantenimiento->Empleado1->apellidosEmpleado}}</td>
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
