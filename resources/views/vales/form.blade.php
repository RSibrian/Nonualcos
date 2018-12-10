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
    </div>

    <div class="col-sm-12">
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
    </div>

    <div class="col-sm-12">
        <div class="input-group ">
            <span class="input-group-addon">
                <label >Tipo de combustible
                        <small>(*)</small>
                </label>
            </span>
            <div class="radio">
                <label style="color: #0d3625;">
                    <input id="radio1" name="tipoCombustible" type="radio" value="1" style="background-color: dodgerblue;" checked>
                    Diesel &nbsp;
                </label>
                <label style="color: #0d3625;">
                    <input id="radio2" name="tipoCombustible" type="radio" value="2">
                    Regular &nbsp;
                </label>
                <label style="color: #0d3625;" >
                    <input id="radio3" name="tipoCombustible" type="radio" value="3" >
                    Especial &nbsp;
                </label>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">ev_station</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label">Número de galones
                </label>
                {!!Form::text('galones',old('galones'),['id'=>'galones','class'=>'form-control'])!!}
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">local_atm</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label">Costo de galones
                </label>
                {!!Form::text('costoGalones',old('costoGalones'),['id'=>'costoGalones','class'=>'form-control'])!!}
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="input-group ">
            <span class="input-group-addon">
                <label >Agregar a vale :
                </label>
            </span>
            <div class="checkbox">
                <label style="color: #0d3625;">
                    <input id="aceite" name="aceite" type="checkbox" data-toggle="collapse" data-target="#collapseAceite">
                    Aceite &nbsp;
                </label>
                <label style="color: #0d3625;">
                    <input id="grasa" name="grasa" type="checkbox" data-toggle="collapse" data-target="#collapseGrasa">
                    Grasa &nbsp;
                </label>
                <label style="color: #0d3625;" >
                    <input id="otros" name="otros" type="checkbox" data-toggle="collapse" data-target="#collapseOtros" >
                    Otro &nbsp;
                </label>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="col-sm-6 collapse" id="collapseAceite">
            <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">local_atm</i>
            </span>
                <div class="form-group label-floating">
                    <label class="control-label">Costo de aceite
                    </label>
                    {!!Form::text('costoAceite',old('costoAceite'),['id'=>'costoAceite','class'=>'form-control'])!!}
                </div>
            </div>
        </div>

        <div class="col-sm-6 collapse" id="collapseGrasa">
            <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">local_atm</i>
            </span>
                <div class="form-group label-floating">
                    <label class="control-label">Costo grasa
                    </label>
                    {!!Form::text('costoGrasa',old('costoGrasa'),['id'=>'costoGrasa','class'=>'form-control'])!!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 collapse" id="collapseOtros">
        <div class="col-sm-6">
            <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">ev_station</i>
            </span>
                <div class="form-group label-floating">
                    <label class="control-label">Especifique nombre
                    </label>
                    {!!Form::text('nombreOtro',old('nombreOtro'),['id'=>'nombreOtro','class'=>'form-control'])!!}
                </div>
            </div>
        </div>

        <div class="col-sm-5" >
            <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">local_atm</i>
            </span>
                <div class="form-group label-floating">
                    <label class="control-label">Costo
                    </label>
                    {!!Form::text('costoOtro',old('costoOtro'),['id'=>'costoOtro','class'=>'form-control'])!!}
                </div>
            </div>
        </div>

        <div class="col-sm-1 collapse" style="margin-top: 12px; ">
                <a class="btn btn-sm" data-toggle="collapse" href="#collapseOtrosMas" style="background: dodgerblue;" >
                  <i class="material-icons">add</i>
                </a>
        </div>
    </div>

    <div class="col-sm-12 collapse" id="collapseOtrosMas">
        <div class="col-sm-6">
            <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">ev_station</i>
            </span>
                <div class="form-group label-floating">
                    <label class="control-label">Especifique nombre
                    </label>
                    {!!Form::text('nombreOtro2',old('nombreOtro2'),['id'=>'nombreOtro2','class'=>'form-control'])!!}
                </div>
            </div>
        </div>

        <div class="col-sm-6" >
            <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">local_atm</i>
            </span>
                <div class="form-group label-floating">
                    <label class="control-label">Costo
                    </label>
                    {!!Form::text('costoOtro2',old('costoOtro2'),['id'=>'costoOtro2','class'=>'form-control', 'placeholder'=>'0.0'])!!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-4 col-sm-offset-4">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">local_atm</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label">Costo total de vale
                </label>
                {!! Form::text('costoUnitarioVale', old('costoUnitarioVale','0.0'),['id'=>'costoUnitarioVale','class'=>'form-control', 'readonly']) !!}
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

            $("#numeroVale").mask("00000");

        })
    </script>

    <script>

        $('#costoGalones').bind('keyup', function (e) {

              if ((e.keyCode>47 && e.keyCode<58) || (e.keyCode === 8 || e.keyCode === 46)) {

                  if(e.keyCode === 8 || e.keyCode === 46)
                  {
                      suma(this.value,$('#costoAceite').val(), $('#costoGrasa').val(), $('#costoOtro').val());
                  }else{
                      suma(this.value,$('#costoAceite').val(), $('#costoGrasa').val(), $('#costoOtro').val());
                  }
              }
        });

        $('#costoGalones').bind('keydown', function (e) {
            if (e.keyCode>47 && e.keyCode<58 || (e.keyCode === 8 || e.keyCode === 46))
            {
                if(e.keyCode == 8 || e.keyCode == 46)
                {
                    resta(this.value,$('#costoAceite').val(), $('#costoGrasa').val(), $('#costoOtro').val());
                }
            }
        });

        $('#costoAceite').bind('keyup', function (e) {
            if ((e.keyCode>47 && e.keyCode<58) || (e.keyCode === 8 || e.keyCode === 46)) {

                if(e.keyCode === 8 || e.keyCode === 46)
                {
                    suma(this.value,$('#costoGalones').val(), $('#costoGrasa').val(), $('#costoOtro').val());
                }else{
                    suma(this.value,$('#costoGalones').val(), $('#costoGrasa').val(), $('#costoOtro').val());
                }
            }
        });

        $('#costoAceite').bind('keydown', function (e) {
            if (e.keyCode>47 && e.keyCode<58 || (e.keyCode === 8 || e.keyCode === 46))
            {
                if(e.keyCode == 8 || e.keyCode == 46)
                {
                    resta(this.value,$('#costoGalones').val(), $('#costoGrasa').val(), $('#costoOtro').val());
                }
            }
        });

        $('#costoGrasa').bind('keyup', function (e) {
            if ((e.keyCode>47 && e.keyCode<58) || (e.keyCode === 8 || e.keyCode === 46)) {

                if(e.keyCode === 8 || e.keyCode === 46)
                {
                    suma(this.value,$('#costoGalones').val(), $('#costoAceite').val(), $('#costoOtro').val());
                }else{
                    suma(this.value,$('#costoGalones').val(), $('#costoAceite').val(), $('#costoOtro').val());
                }
            }
        });

        $('#costoGrasa').bind('keydown', function (e) {
            if (e.keyCode>47 && e.keyCode<58 || (e.keyCode === 8 || e.keyCode === 46))
            {
                if(e.keyCode == 8 || e.keyCode == 46)
                {
                    resta(this.value,$('#costoGalones').val(), $('#costoAceite').val(), $('#costoOtro').val());
                }
            }
        });

        $('#costoOtro').bind('keyup', function (e) {
            if ((e.keyCode>47 && e.keyCode<58) || (e.keyCode === 8 || e.keyCode === 46)) {

                if(e.keyCode === 8 || e.keyCode === 46)
                {
                    suma(this.value,$('#costoGalones').val(), $('#costoAceite').val(), $('#costoGrasa').val());
                }else{
                    suma(this.value,$('#costoGalones').val(), $('#costoAceite').val(), $('#costoGrasa').val());
                }
            }
        });

        $('#costoOtro').bind('keydown', function (e) {
            if (e.keyCode>47 && e.keyCode<58 || (e.keyCode === 8 || e.keyCode === 46))
            {
                if(e.keyCode == 8 || e.keyCode == 46)
                {
                    resta(this.value,$('#costoGalones').val(), $('#costoAceite').val(), $('#costoGrasa').val());
                }
            }
        });

        function suma(monto, val1, val2, val3) {

            var valInicial1 = parseFloat( val1 );
            var valInicial2 = parseFloat( val2 );
            var valInicial3 = parseFloat( val3 );
            var monto= parseFloat(monto);

            if(isNaN(monto)){
               monto=0.0;
           }

            if(isNaN(valInicial1)){
                valInicial1=0.0;
            }

            if(isNaN(valInicial2)){
                valInicial2=0.0;
            }

            if(isNaN(valInicial3)){
                valInicial3=0.0;
            }

            var t= monto  + valInicial1 + valInicial2 +  valInicial3;

            total(t);
        }

        function resta(monto, val1, val2, val3) {

            var valInicial1 = parseFloat( val1 );
            var valInicial2 = parseFloat( val2 );
            var valInicial3 = parseFloat( val3 );
            var monto= parseFloat(monto);

            if(isNaN(monto)){
                monto=0.0;
            }
            if(isNaN(valInicial1)){
                valInicial1=0.0;
            }

            if(isNaN(valInicial2)){
                valInicial2=0.0;
            }

            if(isNaN(valInicial3)){
                valInicial3=0.0;
            }

            var a= [monto,valInicial1,valInicial2,valInicial3];
            a.sort((a,b)=>a-b);

            var b=a[3];

            for (var i = (a.length-1); i > 0; i--) {
                if(b>a[i-1]){
                    b=b-a[i-1];
                }else {
                    b=a[i-1]-b;
                }
            }

          total(b);

        }

        function total(monto) {
            var campo = $('#costoUnitarioVale');
            campo.val(monto);
        }
    </script>

@endsection


