<fieldset>
    <h6 class="campoObligatorio">los campos con ( * ) son obligatorios</h6>

    <div class="col-sm-8 row">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">#</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Seleccione el activo:
                </label>
                {!!Form::select('idActivo', $activos,null,['id'=>'idActivo','class'=>'form-control','required'])!!}
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
                {!!Form::number('costoMantenimiento',null,['id'=>'costoMantenimiento','class'=>'form-control','step' => '0.01'])!!}
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
              {!!Form::date('fechaRecepcionTaller',$date,['id'=>'fechaRecepcionTaller','class'=>'form-control datepicker'])!!}
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
              {!!Form::date('fechaEntregaMantenimiento',$date,['id'=>'fechaEntregaMantenimiento','class'=>'form-control datepicker'])!!}
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
                {!! Form::textarea('reparacionesRealizadas',null,['id'=>'reparacionesRealizadas','class'=>'form-control'  ,'rows'=>'4', 'style'=>'resize: both;']) !!}
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
                {!!Form::text('empresaEncargada',null,
                ['id'=>'empresaEncargada','class'=>'form-control','required'])!!}
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
                {!!Form::text('personalRecibeMantenimiento',null,
                ['id'=>'personalRecibeMantenimiento','class'=>'form-control','required'])!!}
            </div>
        </div>
    </div>

</fieldset>

@section('scripts')
    {!!Html::script('js/jquery.mask.min.js')!!}
    <script type="text/javascript">
        $(document).ready(function(){
            $("#codigoUnidad").mask("000")
        })
    </script>
@endsection
