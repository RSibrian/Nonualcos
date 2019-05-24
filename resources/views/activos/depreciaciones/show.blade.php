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
    @can('activos.index')
      <li id="li"><a  href="{{ url("activos/{$activo->id}") }}">Datos Activo</a></li>
    @endcan
    @can('activosUnidades.show')
      @if($activo->codigoInventario!=null)
      <li id="li"  ><a href="{{ url("activosUnidades/{$activo->id}") }}">Traslado</a></li>
      @else
      <li id="li"  ><a href="{{ url("activosUnidades/{$activo->id}") }}">Asignar</a></li>
    @endif
  @endcan
  @can('activos.index')
    @if($activo->precio>=600 )
    <li id="li" style="float:right;"><a class="active" href="{{ url("depreciaciones/{$activo->id}") }}">Depreciación</a></li>
    @endif
  @endcan
  @can('mantenimientos.index')
    @if($activo->codigoInventario!=null)
      <li id="li" style="float:right;"><a  href="{{ url("activos/mantenimientosUnidades/{$activo->id}") }}">Mantenimiento</a></li>

    @endif
  @endcan
  </ul>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-icon" data-background-color="ocre">
            <i class="material-icons">assignment</i>
        </div>

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
          $fechaBaja=$activo->fechaBajaActivo;

          $mes=date("m");
          $anno=date("Y");


          if($activo->estadoActivo==0){

            $dias_baja=date("d", strtotime($activo->fechaBajaActivo));//dia 12
            $mes_baja=date("m", strtotime($activo->fechaBajaActivo));// mes 07
            $anno_baja=date("Y", strtotime($activo->fechaBajaActivo));//2018
            $fecha_fin_mes = date($anno_baja."-".$mes_baja."-01");//2018-12-01

          }
          else{
            $fecha_fin_mes = date($anno."-".$mes."-01");//2018-12-01
            $ban=0;

          }


          $dias_inicio=date("d", strtotime($activo->fechaAdquisicion));//dia 12
          $mes_inicio=date("m", strtotime($activo->fechaAdquisicion));// mes 07
          $anno_inicio=date("Y", strtotime($activo->fechaAdquisicion));//2018

          $fecha_compra = date($anno_inicio."-".$mes_inicio."-01");//2018-07-01
          $fecha_max=date("Y-m-d", strtotime("$fecha_compra +$activo->aniosVida year"));
          if($dias_inicio<25)
          {
              $fecha_fin_mes2=date("Y-m-d", strtotime("$fecha_fin_mes +1 month"));
          }
          else $fecha_fin_mes2=$fecha_fin_mes;
          $inicio = new \DateTime($fecha_compra);
          $fin = new \DateTime($fecha_fin_mes2);
          $resultado = $inicio->diff($fin);

          $text_anno="año";
          $text_mes="mes";
          if($resultado->y>1)
          {
            $text_anno="años";
          }
          if($resultado->m>1)
          {
            $text_mes="meses";
          }


          if($fecha_fin_mes>=$fecha_max && $activo->estadoActivo!=0) //duda
          {

            $mesesDepre=$activo->aniosVida*12;
            $resultado->y=$activo->aniosVida;
            $resultado->m=0;
          }
          else {

            if($fecha_fin_mes>=$fecha_max && $activo->estadoActivo==0) //duda
            {
              $mesesDepre=$activo->aniosVida*12;
              $resultado->y=$activo->aniosVida;
              $resultado->m=0;

            }
            else
            {
              $mesesDepre=($resultado->y*12)+$resultado->m;

            }
        }
          $depreMen=($cuota/12)*$mesesDepre;
      ?>
          <br><br>



      <fieldset style="border: 3px solid #ccc; padding: 5px">
        <legend align='center'><b><small >Información del Activo</small></b></legend>

          <table align='center'>

          <tr>
            <th>Código:&nbsp;&nbsp;</th>
            <td>&nbsp;{{$activo->codigoInventario?:"No asignado"}}&nbsp;</th>


            <?php
                if($activo->codigoInventario!=null)
                $traslado=$activo->activosUnidades->last();
            ?>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <th>Unidad:&nbsp;&nbsp;</th>
            <td>{{$activo->codigoInventario?$traslado->unidad->nombreUnidad:"No asignado"}}&nbsp;</th>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <th>Año de Vida Utíl:</td>
              <td>{{ $activo->aniosVida.' Años' }}</td>
          </tr>

              <br><br>
            <tr>
            <th>Precio de Adquisición:&nbsp;&nbsp;</td>
            <td>&nbsp;$ {{number_format($activo->precio, 2, '.', ',')}}&nbsp;</td>

            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <th>Porcentaje Residual:&nbsp;&nbsp;</td>
              <td> {{number_format($activo->valorResidual, 0, '.', ',').' %'}}</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <th>Valor Residual:&nbsp;&nbsp;</td>
              <td>$ {{number_format($valorResidual, 2, '.', ',')}}</td>

          </tr>
          <br><br>
          <tr>
            <th>Costo a Depreciar:&nbsp;&nbsp;</td>
              <td>$ {{number_format($valorDepreciar, 2, '.', ',')}}</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <th>Cuota Anual:&nbsp;&nbsp;</th>
            <td>$ {{number_format($cuota, 2, '.', ',')}}</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <?php $datead = new DateTime($activo->fechaAdquisicion); ?>
            <th>fecha de Adquisición:&nbsp;&nbsp;</td>
            <td>{{ $datead->format('d/m/Y') }}</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>


          </tr>
          <tr>
            <th>Valor depreciado a la fecha:&nbsp;&nbsp;</td>
              <td>$ {{number_format($depreMen, 2, '.', ',')}}</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <th>Años depreciados:&nbsp;&nbsp;</th>
            <td>{{"$resultado->y $text_anno"}}</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <th>Meses depreciados:&nbsp;&nbsp;</td>
            <td>{{ "$resultado->m $text_mes"}}</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>


          </tr>
          @if($activo->estadoActivo==0)
          <tr>
              <th>Fecha de baja: &nbsp;&nbsp;</th>
              <?php $date1 = new DateTime($activo->fechaBajaActivo); ?>
              <td>{{ $date1->format('d/m/Y') }}</td>
            </tr>
            @endif



          </table>

          <br><br>

        </fieldset>
          <br><br>

