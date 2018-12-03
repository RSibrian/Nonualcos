<fieldset>
    <h6 class="campoObligatorio">los campos con ( * ) son obligatorios</h6>
    <div class="form-group row">
        <span class="col-md-2  text-center" ><label ><code>*</code> Nombre : </label></span>
        <div class="col-md-8">
            {!!Form::text('ban_nombre',null,['id'=>'ban_nombre','class'=>'form-control', 'placeholder'=>'Ingrese el nombre del banco...','required'])!!}
        </div>
    </div>
</fieldset>
