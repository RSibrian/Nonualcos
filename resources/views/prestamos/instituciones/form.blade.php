<fieldset>
    <h6 class="campoObligatorio">los campos con ( * ) son obligatorios</h6>

    <div class="col-sm-10 row">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">&nbsp;#&nbsp;</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Ingrese el Nombre de la institución
                </label>
                {!!Form::text('nombreInstitucion',null,['id'=>'nombreInstitucion','class'=>'form-control','required'])!!}
            </div>
        </div>
    </div>
    <div class="col-sm-10 row">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">apps</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Ingrese el Teléfono
                </label>
                {!!Form::text('telefonoInstitucion',null,['id'=>'telefono','class'=>'form-control','required'])!!}

            </div>
        </div>
    </div>
    <div class="col-sm-10 row">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">apps</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Dirección
                </label>
                {!! Form::textarea('direccionInstitucion',null,['class'=>'form-control'  ,'rows'=>'2', 'style'=>'resize: both;']) !!}
            </div>
        </div>
    </div>

</fieldset>

@section('scripts')
    {!!Html::script('js/jquery.mask.min.js')!!}


    {!!Html::script('js/jquery.mask.min.js')!!}
    <script type="text/javascript">
        $(document).ready(function(){
            $("#cpf").mask("000.000.000-00")
            $("#cnpj").mask("00.000.000/0000-00")
            $("#telefone").mask("(00) 0000-0000")
            //  $("#salario").mask("999.999.990,00", {reverse: true})
            $("#dui").mask("00000000-0")
            $("#cep").mask("00.000-000")
            $("#dataNascimento").mask("00/00/0000")

            $("#rg").mask("999.999.999-W", {
                translation: {
                    'W': {
                        pattern: /[X0-9]/
                    }
                },
                reverse: true
            })

            var options = {
                translation: {
                    'A': {pattern: /[A-Z]/},
                    'a': {pattern: /[a-zA-Z]/},
                    'S': {pattern: /[a-zA-Z0-9]/},
                    'L': {pattern: /[a-z]/},
                }
            }

            $("#placa").mask("AAA-0000", options)

            $("#codigo").mask("AA.LLL.0000", options)

            $("#telefono").mask("0000-0000")


        });
        </script>
@endsection
