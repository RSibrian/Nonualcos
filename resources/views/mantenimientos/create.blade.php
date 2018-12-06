@extends ('plantilla')
@section('plantilla')
<div class="row">
  <div class="col-sm-offset-1 col-md-10">
    <div class="card">
      <div class="card-header card-header-icon" data-background-color="green">
        <i class="material-icons ml-auto">perm_identity</i>
      </div>
      <div class="card-content">
        <h4 class="card-title">Mantenimientos -
          <small class="category">Registro de Mantenimiento de Activo</small>
        </h4>

        {!! Form::open(['route'=>'mantenimientos.store','method'=>'POST','autocomplete'=>'off', 'novalidate']) !!}
        {{ csrf_field() }}
        @include('mantenimientos.form')
        <div align="center" class="row">
          {!! Form::submit('Registrar',['class'=>'btn  btn-verde glyphicon glyphicon-floppy-disk']) !!}
          {!! Form::reset('Limpiar',['class'=>'btn btn-azul']) !!}
          <a href="{{ URL::previous() }}" class='btn btn-ocre '>Regresar</a>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@stop
