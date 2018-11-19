<fieldset style="border: 1px solid #ccc; padding: 10px">
    <legend>
        <small>Datos de Liquidación</small>
    </legend>

    <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">date_range</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label">Fecha
                    <small>(*)</small>
                </label>
                {!!Form::date('fechaLiquidacion', old('fechaLiquidacion', date('Y-m-d')) ,['id'=>'fechaLiquidacion','class'=>'form-control datepicker'])!!}
            </div>
        </div>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">date_range</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label">Vehículo
                    <small>(*)</small>
                </label>
                {!! Form::select('vehiculo', array('1' => 'Seleccione una placa', '2' => 'P323-554'), '1',['id'=>'vehiculo','class'=>'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">featured_play_list</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label">No. de factura
                    <small>(*)</small>
                </label>
                {!!Form::text('nFactura', old('nFactura') ,['id'=>'nFactura','class'=>'form-control datepicker'])!!}
            </div>
        </div>
    </div>

</fieldset>

<br>
<fieldset style="border: 1px solid #ccc; padding: 10px">
    <legend>
        <small>Vales a liquidar</small>
    </legend>

    <div class="form-row col-xs-12">
        @include('liquidaciones.table', compact('_liquidar'))
    </div>

</fieldset>

<br>
<fieldset style="border: 1px solid #ccc; padding: 10px">

    <div class="col-lg-4 col-sm-offset-4">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">attach_money</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label">Total factura
                    <small>(*)</small>
                </label>
                {!!Form::text('totalFactura', old('totalFactura') ,['id'=>'totalFactura','class'=>'form-control datepicker'])!!}
            </div>
        </div>
    </div>

</fieldset>
<br>

