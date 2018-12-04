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
      @if($activo->precio>=600 && $activo->codigoInventario!=null)
      <li id="li" style="float:right;"><a class="active"  href="{{ url("depreciaciones/{$activo->id}") }}">Depreciación</a></li>
      @endif
      <li id="li" style="float:right;"><a  href="{{ url("activos/mantenimientosUnidades/{$activo->id}") }}">Mantenimiento</a></li>
      <li id="li" style="float:right;" ><a href="">Préstamo</a></li>
  </ul>
  <div class="row">
    <div class="col-md-12">
      <div class="card">


        <div class="card-content">
          <h4 class="card-title" align='center'><b>Depreciación del Activo: </b>{{$activo->nombreActivo}}</h4>
          <div class="toolbar">
            <!--        Here you can write extra buttons/actions for the toolbar              -->
          </div>

          <?php
          $valorResidual=$activo->precio*$activo->valorResidual/100;
          $valorDepreciar=($activo->precio-$valorResidual);
          $cuota=$valorDepreciar/$activo->aniosVida;
          $depreAcumulada=0;
          $precio=$activo->precio;
          ?>
          <br><br>

          <table border="1">
          <tr>
            <th>Código:</th>
            <td>{{$activo->codigoInventario}}</th>
          </tr>
          <tr>
            <?php
                $traslado=$activo->activosUnidades->last();
            ?>
            <th>Unidad:</th>
            <td>{{$traslado->unidad->nombreUnidad}}</th>
          </tr>

          <tr>
            <th>Precio de Adquisición:&nbsp;&nbsp;</td>
            <td>$ {{number_format($activo->precio, 2, '.', ',')}}</td>
          </tr>

          <tr>
            <th>Porcentaje Residual:</td>
              <td>$ {{number_format($activo->valorResidual, 2, '.', ',').' %'}}</td>

          </tr>

          <tr>
            <th>Valor Residual:</td>
              <td>$ {{number_format($valorResidual, 2, '.', ',')}}</td>

          </tr>

          <tr>
            <th>Costo a Depreciar:</td>
              <td>$ {{number_format($valorDepreciar, 2, '.', ',')}}</td>

          </tr>

          <tr>
            <th>Cuota Anual:</th>
            <td>$ {{number_format($cuota, 2, '.', ',')}}</td>
            
          </tr>
          <tr>
            <?php $date = new DateTime($activo->fechaAdquisicion); ?>
            <th>Año de Adquisición:</td>
            <td>{{ $date->format('Y') }}</td>

          </tr>
          <tr>

            <th>Año de Vida Utíl:</td>
            <td>{{ $activo->aniosVida }}</td>

          </tr>


          </table>

<h4 align='center'><b>Depreciación del Anual </b></h4>

            <table id="" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
              <thead>
                <tr>
                  <b>
                  <th></th>
                  <th>Año</th>
                  <th>Valor Original</th>
                  <th>Valor Residual</th>
                  <th>Valor a Depreciar</th>
                  <th>Cuota anual de Depreciación</th>
                  <th>Depreciación acumulada</th>
                  <th>Valor en Libros</th>
                </b>
                </tr>
              </thead>


              <tbody>
                <?php $cont=0;?>
                <tr>
                  <td></td>
                  <td>{{$cont}}</td>
                  <td>$ {{number_format($activo->precio, 2, '.', ',')}}</td>

                  <td>$ {{number_format($valorResidual, 2, '.', ',')}}</td>
                  <td>$ {{number_format($valorDepreciar, 2, '.', ',')}}</td>
                  <td>$ {{number_format($cuota, 2, '.', ',')}}</td>
                  <td></td>
                  <td>$ {{number_format($activo->precio, 2, '.', ',')}}</td>
                </tr>

                @for($i=0;$i<$activo->aniosVida;$i++)
                  <?php
                    $cont++;
                    $valorDepreciar-=$cuota;
                    $depreAcumulada+=$cuota;
                    $precio-=$cuota;
                  ?>
                  <tr>
                    <td></td>
                    <td>{{$cont}}</td>
                    <td></td>
                    <td></td>
                    <td>$ {{number_format($valorDepreciar, 2, '.', ',')}}</td>
                    <td>$ {{number_format($cuota, 2, '.', ',')}}</td>
                    <td>$ {{number_format($depreAcumulada, 2, '.', ',')}}</td>
                    <td>$ {{number_format($precio, 2, '.', ',')}}</td>
                  </tr>
                @endfor

              </tbody>
            </table>

          <br>
          <h4 align="center" ><b>Depreciación Mensual</b></h4>


            <table id="" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
              <thead>
                <tr>
                  <th></th>
                  <th>Mes</th>
                  <th>Valor Original</th>
                  <th>Valor Residual</th>
                  <th>Valor a Depreciar</th>
                  <th>Cuota mensual de Depreciación</th>
                  <th>Depreciación acumulada</th>
                  <th>Valor en Libros</th>
                </tr>
              </thead>
              <tbody>
                <?php $cont=0;?>
                <tr>
                  <td></td>
                  <td>{{$cont}}</td>

                  <?php
                  $precio=$cuota;
                  $valorResidual=$precio*$activo->valorResidual/100;
                  $valorDepreciar=($precio-$valorResidual);
                  $cuota=$valorDepreciar/12;
                  $depreAcumulada=0;

                  ?>
                  <td>$ {{number_format($precio, 2, '.', ',')}}</td>
                  <td>$ {{number_format($valorResidual, 2, '.', ',')}}</td>
                  <td>$ {{number_format($valorDepreciar, 2, '.', ',')}}</td>
                  <td>$ {{number_format($cuota, 2, '.', ',')}}</td>
                  <td></td>
                  <td>$ {{number_format($precio, 2, '.', ',')}}</td>
                </tr>

                @for($i=0;$i<12;$i++)
                  <?php
                    $cont++;
                    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                    $valorDepreciar-=$cuota;
                    $depreAcumulada+=$cuota;
                    $precio-=$cuota;
                  ?>
                  <tr>
                    <td></td>
                    <td>{{$meses[$i]}}</td>
                    <td></td>
                    <td></td>
                    <td>$ {{number_format($valorDepreciar, 2, '.', ',')}}</td>
                    <td>$ {{number_format($cuota, 2, '.', ',')}}</td>
                    <td>$ {{number_format($depreAcumulada, 2, '.', ',')}}</td>
                    <td>$ {{number_format($precio, 2, '.', ',')}}</td>
                  </tr>
                @endfor

              </tbody>
            </table>

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
