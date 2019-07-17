<fieldset>
  <h6 class="campoObligatorio">los campos con ( * ) son obligatorios</h6>

  <div class="col-sm-4 row">
    <div class="input-group">
      <span class="input-group-addon">
        <i class="material-icons">#</i>
      </span>
      <div class="form-group label-floating">
        <label class="control-label"><code>*</code>Código del Activo:
        </label>
        {!!Form::hidden('idActivo',$activo->idActivo,['id'=>'idActivo'])!!}
        {!!Form::text('codigoInventario',$activo->codigoInventario,['id'=>'codigoInventario','class'=>'typeahead form-control','required'])!!}
      </div>
    </div>
  </div>
  <div class="col-sm-8 row">
    <div class="input-group">
      <span class="input-group-addon">
        <i class="material-icons">#</i>
      </span>
      <div class="form-group label-floating">
        <!-- nombre del activo  -->
        <input type="text" name="nombreActivo" id="nombreActivo" class="form-control" value="{{ $activo->nombreActivo?:""}}" disabled>
      </div>
    </div>
  </div>
  <div class="col-lg-6 row">
    <div class="input-group">
      <span class="input-group-addon">
        <i class="material-icons">date_range</i>
      </span>
      <div class="form-group label-floating">
        <label for="fechaRecepcionTaller"><code>*</code><small>Fecha de inicio de solicitud </small>
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
        <label for="fechaRetornoTaller"><small>Fecha de Retorno (Finalizado)</small>
        </label>
        {!!Form::date('fechaRetornoTaller',null,['id'=>'fechaRetornoTaller','class'=>'form-control datepicker'])!!}
      </div>
    </div>
  </div>
  <div class="col-sm-12 row">
    <div class="input-group">
      <span class="input-group-addon">
        <i class="material-icons">#</i>
      </span>
      <div class="form-group label-floating">
        <label class="control-label"><code>*</code>Mantenimiento Solicitado:
        </label>
        {!! Form::textarea('reparacionesSolicitadas',null,['id'=>'reparacionesSolicitadas','class'=>'form-control'  ,'rows'=>'4', 'style'=>'resize: both;']) !!}
      </div>
    </div>
  </div>
  <div class="col-sm-12 row">
    <div class="input-group">
      <span class="input-group-addon">
        <i class="material-icons">#</i>
      </span>
      <div class="form-group label-floating">
        <label class="control-label"><code>*</code>Personal de ALN que solicita:
        </label>
        {!!Form::select('personalSolicitaMantenimiento',$empleados,
        null,['id'=>'personalSolicitaMantenimiento','class'=>'form-control','required',
        'placeholder'=>' '])!!}
      </div>
    </div>
  </div>

  <div class="col-sm-11 row">
    <div class="input-group">
      <span class="input-group-addon">
        <i class="material-icons">#</i>
      </span>
      <div class="form-group label-floating">
        <label class="control-label"><code>*</code>Empresa encargada del mantenimiento:
        </label>
        {!!Form::select('empresaEncargada',$proveedores,null,
        ['id'=>'empresaEncargada','class'=>'form-control','required',
        'placeholder'=>' '])!!}
      </div>
    </div>
  </div>
  <div class="col-sm-11 row">
    <div class="input-group">
      <span class="input-group-addon">
        <i class="material-icons">#</i>
      </span>
      <div class="form-group label-floating">
        <label class="control-label"><code>*</code>Persona encargada de mantenimiento :
        </label>
        {!!Form::text('nombreEncargado',null,
        ['id'=>'nombreEncargado','class'=>'form-control','required'])!!}
      </div>
    </div>
  </div>

  <div class="col-sm-5 row">
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
        <label class="control-label">Personal de ALN que recibe:
        </label>
        {!!Form::select('personalRecibeMantenimiento',$empleados,
        null,['id'=>'personalRecibeMantenimiento','class'=>'form-control',
        'placeholder'=>' '])!!}
      </div>
    </div>
  </div>

</fieldset>

@section('scripts')
{!!Html::script('js/typeahead.min.js')!!}
<script type="text/javascript">
var path = "{{ route('autocompletarActivos') }}";
$('input.typeahead').typeahead({
  source:  function (query, process) {
    return $.get(path, { query: query }, function (data) {
      return process(data);
    });
  },
  autoSelect: true,
  displayText: function(item) {
    $('#idActivo').val(item.value);
    $('#nombreActivo').val(item.value2);
    return item.value1;
  }
});
</script>
@endsection
