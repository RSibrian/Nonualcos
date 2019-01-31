<fieldset>
    <h6 class="campoObligatorio">los campos con ( * ) son obligatorios</h6>

    <div class="col-sm-10 row">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">&nbsp;#&nbsp;</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Ingrese el código de la Clasificación :
                </label>
                {!!Form::text('codigoTipo',null,['id'=>'codigoTipo','class'=>'form-control','required'])!!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 row">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">apps</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Ingrese el nombre de la Clasificación :
                </label>
                {!!Form::text('nombreTipo',null,['id'=>'nombreTipo','class'=>'form-control','required'])!!}

            </div>
        </div>
    </div>

</fieldset>

@section('scripts')
    {!!Html::script('js/jquery.mask.min.js')!!}
    <script type="text/javascript">
        $(document).ready(function(){
            $("#codigoTipo").mask("000")
        })
    </script>
@endsection
