@extends ('plantilla')
@section('plantilla')
    <div class="row">
        <div class="col-sm-offset-1  col-md-10">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="orange">
                    <i class="material-icons">featured_play_list</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Vales -
                        <small class="category">Modificar de Vale</small>
                    </h4>
                    {!!Form::model($vale,['method'=>'PUT','route'=>['vales.update',$vale->id] , 'autocomplete'=>'off'])!!}
                    <input type="hidden" name="vale[id]" value="{{ $vale->id }}">
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
                    @include('vales.formEdit')
                    <div align="center">
                        {!! Form::submit('Registrar',['class'=>'btn  btn-verde glyphicon glyphicon-floppy-disk '.$disabled] ) !!}
                        <a href="{{ url()->previous() }}" class='btn btn-ocre '>Regresar</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop