<fieldset>
    <h6 class="campoObligatorio">los campos con ( * ) son obligatorios</h6>

    <div class="col-sm-10 row">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">apps</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Selecione una Unidad :
                </label>
              {!!Form::select('idUnidad',$unidades,null,['id'=>'idUnidad','class'=>'form-control','required'])!!}

            </div>
        </div>
    </div>

    <div class="col-sm-10 row">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">apps</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Ingrese nombre del Cargo :
                </label>
              {!!Form::text('nombreCargo',null,['id'=>'nombreCargo','class'=>'form-control', 'required'])!!}

            </div>
        </div>
    </div>


</fieldset>
