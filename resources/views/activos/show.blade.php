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
      <li id="li"><a class="active" href="{{ url("activos/{$activo->id}") }}">Datos Activo</a></li>
      <li id="li"  ><a href="{{ url("activosUnidades/{$activo->id}") }}">Traslado</a></li>
      <li id="li" style="float:right;"><a href="">Depreciación</a></li>
      <li id="li" style="float:right;"><a href="">Mantenimiento</a></li>
      <li id="li" style="float:right;" ><a href="">Préstamo</a></li>
  </ul>
    <div class="row">
        <div class="col-sm-offset-1 col-md-10">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="blue">
                    <i class="material-icons">work</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Activo -
                        <small class="category">Mostrando el Activo: <b>{{$activo->nombreActivo}}</b></small>
                    </h4>

                    <fieldset>
                        <input type="hidden" name="hi2" value="1">
                        <div class="form-group ">
                            <table>
                              <tr>
                                  <td colspan="4" class="text-center"><h3 id="texto"><b>&nbsp;Información del Activo </b></h3></td>
                              </tr>
                                <tr>
                                    <td><h4>Codigo de Inventario: </h4></td>
                                    <td><h4> <b>&nbsp;{{$activo->codigoInventario}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Nombre de Activo: </h4></td>
                                    <td><h4> <b>&nbsp;{{$activo->nombreActivo}}</b></h4></td>
                                </tr>

                                <tr>
                                    <td><h4>Clasificación: </h4></td>
                                    <td><h4><b>&nbsp;{{$activo->clasificacionActivo->nombreTipo}}</b></h4></td>
                                </tr>
                                <tr>
                                  <?php  if($activo->tipoActivo==1){?>
                                    <td><h4>Numero Placa: </h4></td>
                                    <td><h4> <b>&nbsp;{{$activo->vehiculo->numeroPlaca}}</b></h4></td>
                                  <?php } ?>
                                </tr>
                                <tr>
                                    <td><h4>Marca: </h4></td>
                                    <td><h4> <b>&nbsp;{{$activo->marca}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Modelo: </h4></td>
                                    <td><h4> <b>&nbsp;{{$activo->modelo}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Color: </h4></td>
                                    <td><h4> <b>&nbsp;{{$activo->color}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Tipo Adquisición: </h4></td>
                                    @if($activo->tipoAdquisicion==1)
                                    <td><h4> <b>&nbsp;Compra</b></h4></td>
                                    @else
                                      <td><h4> <b>&nbsp;Donación</b></h4></td>
                                    @endif

                                </tr>
                                <tr>
                                    <td><h4>Valor Residual: </h4></td>
                                    <td><h4> <b>&nbsp;{{$activo->valorResidual}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Años de Vida util: </h4></td>
                                    <td><h4> <b>&nbsp;{{$activo->aniosVida}}</b></h4></td>
                                </tr>
                              <tr>
                                  <?php $date = new DateTime($activo->fechaAdquisicion); ?>
                                    <td><h4>fecha Adquisición: </h4></td>
                                    <td><h4><b>&nbsp;{{$date->format('d/m/Y')}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Observación: </h4></td>
                                    <td><h4> <b>&nbsp;{{$activo->ObservacionActivo}}</b></h4></td>
                                </tr>

                                <tr>
                                    <td colspan="4" class="text-center"><h3 id="texto"><b>&nbsp;Detalle de Adquisición </b></h3></td>
                                </tr>
                                <tr>
                                  @if($activo->idProveedor!=null)
                                    <td><h4>Proveedor: </h4></td>
                                    <td><h4> <b>&nbsp;{{$activo->proveedor->nombreEmpresa}}</b></h4></td>
                                  @endif

                                </tr>
                                <tr>
                                    <td><h4>Número Factura: </h4></td>
                                    <td><h4> <b>&nbsp;{{$activo->numeroFactura}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Precio: ($)</h4></td>
                                    <td><h4> <b>&nbsp;{{$activo->precio}}</b></h4></td>
                                </tr>

                                <tr>
                                    <td colspan="4" class="text-center"><h3 id="texto"><b>&nbsp;Asignación </b></h3></td>
                                </tr>
                                <tr>
                                  <?php
                                      $traslado=$activo->activosUnidades->last();
                                  ?>
                                    <td><h4>Unidad: ($)</h4></td>
                                    <td><h4> <b>&nbsp;{{$traslado->unidad->nombreUnidad}}</b></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Empleado: ($)</h4></td>
                                    <td><h4> <b>&nbsp;{{$traslado->empleado->nombresEmpleado}}</b></h4></td>
                                </tr>
                                <tr>
                                  <?php $date = new DateTime($traslado->fechaInicioUni); ?>
                                    <td><h4>fecha de Asignación: </h4></td>
                                    <td><h4><b>&nbsp;{{$date->format('d/m/Y')}}</b></h4></td>
                                </tr>
                            </table>
                            <div align="center">
                                <a href="{{ URL::previous() }}" class='btn btn-ocre '>Regresar</a>
                            </div>
                        </div>
                    </fieldset>
                  </div>
            </div>
        </div>


    </div>
@stop
