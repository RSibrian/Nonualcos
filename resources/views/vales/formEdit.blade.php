<h6 class="campoObligatorio">los campos con ( * ) son obligatorios</h6>
<br>
@if ($salida->destinoTrasladarse=="")
    <div class="col-sm-12">
        <div class="input-group ">
            <span class="input-group-addon">
                <label >Completar salida? :</label>
            </span>
            <div class="radio">
                <label style="color: #0d3625;">
                    <input id="radio1" name="radiosalida" type="radio" value="1" style="background-color: dodgerblue;">
                    Si &nbsp;
                </label>
                <label style="color: #0d3625;">
                    <input id="radio2" name="radiosalida" type="radio" value="2" checked>
                    No
                </label>
            </div>
        </div>
    </div>
@endif
<fieldset style="border: 1px solid #ccc; padding: 10px" @if ($salida->destinoTrasladarse=="") class="collapse" @endif id="frmSalida">
    <legend><small>Datos de salida</small></legend>

    <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">date_range</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"> <code>*</code>Fecha de salida</label>
                {!! Form::hidden('bandera', $esAdmin, ['id' => 'bandera']) !!}
                {!!Form::date('fechaSalida',old('fechaSalida', $salida->fechaSalida),['id'=>'fechaSalida','class'=>'form-control'])!!}
            </div>
        </div>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">directions_car</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label" for="numeroPlaca"><code>*</code>Vehículo
                </label>
                {!! Form::select('numeroPlaca', $placas , $vehiculo->id, ['id'=>'numeroPlaca','class'=>'form-control']) !!}
            </div>
        </div>

    </div>

    <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">place</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Destino
                </label>
                {!!Form::text('destinoTrasladarse',old('destinoTrasladarse', $salida->destinoTrasladarse),['id'=>'destinoTrasladarse','class'=>'form-control'])!!}
            </div>
        </div>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">face</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Solicitante
                </label>
                @if ($esAdmin)
                    {!!Form::select('solicitante',$empleados,  $salida->idEmpleado ,['id'=>'solicitante','class'=>'form-control'])!!}
                @else
                    {!!Form::select('solicitante',$empleados, $autoriza->idEmpleado ,['id'=>'solicitante','class'=>'form-control'])!!}
                @endif
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons"></i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Lugar de salida</label>
                {!!Form::text('lugarSalida',old('LugarSalida', $salida->lugarSalida),['id'=>'LugarSalida','class'=>'form-control'])!!}
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons"></i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Combustible recibido (gls)</label>
                {!!Form::number('crecibidogls',old('crecibidogls', $salida->crecibidogls),['id'=>'crecibidogls','class'=>'form-control', 'step'=>'any', 'min'=>'0', 'max'=>'100'])!!}
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons"></i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Hora Salida</label>
                {!!Form::time('hsalida',old('hsalida', $salida->hsalida),['id'=>'hsalida','class'=>'form-control'])!!}
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons"></i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Kilometraje Salida</label>
                {!!Form::number('ksalida',old('ksalida', $salida->ksalida),['id'=>'ksalida','class'=>'form-control', 'step'=>'any', 'min'=>'0'])!!}
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons"></i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Hora llegada</label>
                {!!Form::time('hllegada',old('hllegada', $salida->hllegada),['id'=>'hllegada','class'=>'form-control'])!!}
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons"></i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Kilometraje llegada</label>
                {!!Form::number('kllegada',old('kllegada', $salida->kllegada),['id'=>'kllegada','class'=>'form-control', 'step'=>'any', 'min'=>'0'])!!}
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons"></i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Misión</label>
                {!!Form::textarea('mision',old('mision', $salida->mision),['id'=>'mision','class'=>'form-control','rows'=>'3'])!!}
            </div>
        </div>
    </div>
</fieldset>
<br>
@if ($vale->costoUnitarioVale==0)
    <div class="col-sm-12">
        <div class="input-group ">
            <span class="input-group-addon">
                <label >Extender vale? :
                </label>
            </span>
            <div class="radio">
                <label style="color: #0d3625;">
                    <input id="radio3" name="radiovale" type="radio" value="1" style="background-color: dodgerblue;">
                    Si &nbsp;
                </label>
                <label style="color: #0d3625;">
                    <input id="radio4" name="radiovale" type="radio" value="2" checked>
                    No
                </label>
            </div>
        </div>
    </div>
