
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
                <label class="control-label"> <code>*</code> Fecha </label>
                {!!Form::date('fechaLiquidacion', old('fechaLiquidacion', date('Y-m-d')) ,['id'=>'fechaLiquidacion','class'=>'form-control datepicker'])!!}
            </div>
        </div>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">drive_eta</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code> Vehículo </label>
                {!! Form::select('vehiculo', $placas, '0',['id'=>'vehiculo','class'=>'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">featured_play_list</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code> No. de factura </label>
                {!!Form::text('numeroFacturaLiquidacion', old('numeroFacturaLiquidacion') ,['id'=>'nFactura','class'=>'form-control datepicker'])!!}
            </div>
        </div>
    </div>

</fieldset>

<br>
@include('liquidaciones.table')
<br>
<fieldset style="border: 1px solid #ccc; padding: 10px">

    <div class="col-lg-4 col-sm-offset-4">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">attach_money</i>
            </span>
            <div class="form-group label-floating">
                <label class="control-label"><code>*</code> Total </label>
                {!!Form::text('montoFacturaLiquidacion', old('montoFacturaLiquidacion','0.00') ,['id'=>'totalFactura','class'=>'form-control datepicker', 'readonly'])!!}
            </div>
        </div>
    </div>

</fieldset>
<br>


