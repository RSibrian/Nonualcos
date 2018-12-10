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
      @if($activo->codigoInventario!=null)
      <li id="li"  ><a href="{{ url("activosUnidades/{$activo->id}") }}">Traslado</a></li>
      @else
      <li id="li"  ><a href="{{ url("activosUnidades/{$activo->id}") }}">Asignar</a></li>
    @endif
    @if($activo->precio>=600 )
    <li id="li" style="float:right;"><a  href="{{ url("depreciaciones/{$activo->id}") }}">Depreciación</a></li>
    @endif
    @if($activo->codigoInventario!=null)
      <li id="li" style="float:right;"><a href="{{ url("activos/mantenimientosUnidades/{$activo->id}") }}">Mantenimiento</a></li>
      <li id="li" style="float:right;" ><a href="">Préstamo</a></li>
    @endif
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


                    <fieldset style="border: 1px solid #ccc; padding: 10px">
                      <legend><small>Información del Activo</small></legend>

                      <div class="container">
                        <div class="row">
                          <div class="col col-md-1">
                            <h4>Código:</h4>
                          </div>
                          <div class="col col-md-2">
                            <h4><strong>
                              @if($activo->codigoInventario!=null)
                                {{$activo->codigoInventario}}
                              @else
                                {{'No asignado'}}
                              @endif
                            </strong></h4>
                          </div>

                          <div class="col col-md-1">
                            <h4>Nombre:</h4>
                          </div>
                          <div class="col col-md-6">
                            <h4><strong>
                              {{$activo->nombreActivo}}
                            </strong></h4>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col col-md-2">
                            <h4>Clasificación:</h4>
                          </div>
                          <div class="col col-md-8">
                            <h4><strong>
                              {{$activo->clasificacionActivo->nombreTipo}}
                            </strong></h4>
                          </div>
                        </div>

                        @if($activo->tipoActivo==1)
                        <div class="row">
                          <div class="col col-md-2">

                            <h4>Número de Placa:</h4>
                          </div>
                          <div class="col col-md-8">
                            <h4><strong>
                              {{$activo->vehiculo->numeroPlaca}}
                            </strong></h4>
                          </div>
                        </div>
                      @endif


                      <div class="row">
                        <div class="col col-md-2">
                          <h4>Marca:</h4>
                        </div>
                        <div class="col col-md-8">
                          <h4><strong>
                            {{$activo->marca}}
                          </strong></h4>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col col-md-2">
                          <h4>Modelo:</h4>
                        </div>
                        <div class="col col-md-8">
                          <h4><strong>
                            {{$activo->modelo}}
                          </strong></h4>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col col-md-2">
                          <h4>Color:</h4>
                        </div>
                        <div class="col col-md-8">
                          <h4><strong>
                            {{$activo->color}}
                          </strong></h4>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col col-md-2">
                          <h4>Serie:</h4>
                        </div>
                        <div class="col col-md-8">
                          <h4><strong>
                            {{$activo->serie}}
                          </strong></h4>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col col-md-2">
                          <h4>Estado:</h4>
                        </div>
                        <div class="col col-md-8">
                          <h4><strong>
                            @if($activo->estadoActivo==0)
                              {{' De Baja'}}
                            @elseif($activo->estadoActivo==1)
                              {{'Activo'}}
                            @elseif($activo->estadoActivo==2)
                              {{'Dañado'}}
                            @elseif($activo->estadoActivo==3)
                            {{'Prestado'}}
                            @else
                                {{'Mantenimiento'}}
                            @endif
                          </strong></h4>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col col-md-2">
                          <h4>Tipo Adquisición:</h4>
                        </div>
                        <div class="col col-md-8">
                          <h4><strong>
                            @if($activo->tipoAdquisicion==1)
                            {{'Compra'}}
                            @else
                              {{'Donación'}}
                            @endif
                          </strong></h4>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col col-md-2">
                          <h4>Valor Residual:</h4>
                        </div>
                        <div class="col col-md-8">
                          <h4><strong>
                          {{$activo->valorResidual.'%'}}
                          </strong></h4>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col col-md-2">
                          <h4>Años de Vida util:</h4>
                        </div>
                        <div class="col col-md-8">
                          <h4><strong>
                          {{$activo->aniosVida}}
                          </strong></h4>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col col-md-2">
                          <h4>fecha Adquisición: </h4>
                        </div>
                        <div class="col col-md-8">
                          <h4><strong>
                            <?php $date = new DateTime($activo->fechaAdquisicion); ?>
                          {{$date->format('d/m/Y')}}
                          </strong></h4>
                        </div>
                      </div>

                      @if($activo->ObservacionActivo!=null)
                      <div class="row">
                        <div class="col col-md-2">
                          <h4>Observación:  </h4>
                        </div>
                        <div class="col col-md-8">
                          <h4><strong>
                          {{$activo->ObservacionActivo}}
                          </strong></h4>
                        </div>
                      </div>
                    @endif

                      </div>
                    </fieldset>
                    <br>

                    <fieldset style="border: 1px solid #ccc; padding: 10px">
                      <legend><small>Detalle de Adquisición</small></legend>
                        <div class="container">
                          @if($activo->idProveedor!=null)
                          <div class="row">
                            <div class="col col-md-2">
                              <h4>Proveedor:  </h4>
                            </div>
                            <div class="col col-md-8">
                              <h4><strong>
                              {{$activo->proveedor->nombreEmpresa}}
                              </strong></h4>
                            </div>
                          </div>
                        @endif
                          @if($activo->numeroFactura!=null)
                        <div class="row">
                          <div class="col col-md-2">
                            <h4>factura:  </h4>
                          </div>
                          <div class="col col-md-8">
                            <h4><strong>
                            {{$activo->numeroFactura}}
                            </strong></h4>
                          </div>
                        </div>
                          @endif

                          <div class="row">
                            <div class="col col-md-2">
                              <h4>Precio:  </h4>
                            </div>
                            <div class="col col-md-8">
                              <h4><strong>
                              {{'$'.$activo->precio}}
                              </strong></h4>
                            </div>
                          </div>

                      </div>
                      </fieldset>


                    @if($activo->codigoInventario!=null)
                    <fieldset style="border: 1px solid #ccc; padding: 10px">
                      <legend><small>Asignacion</small></legend>
                        <div class="container">
                          <?php
                              $traslado=$activo->activosUnidades->last();
                          ?>
                          <div class="row">
                            <div class="col col-md-2">
                              <h4>Unidad:  </h4>
                            </div>
                            <div class="col col-md-8">
                              <h4><strong>
                              {{$traslado->unidad->nombreUnidad}}
                              </strong></h4>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col col-md-2">
                              <h4>Encargado:  </h4>
                            </div>
                            <div class="col col-md-8">
                              <h4><strong>
                              {{$traslado->empleado->nombresEmpleado}}
                              </strong></h4>
                            </div>
                          </div>

                        </div>
                    </fieldset>
                    @endif
<br>
                      @if($activo->estadoActivo==0)
                      <fieldset style="border: 1px solid #ccc; padding: 10px">
                        <legend><small>Detalle de Estado: De Baja</small></legend>
                          <div class="container">
                            <?php $date = new DateTime($activo->fechaBajaActivo); ?>
                            <div class="row">
                              <div class="col col-md-2">
                                <h4>Fecha dado De Baja:  </h4>
                              </div>
                              <div class="col col-md-8">
                                <h4><strong>
                                {{$date->format('d/m/Y')}}
                                </strong></h4>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col col-md-2">
                                <h4>Justificación:  </h4>
                              </div>
                              <div class="col col-md-8">
                                <h4><strong>
                                {{$activo->justificacionActivo}}
                                </strong></h4>
                              </div>
                            </div>

                          </div>
                      </fieldset>
                      @endif
                      <div align="center">
                        <a target="_blank"  href="{{  url("activos/reporteDatosActivos/".$activo->id) }}" class='btn btn-success '>Imprimir</a>
                          <a href="{{ URL::previous() }}" class='btn btn-ocre '>Regresar</a>

                      </div>


                  </div>
            </div>
        </div>


    </div>
@stop
