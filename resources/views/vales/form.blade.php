<h6 class="campoObligatorio">los campos con ( * ) son obligatorios</h6>
<br>
<fieldset style="border: 1px solid #ccc; padding: 10px">
    <legend><small>Datos de salida</small></legend>

    <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">date_range</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label">Fecha de salida
                    <small >(*)</small>
                </label>
                {!!Form::date('fechaSalida',old('fechaSalida', date('Y-m-d')),['id'=>'fechaSalida','class'=>'form-control datepicker'])!!}
            </div>
        </div>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">directions_car</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label" for="numeroPlaca">Vehículo
                    <small>(*)</small>
                </label>
                {!!Form::text('numeroPlaca',old('numeroPlaca'),['id'=>'numeroPlaca','class'=>'form-control','required'])!!}
            </div>
        </div>

    </div>

    <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">place</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label">Destino
                    <small>(*)</small>
                </label>
                {!!Form::text('destinoTrasladarse',old('destinoTrasladarse'),['id'=>'destinoTrasladarse','class'=>'form-control','required'])!!}
            </div>
        </div>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">face</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label">Solicitante
                    <small>(*)</small>
                </label>
                {!!Form::text('solicitante',old('solicitante'),['id'=>'solicitante','class'=>'form-control','required'])!!}
                {!! Form::hidden('idsolicitante',null,['id'=>'idsolicitante']) !!}
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons"></i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label">Misión
                </label>
                {!!Form::textarea('mision',old('mision'),['id'=>'mision','class'=>'form-control','rows'=>'3'])!!}
            </div>
        </div>
    </div>
</fieldset>
<br>
<fieldset style="border: 1px solid #ccc; padding: 10px">
    <legend><small>Datos de Vale</small></legend>

    <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">date_range</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label">Fecha de Vale
                    <small>(*)</small>
                </label>
                {!!Form::date('fechaCreacion', old('fechaCreacion', date('Y-m-d')) ,['id'=>'fechaCreacion','class'=>'form-control datepicker'])!!}
            </div>
        </div>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">ev_station</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label">Gasolinera
                    <small>(*)</small>
                </label>
                {!!Form::text('gasolinera',old('gasolinera'),['id'=>'gasolinera','class'=>'form-control','required'])!!}
            </div>
        </div>

         <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">ev_station</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label">Número de galones
                    <small>(*)</small>
                </label>
                {!!Form::number('galones',old('galones'),['id'=>'galones','class'=>'form-control','required'])!!}
            </div>
        </div>

    </div>

    <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">vpn_key</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label" id="muestra">Número de vale
                    <small>(*)</small>
                </label>
                {!!Form::text('numeroVale',old('numeroVale'),['id'=>'numeroVale','class'=>'form-control', 'require'])!!}
            </div>
        </div>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">ev_station</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label">Tipo de combustible
                    <small>(*)</small>
                </label>
                {!!Form::text('tipoCombustible',old('tipoCombustible'),['id'=>'tipoCombustible','class'=>'form-control','required'])!!}
            </div>

        </div>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">local_atm</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label">Costo de vale
                </label>
                {!!Form::text('costoUnitarioVale',old('costoUnitarioVale'),['id'=>'costoUnitarioVale','class'=>'form-control'])!!}
            </div>

        </div>

    </div>
</fieldset>
<br>

<fieldset style="border: 1px solid #ccc; padding: 10px">
    <legend><small>Datos de entrega</small></legend>

    <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">face</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label">Empleado que autoriza
                    <small>(*)</small>
                </label>
                {!!Form::text('empAutoriza',old('empAutoriza'),['id'=>'empAutoriza','class'=>'form-control datepicker', 'required'])!!}
                {!! Form::hidden('idempAutoriza',null,['id'=>'idempAutoriza']) !!}
            </div>
        </div>

    </div>

    <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">face</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label">Empleado que recibe
                    <small>(*)</small>
                </label>
                {!!Form::text('empRecibe',old('empRecibe'),['id'=>'empRecibe','class'=>'form-control','required'])!!}
                {!! Form::hidden('idempRecibe',null,['id'=>'idempRecibe']) !!}
            </div>
        </div>

    </div>
    <div class="col-sm-6 col-sm-offset-4">
        <div class="input-group">
            <div class="form-group ">
                <label > Estado de entrega
                    <small>(*)</small>
                </label>
                <label class="switch">
                    <input type="checkbox" name="estadoEntregadoVal" id="estadoEntregadoVal" checked>
                    <span class="slider"></span>
                </label>
            </div>
        </div>
    </div>
