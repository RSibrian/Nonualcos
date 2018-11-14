<fieldset>
    <h6 class="campoObligatorio">los campos con ( * ) son obligatorios</h6>

    <div class="col-sm-10 row">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">&nbsp;#&nbsp;</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Ingrese el número de cuenta :
                </label>
                {!!Form::text('numeroCuenta',null,['id'=>'numeroCuenta','class'=>'form-control','required'])!!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 row">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">apps</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Ingrese el nombre del banco al que pertenece la cuenta :
                </label>
                {!!Form::text('banco',null,['id'=>'banco','class'=>'form-control','required'])!!}

            </div>
        </div>
    </div>
</fieldset>
