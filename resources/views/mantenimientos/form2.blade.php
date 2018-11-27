<fieldset>
  <h6 class="campoObligatorio">los campos con ( * ) son obligatorios</h6>

  <div class="col-sm-4 row">
    <div class="input-group">
      <span class="input-group-addon">
        <i class="material-icons">#</i>
      </span>
      <div class="form-group label-floating">
        <label class="control-label">Código del Activo:
        </label>
        {!!Form::text('idActivo',
        $mantenimiento->activos()->first()->codigoInventario,
        ['id'=>'idActivo','class'=>'typeahead form-control','disabled'])!!}
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
        <input type="text" name="nombreActivo" id="nombreActivo" class="form-control" value="{{$mantenimiento->activos()->first()->nombreActivo}}" disabled>
      </div>
    </div>
  </div>
  <div class="col-lg-6 row">
    <div class="input-group">
      <span class="input-group-addon">
        <i class="material-icons">date_range</i>
      </span>
      <div class="form-group label-floating">
        <label class="control-label">Fecha de entrega en taller
        </label>
        {!!Form::date('fechaRecepcionTaller',
        $mantenimiento->fechaRecepcionTaller,
        ['id'=>'fechaRecepcionTaller','class'=>'form-control datepicker','disabled'])!!}
      </div>
    </div>
  </div>
  <div class="col-lg-6 row">
    <div class="input-group">
      <span class="input-group-addon">
        <i class="material-icons">date_range</i>
      </span>
      <div class="form-group label-floating">
        <label class="control-label"><code>*</code>Fecha de Retorno (Mantenimiento Realizado)
        </label>
        {!!Form::date('fechaRetornoTaller',
        $date,
        ['id'=>'fechaRetornoTaller','class'=>'form-control datepicker','required'])!!}
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
        {!! Form::textarea('reparacionesSolicitadas',
        $mantenimiento->reparacionesSolicitadas,
        ['id'=>'reparacionesSolicitadas','class'=>'form-control'  ,'rows'=>'4', 'style'=>'resize: both;']) !!}
      </div>
    </div>
  </div>
  <div class="col-sm-12 row">
    <div class="input-group">
      <span class="input-group-addon">
        <i class="material-icons">#</i>
      </span>
      <div class="form-group label-floating">
        <label class="control-label">Personal que solicita mantenimiento:
        </label>
        {!!Form::input('personalSolicitaMantenimiento',null,
        $mantenimiento->empleado1()->first()->nombresEmpleado.' '.$mantenimiento->empleado1()->first()->apellidosEmpleado,
        ['id'=>'personalSolicitaMantenimiento','class'=>'form-control',
        'disabled'])!!}
      </div>
    </div>
  </div>

  <div class="col-sm-11 row">
    <div class="input-group">
      <span class="input-group-addon">
        <i class="material-icons">#</i>
      </span>
      <div class="form-group label-floating">
        <label class="control-label">Empresa encargada del mantenimiento:
        </label>
        {!!Form::input('empresaEncargada',null,
        $mantenimiento->proveedores()->first()->nombreEmpresa,
        ['id'=>'empresaEncargada','class'=>'form-control','disabled'])!!}
      </div>
    </div>
  </div>

  <div class="col-sm-4 row">
    <div class="input-group">
      <span class="input-group-addon">
        <i class="material-icons"> $ </i>
      </span>
      <div class="form-group label-floating">
        <label class="control-label"><code>*</code>Costo de Mantenimiento
        </label>
        {!!Form::number('costoMantenimiento',
        $mantenimiento->costoMantenimiento,
        ['id'=>'costoMantenimiento','class'=>'form-control','step' => '0.01','required'])!!}
      </div>
    </div>
  </div>
  <div class="col-sm-12 row">
    <div class="input-group">
      <span class="input-group-addon">
        <i class="material-icons">#</i>
      </span>
      <div class="form-group label-floating">
        <label class="control-label"><code>*</code>Mantenimiento realizado:
        </label>
        {!! Form::textarea('reparacionesRealizadas',
        $mantenimiento->reparacionesRealizadas,
        ['id'=>'reparacionesRealizadas','class'=>'form-control'  ,'rows'=>'4', 'style'=>'resize: both;','required']) !!}
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
        {!!Form::select('personalRecibeMantenimiento',
        $empleados,
        null,
        ['id'=>'personalRecibeMantenimiento','class'=>'form-control',
        'placeholder'=>' ','required'])!!}
      </div>
    </div>
  </div>

</fieldset>
