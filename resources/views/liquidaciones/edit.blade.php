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
                        <small class="category">Modificación de liquidación</small>
                    </h4>
                    {!!Form::model($liquidacion,['method'=>'PUT','route'=>['liquidaciones.update',$liquidacion->id , 'autocomplete'=>'off']])!!}
                    <input type="hidden" name="liquidacion[id]" value="{{ $liquidacion->id }}">
                    <?php date_default_timezone_set('America/El_Salvador');?>
                    @include('liquidaciones.formEdit', compact('vales'))
                    <div align="center">
                        {!! Form::submit('Modificar',['class'=>'btn btn-verde glyphicon glyphicon-floppy-disk']) !!}
                        <a href="{{ route('liquidaciones.index') }}" class='btn btn-ocre '>Regresar</a>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>

@stop

