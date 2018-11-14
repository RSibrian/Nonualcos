
@extends ('plantilla')
@section('plantilla')
    <div class="row">
      <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="blue">
                    <i class="material-icons">perm_identity</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Mantenimiento -
                        <small class="category">Ver mantenimiento</small>
                    </h4>
                    <fieldset>
                      <div class="col-sm-8 row">
                          <div class="input-group">
                              <span class="input-group-addon">
                                  <i class="material-icons">#</i>
                              </span>
                              <div class="form-group label-floating">
                                  <label class="control-label">activo:
                                  </label>
                                  <input class="form-control" type="text"  value="{{$mantenimiento->activos()->first()->codigoInventario}} - {{$mantenimiento->activos()->first()->nombreActivo}}" readonly>
                              </div>
                          </div>
                      </div>
                      <div class="col-sm-4 row">
                          <div class="input-group">
                                          <span class="input-group-addon">
                                              <i class="material-icons"> $ </i>
                                          </span>
                              <div class="form-group label-floating">
                                  <label class="control-label">Costo de Mantenimiento
                                  </label>
                                  <input class="form-control" type="text"  value="{{$mantenimiento->costoMantenimiento}}" readonly>
                              </div>
                          </div>
                      </div>

                      <div class="col-lg-6 row">
                        <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                            <div class="form-group label-floating">
                                <label class="control-label"><code>*</code>Fecha de entrega en taller
                                </label>
                                <input class="form-control" type="text"  value="{{$mantenimiento->fechaEntregaMantenimiento->format('d/m/Y')}}" readonly>
                            </div>
                        </div>
                      </div>
                      <div class="col-lg-6 row">
                        <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                            <div class="form-group label-floating">
                                <label class="control-label">Fecha de recepción (Mantenimiento Realizado)
                                </label>
                                <input class="form-control" type="text"  value="{{$mantenimiento->fechaEntregaMantenimiento->format('d/m/Y')}}" readonly>
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-12 row">
                          <div class="input-group">
                              <span class="input-group-addon">
                                  <i class="material-icons">#</i>
                              </span>
                              <div class="form-group label-floating">
                                  <label class="control-label">Mantenimiento realizado:
                                  </label>
                                  <div >
                                  <textarea class="form-control"  rows="5"  readonly >{{$mantenimiento->reparacionesRealizadas}}</textarea>
                                </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-sm-12 row">
                          <div class="input-group">
                              <span class="input-group-addon">
                                  <i class="material-icons">#</i>
                              </span>
                              <div class="form-group label-floating">
                                  <label class="control-label"><code>*</code>Empresa encargada del mantenimiento:
                                  </label>
                                  <input class="form-control" type="text"  value="{{$mantenimiento->empresaEncargada}}" readonly>
                              </div>
                          </div>
                      </div>
                      <div class="col-sm-12 row">
                          <div class="input-group">
                              <span class="input-group-addon">
                                  <i class="material-icons">#</i>
                              </span>
                              <div class="form-group label-floating">
                                  <label class="control-label"><code>*</code>Personal que recibe:
                                  </label>
                                  <input class="form-control" type="text"  value="{{$mantenimiento->personalRecibeMantenimiento}}" readonly>

                              </div>
                          </div>
                      </div>

                    </fieldset>

                    <div align="center" class="row">
                                  <a href="{{ URL::previous() }}" class='btn btn-ocre '>Regresar</a>
                    </div>
                </div>
            </div>
        </div>
<div class="col-md-1"></div>
    </div>


    <!-- end row -->
@stop
