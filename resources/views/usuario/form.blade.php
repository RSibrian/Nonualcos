<fieldset>
  <h6 class="campoObligatorio">los campos con ( * ) son obligatorios</h6>
    <input type="hidden" name="hi2" value="1">

    <div class="col-sm-10 row">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">account_box</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Ingrese nombre de Usuario :
                </label>
              {!!Form::text('name',null,['id'=>'name','class'=>'form-control','required'])!!}
            </div>
        </div>
    </div>

    <br>
    <div class="col-sm-10 row">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">email</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Correo :
                </label>
              {!!Form::text('email',null,['id'=>'email','class'=>'form-control', 'required'])!!}
            </div>
        </div>
    </div>
    <br>
    <div class="col-sm-10 row">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">account_box</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>
                </label>
              {!!Form::select('idEmpleado', $empleados,null,['id'=>'idEmpleado','class'=>'form-control','placeholder'=>'  Seleccione el empleado'])!!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 row">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">lock</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Contraseña :
                </label>
              {!!Form::password('password',['class'=>'form-control'])!!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 row">
        <div class="input-group">
            <span for="password-confirm" class="input-group-addon">
                <i class="material-icons">lock</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Confirmar Contraseña :
                </label>
              {!!Form::password('password_confirmation',['id'=>'password-confirm','class'=>'form-control'])!!}
            </div>
        </div>
    </div>



</fieldset>
