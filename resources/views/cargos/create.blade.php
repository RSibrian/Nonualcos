
@extends ('plantilla')
@section('plantilla')
    <div class="row">
	    <div class="col-sm-offset-1 col-md-10">
	        <div class="card">

	            <div class="card-header card-header-icon" data-background-color="verde">
	                <i class="material-icons">perm_identity</i>
	            </div>
	            <div class="card-content">
	                <h4 class="card-title">Cargos -
	                    <small class="category">Registro de un Cargo</small>
	                </h4>

					{!! Form::open(['route'=>'cargos.store','method'=>'POST','autocomplete'=>'off']) !!}
                        {{ csrf_field() }}
	  					@include('cargos.form')
	  					<div align="center" class="row">
  						    {!! Form::submit('Registrar',['class'=>'btn btn-verde glyphicon glyphicon-floppy-disk']) !!}
	  					    <a href="{{ URL::previous() }}" class='btn btn-ocre '>Regresar</a>
	  					</div>
					{!! Form::close() !!}
                </div>
            </div>
        </div>

@stop