<h4 align='center'><b>Depreciación del Anual </b></h4>

            <table id="" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
              <thead>
                <tr>
                  <b>
                  <th>#</th>
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
                  <td>{{ $cont }}</td>
                  <td>{{ $anno_inicio }}</td>
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
                    <td>{{ $cont }}</td>
                    <td>{{ $anno_inicio+$cont}}</td>
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
            <div align="center">
              <a target="_blank"  href="{{  url("activos/reporteDepreAnual/".$activo->id) }}" class='btn btn-success '>Descargar</a>
                	<a href="{{ url("activos/{$activo->id}") }}" class='btn btn-ocre '>Regresar</a>

            </div>
          <br>
          <h4 align="center" ><b>Depreciación Mensual</b></h4>


            <table id="" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Mes</th>
                  <th>Valor Original</th>

                  <th>Valor a Depreciar</th>
                  <th>Cuota mensual de Depreciación</th>
                  <th>Depreciación acumulada</th>
                  <th>Valor en Libros</th>
                </tr>
              </thead>
              <tbody>
                <?php $cont=0;
                $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                $mes_inicio=(integer) $mes_inicio-1;
                ?>
                <tr>
                  <td>{{ $cont }}</td>
                  <td>{{ $meses[$mes_inicio] }}</td>

                  <?php
                  $precio=$cuota;
                  //$valorResidual=$precio*$activo->valorResidual/100;
                  //$valorDepreciar=($precio-$valorResidual);
                  $valorDepreciar=$cuota;
                  $cuota=$valorDepreciar/12;
                  $depreAcumulada=0;

                  ?>
                  <td>$ {{number_format($precio, 2, '.', ',')}}</td>

                  <td>$ {{number_format($valorDepreciar, 2, '.', ',')}}</td>
                  <td>$ {{number_format($cuota, 2, '.', ',')}}</td>
                  <td></td>
                  <td>$ {{number_format($precio, 2, '.', ',')}}</td>
                </tr>

                @for($i=0;$i<12;$i++)
                  <?php
                    $cont++;
                    $valorDepreciar-=$cuota;
                    $depreAcumulada+=$cuota;
                    $precio-=$cuota;
                    $mes_inicio++;
                  ?>
                  <tr>
                    <td>{{ $cont }}</td>
                    <td>{{$meses[$mes_inicio]}}</td>

                    <td></td>
                    <td>$ {{number_format($valorDepreciar, 2, '.', ',')}}</td>
                    <td>$ {{number_format($cuota, 2, '.', ',')}}</td>
                    <td>$ {{number_format($depreAcumulada, 2, '.', ',')}}</td>
                    <td>$ {{number_format($precio, 2, '.', ',')}}</td>
                  </tr>
                    <?php
                        if($meses[$mes_inicio]==="Diciembre"){
                            $mes_inicio=-1;
                        }
                    ?>
                @endfor

              </tbody>
            </table>

        </div>
        <div align="center">
          <a target="_blank"  href="{{  url("activos/reporteDepreMensual/".$activo->id) }}" class='btn btn-success '>Descargar</a>
          	<a href="{{ url("activos/{$activo->id}") }}" class='btn btn-ocre '>Regresar</a>

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