@endif
<fieldset style="border: 1px solid #ccc; padding: 10px" @if ($vale->costoUnitarioVale==0) class="collapse" @endif id="frmVale">
    <legend><small>Datos de Vale</small></legend>

    <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">date_range</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Fecha de Vale
                </label>
                {!!Form::date('fechaCreacion', old('fechaCreacion') ,['id'=>'fechaCreacion','class'=>'form-control'])!!}
            </div>
        </div>
    </div>

    @if ($esAdmin)
        <div class="col-sm-6">
            <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">vpn_key</i>
            </span>
                <div class="form-group label-floating">
                    <label class="control-label" id="muestra"><code>*</code>Número de vale
                    </label>
                    @php
                     $readonly='';
                        if(($vale->numeroVale)!=null){
                          $readonly='readonly';
                        }
                    @endphp
                    {!!Form::text('numeroVale',old('numeroVale'),['id'=>'numeroVale','class'=>'form-control', $readonly ])!!}
                </div>
            </div>
        </div>
    @endif

    @if ($salida->destinoTrasladarse=="")
        <div class="col-sm-6" id="vehiculovale">
            <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">directions_car</i>
            </span>
                <div class="form-group label-floating">
                    <label class="control-label" for="numeroPlaca"><code>*</code>Vehículo
                    </label>
                    {!! Form::select('numeroPlaca2', $placas , $salida->idVehiculo , ['id'=>'numeroPlaca2','class'=>'form-control']) !!}
                </div>
            </div>
        </div>
    @endif

    <div @if ($salida->destinoTrasladarse=="") class="col-sm-6" @else class="col-sm-12" @endif>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">ev_station</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Gasolinera
                </label>
                {!!Form::text('gasolinera',old('gasolinera'),['id'=>'gasolinera','class'=>'form-control', 'step'=>'any', 'min'=>'0'])!!}
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="input-group ">
            <span class="input-group-addon">
                <label ><code>*</code>Tipo de combustible
                </label>
            </span>
            <div class="radio">
                <label style="color: #0d3625;">
                    <input id="radio1" name="tipoCombustible" type="radio" value="1" style="background-color: dodgerblue;"
                           @if($vale->tipoCombustible==1)
                           checked
                            @endif
                    >
                    Diesel &nbsp;
                </label>
                <label style="color: #0d3625;">
                    <input id="radio2" name="tipoCombustible" type="radio" value="2"
                           @if($vale->tipoCombustible==2)
                           checked
                            @endif
                    >
                    Regular &nbsp;
                </label>
                <label style="color: #0d3625;" >
                    <input id="radio3" name="tipoCombustible" type="radio" value="3"
                           @if($vale->tipoCombustible==3)
                           checked
                            @endif
                    >
                    Especial &nbsp;
                </label>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">ev_station</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Número de galones</label>
                {!!Form::number('galones',\Helper::dinero($vale->galones),['id'=>'galones','class'=>'form-control', 'step'=>'any', 'min'=>'0'])!!}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">local_atm</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Costo por galón</label>
                {!!Form::number('costoGalones',\Helper::dinero($vale->costoGalones),['id'=>'costoGalones','class'=>'form-control', 'step'=>'any', 'min'=>'0'])!!}
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">local_atm</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Costo total galones</label>
                {!!Form::text('costoTotalGalones',\Helper::dinero(($vale->galones)*($vale->costoGalones)),['id'=>'costoTotalGalones','class'=>'form-control', 'readonly'])!!}
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
                    <input type="hidden" id="Maceite" value="{{ $vale->aceite }}" >
                    <input id="aceite" name="aceite" type="checkbox" data-toggle="collapse" data-target="#collapseAceite">
                    Aceite &nbsp;
                </label>
                <label style="color: #0d3625;">
                    <input type="hidden" id="Mgrasa" value="{{ $vale->grasa }}" >
                    <input id="grasa" name="grasa" type="checkbox" data-toggle="collapse" data-target="#collapseGrasa">
                    Grasa &nbsp;
                </label>
                <label style="color: #0d3625;" >
                    <input type="hidden" id="Motros" value="{{ $vale->otro }}" >
                    <input id="otros" name="otros" type="checkbox" data-toggle="collapse" data-target="#collapseOtros">
                    Otro &nbsp;
                </label>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="col-sm-6 collapse " id="collapseAceite">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">local_atm</i>
            </span>
                <div class="form-group label-floating">
                    <label class="control-label"><code>*</code>Costo total aceite
                    </label>
                    @php
                    $aceite=\Helper::dinero($vale->costoAceite);
                      if ($aceite==0.00){
                          $aceite='';
                      }
                    @endphp
                    {!!Form::number('costoAceite',$aceite,['id'=>'costoAceite','class'=>'form-control', 'step'=>'any', 'min'=>'0'])!!}
                </div>
            </div>
        </div>

        <div class="col-sm-6 collapse" id="collapseGrasa">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">local_atm</i>
            </span>
                <div class="form-group label-floating">
                    <label class="control-label"><code>*</code>Costo total grasa
                    </label>
                    @php
                        $grasa=\Helper::dinero($vale->costoGrasa);
                          if ($grasa==0.00){
                              $grasa='';
                          }
                    @endphp
                    {!!Form::number('costoGrasa',$grasa,['id'=>'costoGrasa','class'=>'form-control', 'step'=>'any', 'min'=>'0'])!!}
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
                    {!!Form::text('nombreOtro',$vale->otro,['id'=>'nombreOtro','class'=>'form-control'])!!}
                </div>
            </div>
        </div>

        <div class="col-sm-6" >
            <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">local_atm</i>
            </span>
                <div class="form-group label-floating">
                    <label class="control-label"><code>*</code>Costo total otro
                    </label>
                    {!!Form::number('costoOtro',\Helper::dinero($vale->costoOtro),['id'=>'costoOtro','class'=>'form-control', 'step'=>'any', 'min'=>'0'])!!}
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
                <label class="control-label"><code>*</code>Costo total de vale
                </label>
                {!! Form::text('costoUnitarioVale', \Helper::dinero($vale->costoUnitarioVale) ,['id'=>'costoUnitarioVale','class'=>'form-control', 'readonly']) !!}
            </div>
        </div>
    </div>
