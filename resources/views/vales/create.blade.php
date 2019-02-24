@extends ('plantilla')
@section('plantilla')
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="green">
                            <i class="material-icons">featured_play_list</i>
                </div>

                <div class="card-content">
                    <h4 class="card-title">Vales -
                        <small class="category">Registro de Vale</small>
                    </h4>

                    {!! Form::open(['route'=>'vales.store','method'=>'POST','enctype'=>'multipart/form-data', 'autocomplete'=>'off']) !!}
                    {{ csrf_field(),
                       date_default_timezone_set('America/El_Salvador')}}
                    @php
                        $disabled='';
                    @endphp
                    @foreach (['autoriza', 'vehiculos', 'empleados'] as $key)
                        @if(Session::has($key))
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{{ Session::get($key) }}</li>
                                </ul>
                            </div>
                            @php
                             $disabled='hide';
                            @endphp
                        @endif
                    @endforeach
                        @include('vales.form')
                        <div align="center">
                            {!! Form::submit('Registrar',['class'=>'btn  btn-verde glyphicon glyphicon-floppy-disk '.$disabled] ) !!}
                            {!! Form::reset('Limpiar',['class'=>'btn btn-azul glyphicon '.$disabled] ) !!}
                            <a href="{{ url()->previous() }}" class="btn btn-ocre"  name="btnRegresar"> Regresar</a>
                        </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
        <div class="col-md-1"></div>
@stop
