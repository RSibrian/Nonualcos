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
                <label class="control-label"><code>*</code>Ingrese nombre del Encargado :
                </label>
                  {!!Form::text('nombreEncargado',null,['id'=>'nombreEncargado','class'=>'form-control','required'])!!}
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
                <label class="control-label"><code>*</code>Ingrese número de Teléfono:
                </label>
                  {!!Form::text('telefonoProve',null,['id'=>'telefonoProve','class'=>'form-control','required'])!!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 row">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">email</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Ingrese Correo:
                </label>
                  {!!Form::text('email',null,['id'=>'email','class'=>'form-control','required'])!!}
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