</fieldset>
<br>

@if ($esAdmin)
<fieldset style="border: 1px solid #ccc; padding: 10px">
    <legend><small>Datos de entrega</small></legend>

    <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">face</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Empleado autoriza</label>
                {!! Form::select('empAutoriza',$administradores, $autoriza->idEmpleado,['id'=>'empAutoriza','class'=>'form-control datepicker'])!!}
            </div>
        </div>

        @php
            $estado='';
        @endphp

        <div class="input-group col-sm-offset-1">
            <div class="form-group ">
                <label><code>*</code> Estado de entrega:</label>
                @if($vale->estadoEntregadoVal==1)
                    <b class="text-success">{{ 'Entregado' }}</b>
                @else
                    <label class="switch">
                        <input type="checkbox" name="estadoEntregadoVal" id="estadoEntregadoVal">
                        <span class="slider"></span>
                    </label>
                    @php
                        $estado='disabled';
                    @endphp
                @endif

            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">face</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code>Empleado recibe
                </label>
                {!!Form::select('empRecibe',$empleados, $vale->empleadoRecibeVal ,['id'=>'empRecibe','class'=>'form-control'])!!}
            </div>
        </div>

        <div class="input-group col-sm-offset-1">
            <div class="form-group">
                <label> <code>*</code>Estado de devolución:</label>
                @if($vale->estadoRecibidoVal==1)
                    <b class="text-success">{{ 'Devuelto' }}</b>
                @else
                    <label class="switch">
                        <input type="checkbox" name="estadoRecibidoVal" id="estadoRecibidoVal" {{$estado}}>
                        <span class="slider"></span>
                    </label>
                @endif
            </div>
        </div>

    </div>
</fieldset>
@endif
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

    {!!Html::script('js/jquery.mask.min.js')!!}
    {!!Html::script('js/vale.js')!!}
    {!!Html::script('js/ValeModificar.js')  !!}

    <script>
        $(function () {
            var destinos = "{{ route('autocompleteDestinos') }}";

            $('#destinoTrasladarse').autocomplete({
                source: destinos
            });

        });

        $(function () {
            var gasolinera = "{{ route('autocompleteGasolinera') }}";

            $('#gasolinera').autocomplete({
                source: gasolinera
            });

        });

        $(function () {
            var gasolinera = "{{ route('autocompletetipoCombustible') }}";

            $('#tipoCombustible').autocomplete({
                source: gasolinera
            });

        });


        $("input[name='radiosalida']").on('click', function () {
            if ($(this).val()==1){
                $("#frmSalida").removeClass('collapse');
                $("#vehiculovale").addClass( "collapse");
                $("#gasolineravale").removeClass('col-sm-6').addClass('col-sm-12');
            }else{
                $('#radio3').click();
                $("#frmSalida").addClass( "collapse" );
                $("#vehiculovale").removeClass('collapse');
                $("#gasolineravale").removeClass('col-sm-12').addClass('col-sm-6');
            }
        });

        $("input[name='radiovale']").on('click', function () {
            if (($(this).val())==1){
                $("#frmVale").removeClass('collapse');
                $("#vehiculovale").addClass( "collapse");
                $("#gasolineravale").removeClass('col-sm-6').addClass('col-sm-12');
            }else{
                $("#vehiculovale").removeClass('collapse');
                $("#gasolineravale").removeClass('col-sm-12').addClass('col-sm-6');
                $("#frmVale").addClass( "collapse" );
                $("#vehiculovale").addClass( "collapse");
                $("#gasolineravale").removeClass('col-sm-6').addClass('col-sm-12');
                $('#radio1').click();
            }
        });

    </script>
@endsection