<div class="tab-content">
    <div class="tab-pane" id="about">
        <div class="row">
            <h4 class="info-text">Comencemos con los Datos Generales</h4>
            <div class="col-sm-10 row">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">apps</i>
                    </span>
                    <div class="form-group label-floating">
                        <label class="control-label">
                        </label>
                      {!!Form::select('idClasificacionActivo',$clasificaciones,null,['id'=>'idClasificacionActivo','class'=>'form-control','placeholder'=>'   seleccione una clasificación (requerido)','required'])!!}

                    </div>
                </div>
            </div>


          @if($activo->tipoActivo==1)
          <div class="col-sm-5 row " id="placa_div">
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">credit_card</i>
                  </span>
                  <div class="form-group label-floating">
                      <label class="control-label"><code>*</code>Ingrese número de placa:
                      </label>
                      {!!Form::text('numeroPlaca',$activo->vehiculo->numeroPlaca,['id'=>'numeroPlaca','class'=>'form-control','required'])!!}
                  </div>
              </div>
          </div>
        @endif
            <div class="col-sm-10 row">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">event_seat</i>
                    </span>
                    <div class="form-group label-floating">
                        <label class="control-label"><code>*</code>Ingrese nombre de Activo:
                        </label>
                        {!!Form::text('nombreActivo',null,['id'=>'nombreActivo','class'=>'form-control','required'])!!}
                    </div>
                </div>
            </div>
            <div class="col-sm-5 row">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">apps</i>
                    </span>
                    <div class="form-group label-floating">
                        <label class="control-label">Tipo de Adquisición:
                        </label>
                        <select name="tipoAdquisicion" id="tipoAdquisicion" class="form-control"  required>
                          @if($activo->tipoAdquisicion==1)
                              <option selected value=1>Compra</option>
                              <option value=0>Donación</option>
                          @else
                              <option value=1>Compra</option>
                              <option selected value=0>Donación</option>
                          @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 row">
                <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                    <div class="form-group label-floating">
                        <label class="control-label">Fecha de Adquisición
                            <small></small>
                        </label>
                        {!!Form::date('fechaAdquisicion',$date,['id'=>'fechaAdquisicion','class'=>'form-control datepicker'])!!}

                    </div>
                </div>
            </div>


            <div class="col-sm-5 row">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">class</i>
                    </span>
                    <div class="form-group label-floating">
                        <label class="control-label"><code>*</code>Ingrese la marca:
                        </label>
                        {!!Form::text('marca',null,['id'=>'marca','class'=>'form-control','required'])!!}
                    </div>
                </div>
            </div>

            <div class="col-sm-5 row">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">bookmarks</i>
                    </span>
                    <div class="form-group label-floating">
                        <label class="control-label"><code>*</code>Ingrese el modelo:
                        </label>
                        {!!Form::text('modelo',null,['id'=>'modelo','class'=>'form-control','required'])!!}
                    </div>
                </div>
            </div>

            <div class="col-sm-5 row">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">dns</i>
                    </span>
                    <div class="form-group label-floating">
                        <label class="control-label"><code>*</code>Ingrese el color:
                        </label>
                        {!!Form::text('color',null,['id'=>'color','class'=>'form-control','required'])!!}
                    </div>
                </div>
            </div>

            <div class="col-sm-10 row">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">note_add</i>
                    </span>
                    <div class="form-group label-floating">
                        <label class="control-label">Observación del Activo:
                        </label>
                        {!!Form::text('ObservacionActivo',null,['id'=>'ObservacionActivo','class'=>'form-control'])!!}
                    </div>
                </div>
            </div>


        </div>

    </div>

    <div class="tab-pane" id="account">
        <h4 class="info-text"> Sigamos con la información Detalle de Compra</h4>
        <div class="row">

              <div class="col-sm-10 row">
                  <div class="input-group">
                      <span class="input-group-addon">
                          <i class="material-icons">store</i>
                      </span>
                      <div class="form-group label-floating">
                          <label class="control-label">
                          </label>
                        {!!Form::select('idProveedor',$proveedores,null,['id'=>'idProveedor','class'=>'form-control','placeholder'=>'Selecione un Proveedor'])!!}
                      </div>
                  </div>
              </div>

                <div class="col-sm-5 row">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">tab</i>
                        </span>
                        <div class="form-group label-floating">
                            <label class="control-label"><code>*</code>Número de factura:
                            </label>
                            {!!Form::text('numeroFactura',null,['id'=>'numeroFactura','class'=>'form-control','required'])!!}
                        </div>
                    </div>
                </div>
              <div class="col-sm-5 row">
                  <div class="input-group">
                      <span class="input-group-addon">
                          <i class="material-icons">attach_money</i>
                      </span>
                      <div class="form-group label-floating">
                          <label class="control-label"><code>*</code>Precio del activo:
                          </label>
                          {!!Form::number('precio',null,['id'=>'precio','class'=>'form-control','required'])!!}
                      </div>
                  </div>
              </div>


        </div>
    </div>

</div>
@section('scripts')
<script type="text/javascript">
    $().ready(function() {
        demo.initMaterialWizard();
    });
</script>



@endsection
