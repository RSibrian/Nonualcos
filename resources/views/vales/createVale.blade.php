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
                        <small class="category">Registro de Vale</small>
                    </h4>

                    {!! Form::open(['route'=>'vales.guardar','method'=>'POST','enctype'=>'multipart/form-data', 'autocomplete'=>'off']) !!}
                    {{ csrf_field(),
                       date_default_timezone_set('America/El_Salvador')}}

                           @include('vales.formularioVale')
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
        <div class="col-md-1"></div>
@stop
