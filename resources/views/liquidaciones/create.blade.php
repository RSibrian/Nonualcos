@extends ('plantilla')
@section('plantilla')
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="green">
                    <i class="material-icons">library_books</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Vales -
                        <small class="category">Liquidar Vales</small>
                    </h4>

                    <br>

                    {!! Form::open(['route'=>'liquidaciones.store','method'=>'POST','enctype'=>'multipart/form-data', 'autocomplete'=>'off']) !!}
                    {{ csrf_field(),
                       date_default_timezone_set('America/El_Salvador')}}

                    @php
                        $disabled='';
                    @endphp
                    @foreach ([ 'vehiculos', 'vales'] as $key)
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

                    @include('liquidaciones.form')

                    <div align="center">
                        {!! Form::submit('Registrar',['class'=>'btn  btn-verde glyphicon glyphicon-floppy-disk']) !!}
                        {!! Form::reset('Limpiar',['class'=>'btn btn-azul'.$disabled]) !!}
                        <a href="{{ route('liquidaciones.index') }}" class="btn btn-ocre" name="btnRegresar"> Regresar</a>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

