<fieldset>
  <h6 class="campoObligatorio">los campos con ( * ) son obligatorios</h6>
    <input type="hidden" name="hi2" value="1">

    <div class="col-sm-10 row">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">store</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Ingrese nombre de la Empresa :
                </label>
                {!!Form::text('nombreEmpresa',null,['id'=>'nombreEmpresa','class'=>'form-control','required'])!!}
            </div>
        </div>
    </div>
    <br>
    <div class="col-sm-10 row">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">person</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label">Ingrese nombre del Encargado :
                </label>
                  {!!Form::text('nombreEncargado',null,['id'=>'nombreEncargado','class'=>'form-control'])!!}
            </div>
        </div>
    </div>
    <br>
    <div class="col-sm-10 row">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">local_phone</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label">Ingrese número de Teléfono:
                </label>
                  {!!Form::text('telefonoProve',null,['id'=>'telefonoProve','class'=>'form-control'])!!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 row">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">email</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label">Ingrese Correo:
                </label>
                  {!!Form::text('email',null,['id'=>'email','class'=>'form-control'])!!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 row">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">email</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label">Tipo de Proveedor:
                </label>

                <select name="tipoProveedor" id="tipoProveedor" class="form-control" title="Seleccione el tipo de teléfono" >
                  <option value="1" @isset($prov)
                   @if($prov->tipoProveedor==1){{ 'selected' }}@endif
                   @endisset >Proveedor</option>
                  <option value="2"  @isset($prov)
                   @if($prov->tipoProveedor==2){{ 'selected' }}@endif
                  @endisset >Mantenimiento</option>
                  <option value="3" @isset($prov)
                   @if($prov->tipoProveedor==3){{ 'selected' }}@endif
                  @endisset >Proveedor y Mantenimiento</option>
                </select>

            </div>
        </div>
    </div>


</fieldset>
@section('scripts')
    {!!Html::script('js/jquery.mask.min.js')!!}
    <script type="text/javascript">
        $(document).ready(function(){
            $("#telefonoProve").mask("0000-0000")
        })
    </script>
@endsection