</fieldset>
<br>

    <style>
        .switch input {
            display:none;
            background: white;
        }
        .switch {
            display:inline-block;
            width:40px;
            height:20px;
            margin:8px;
            transform:translateY(50%);
            position:relative;
            background: white;
        }

        .slider {
            position:absolute;
            top:0;
            bottom:0;
            left:0;
            right:0;
            border-radius:20px;
            box-shadow:0 0 0 2px #777, 0 0 4px #777;
            cursor:pointer;
            border:4px solid transparent;
            overflow:hidden;
            transition:.4s;
            background: white;
        }
        .slider:before {
            position:absolute;
            content:"";
            width:100%;
            height:100%;
            background:#777;
            border-radius:20px;
            transform:translateX(-20px);
            transition:.4s;
        }

        input:checked + .slider:before {
            transform:translateX(20px);
            background:dodgerblue;
        }
        input:checked + .slider {
            box-shadow:0 0 0 2px dodgerblue,0 0 2px dodgerblue;
        }

        .ui-autocomplete {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            float: left;
            display: none;
            min-width: 160px;
            _width: 160px;
            padding: 4px 0;
            margin: 2px 0 0 0;
            list-style: none;
            background-color: #ffffff;
            border-color: #ccc;
            border-color: rgba(0, 0, 0, 0.2);
            border-style: solid;
            border-width: 1px;
            padding-left: 5px;
            padding-right: 5px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
             box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            -webkit-background-clip: padding-box;
            -moz-background-clip: padding;
             background-clip: padding-box;
            *border-right-width: 2px;
            *border-bottom-width: 2px;
        }

        .ui-menu-item > a.ui-corner-all {
            display: block;
            padding: 3px 15px;
            clear: both;
            font-weight: normal;
            line-height: 18px;
            color: #555555;
            white-space: nowrap;
        }

        .ui-state-hover, .ui-state-active {
            color: #555555;
            text-decoration: none;
            background-color: #EEEEEE;
            border-radius: 0px;
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            background-image: none;
        }

        .ui-helper-hidden-accessible{ display:none; }

    </style>

@section('scripts')

    <script type="text/javascript">

        $( function()
        {
            var placas= "{{ route('autocompletePlacas') }}";

            $( '#numeroPlaca' ).autocomplete({
                source: placas,
            });



        });

        $( function()
        {
            var destinos= "{{ route('autocompleteDestinos') }}";

            $( '#destinoTrasladarse' ).autocomplete({
                source: destinos
            });

        });

        $( function()
        {
            var empleado= "{{ route('autocompleteEmpleado') }}";

            $( '#solicitante' ).autocomplete({
                source: empleado,
                select: function(event, ui) {
                    $('#idsolicitante').val(ui.item.id);
                }
            });

            $( '#empAutoriza' ).autocomplete({
                source: empleado,
                select: function(event, ui) {
                    $('#idempAutoriza').val(ui.item.id);
                }
            });

            $( '#empRecibe' ).autocomplete({
                source: empleado,
                select: function(event, ui) {
                    $('#idempRecibe').val(ui.item.id);
                }
            });

        });

        $( function()
        {
            var gasolinera= "{{ route('autocompleteGasolinera') }}";

            $( '#gasolinera' ).autocomplete({
                source: gasolinera
            });

        });

        $( function()
        {
            var gasolinera= "{{ route('autocompletetipoCombustible') }}";

            $( '#tipoCombustible' ).autocomplete({
                source: gasolinera
            });

        });

    </script>

    {!!Html::script('js/jquery.mask.min.js')!!}
    <script type="text/javascript">
        $(document).ready(function(){

            var options = {
                translation: {
                    'A': {pattern: /[A-Z]/},
                    'a': {pattern: /[a-zA-Z]/},
                    'S': {pattern: /[a-zA-Z0-9]/},
                    'L': {pattern: /[a-z]/},
                }
            }


            $("#numeroVale").mask("00000")


        })
    </script>


@endsection


