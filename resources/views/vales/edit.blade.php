@extends ('plantilla')
@section('plantilla')
    <div class="row">
        <div class="col-sm-offset-1  col-md-10">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="orange">
                    <i class="material-icons">perm_identity</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Vales -
                        <small class="category">Modificar de Vale</small>
                    </h4>
                    {!!Form::model($vale,['method'=>'PUT','route'=>['vales.update',$vale->id]])!!}
                    <input type="hidden" name="vale[id]" value="{{ $vale->id }}">
                    @include('vales.formEdit')
                    <div align="center">
                        {!! Form::submit('Modificar',['class'=>'btn btn-verde glyphicon glyphicon-floppy-disk']) !!}
                        <a href="{{ url()->previous() }}" class='btn btn-ocre '>Regresar</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop