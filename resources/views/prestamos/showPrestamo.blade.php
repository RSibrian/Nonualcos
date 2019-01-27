@extends ('plantilla')
@section('plantilla')
    <div class="row">
        <div class=" col-sm-offset-1  col-md-10">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="blue">
                    <i class="material-icons">perm_identity</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Préstamo -
                        <small class="category">Mostrando Préstamo </small>
                    </h4>


                    <fieldset style="border: 1px solid #ccc; padding: 10px">
                      <legend><small>Información del Préstamo</small></legend>

                      <div class="container">

                        <div class="row">
                          <div  class="col col-md-2">
                            <h4>Institución:</h4>
                          </div>
                          <div  class="col col-md-6" >
                            <h4><strong>{{$prestamo->institucion->nombreInstitucion}}</strong></h4>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col col-md-2">
                            <h4>Evento:</h4>
                          </div>
                          <div class="col col-md-6">
                            <h4><strong>
                              {{$prestamo->evento}}
                            </strong></h4>
                          </div>
                        </div>

                          <div class="row">
                          <div class="col col-md-2">
                            <h4>Nombre Solicitante:</h4>
                          </div>
                          <div class="col col-md-6">
                            <h4><strong>
                              {{$prestamo->nombreSolicitante}}
                            </strong></h4>
                          </div>
                        </div>

                      <div class="row">
                        <div class="col col-md-2">
                          <h4>DUI Solicitante:</h4>
                        </div>
                        <div class="col col-md-6">
                          <h4><strong>
                            {{$prestamo->DUISolicitante}}
                          </strong></h4>
                        </div>
                      </div>

                      <div class="row">
                      <div class="col col-md-2">
                        <h4>Télefono:</h4>
                      </div>
                      <div class="col col-md-6">
                        <h4><strong>
                          {{$prestamo->telefonoSolicitante}}
                        </strong></h4>
                      </div>
                    </div>


                    @if($prestamo->estadoPrestamo==0)
                        <?php

                          $estado='Cancelado';
                        ?>
                    @elseif($prestamo->estadoPrestamo==1)
                      <?php

                        $estado='Pendiente';
                      ?>
                    @elseif($prestamo->estadoPrestamo==2)
                      <?php

                        $estado='Completo';
                      ?>
                    @elseif($prestamo->estadoPrestamo==3)
                      <?php

                        $estado='No Reclamado';
                      ?>
                    @elseif($prestamo->estadoPrestamo==4)
                      <?php

                        $estado='Entregado';
                      ?>
                    @elseif($prestamo->estadoPrestamo==5)
                      <?php

                        $estado='No Devuelto';
                      ?>

                    @else
                      <?php

                        $estado='Devuelto Tarde';
                      ?>
                    @endif


                    <div class="row">
                    <div class="col col-md-2">
                      <h4>Estado:</h4>
                    </div>
                    <div class="col col-md-6">
                      <h4><strong>
                        {{$estado}}
                      </strong></h4>
                    </div>
                  </div>

                  <div class="row">
                  <div class="col col-md-2">
                    <h4>Fecha de Entrega:</h4>
                  </div>
                  <div class="col col-md-6">
                    <h4><strong>
                      <?php $date = new DateTime($prestamo->fechaEntregaPrestamo); ?>
                      {{$date->format('d/m/Y')}}
                    </strong></h4>
                  </div>
                </div>

                <div class="row">
                <div class="col col-md-2">
                  <h4>Fecha Devolución:</h4>
                </div>
                <div class="col col-md-6">
                  <h4><strong>
                    <?php $date1 = new DateTime($prestamo->fechaDevolucionPrestamo); ?>
                    {{$date1->format('d/m/Y')}}
                  </strong></h4>
                </div>
              </div>
              @if($prestamo->fechaRegresoPrestamo)
              <div class="row">
              <div class="col col-md-2">
                <h4>Fecha Regreso:</h4>
              </div>
              <div class="col col-md-6">
                <h4><strong>
                  <?php $date2= new DateTime($prestamo->fechaRegresoPrestamo); ?>
                  {{$date2->format('d/m/Y')}}
                </strong></h4>
              </div>
            </div>
          @endif

            </div>
          </fieldset>


          <h4 align='center'><b>Activos del Préstamo </b></h4>

                      <table id="" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                          <tr>
                            <b>
                            <th></th>
                            <th>#</th>
                            <th>Código Inventario</th>
                            <th>Artículo</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Color</th>

                          </b>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $cont=0;?>
                          @foreach($activos as $activo)
                            <?php
                            $cont++;
                          //  $activoPrestado=$activo->activo;
                            $activoPrestado=App\Activos::find($activo->activos_id);
                          //  dd($activoPrestado);
                            ?>
                            <tr>
                              <td></td>
                              <td>{{$cont}}</td>
                              <td>{{$activoPrestado->codigoInventario}}</td>
                              <td>{{$activoPrestado->nombreActivo}}</td>
                              <td>{{$activoPrestado->marca}}</td>
                              <td>{{$activoPrestado->modelo}}</td>
                              <td>{{$activoPrestado->color}}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
                <div align="center" class="row">
                  <a href="{{ URL::previous() }}" class='btn btn-ocre '>Regresar</a>
                </div>
            </div>
        </div>
    </div>


    <!-- end row -->
@stop
