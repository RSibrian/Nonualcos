@extends ('plantilla')
        @section('plantilla')
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="green">
                            <i class="material-icons">create</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Vales -
                                <small class="category">Liquidar Vales</small>
                            </h4>

                            <br>

                            {!! Form::open(['route'=>'vales.guardarLiquidacion','method'=>'POST','enctype'=>'multipart/form-data']) !!}
                            {{ csrf_field(),
                               date_default_timezone_set('America/El_Salvador')}}

                            <fieldset style="border: 1px solid #ccc; padding: 10px">
                                <legend><small>Datos de Liquidación</small></legend>

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
                                <legend><small>Vales a liquidar</small></legend>

                                <div class="form-row col-xs-12">
                                    @include('vales.tablaLiquidacion', compact('_liquidar'))
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
                            <div align="center">
                                {!! Form::submit('Registrar',['class'=>'btn  btn-verde glyphicon glyphicon-floppy-disk']) !!}
                                {!! Form::reset('Limpiar',['class'=>'btn btn-danger glyphicon']) !!}
                                <a href="{{ url()->previous() }}" class="btn btn-info"  name="btnRegresar"> Regresar</a>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
@stop
