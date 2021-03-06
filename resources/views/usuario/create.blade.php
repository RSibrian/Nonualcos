@extends ('plantilla')
@section('plantilla')
	<div class="row">
		<div class="col-md-1"></div>
	    <div class="col-md-10">
	        <div class="card">
	            <div class="card-header card-header-icon" data-background-color="green">
	                <i class="material-icons">perm_identity</i>
	            </div>
	            <div class="card-content">
	                <h4 class="card-title">Usuario -
	                    <small class="category">Registro de Usuarios</small>
	                </h4>
					{!! Form::open(['route'=>'users.store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
	  					@include('usuario.form')
	  					<div align="center">
								{!! Form::submit('Registrar',['class'=>'btn  btn-verde glyphicon glyphicon-floppy-disk']) !!}
								 {!! Form::reset('Limpiar',['class'=>'btn btn-azul']) !!}
								<a href="{{ route('users.index') }}" class='btn btn-ocre '>Regresar</a>
	  					</div>
					{!! Form::close() !!}
                </div>
            </div>
        </div>
    <div class="col-md-1"></div>
@stop
