
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
	                <h4 class="card-title">Roles -
	                    <small class="category">Registro de Roles</small>
	                </h4>

					{!! Form::open(['route'=>'roles.store','method'=>'POST','autocomplete'=>'off']) !!}
                        {{ csrf_field() }}
	  					@include('roles.form')
	  					<div align="center" class="row">
							{!! Form::submit('Registrar',['id'=>"agregar_permiso", "onclick"=>"myFunction()" ,'class'=>'btn btn-verde glyphicon glyphicon-floppy-disk']) !!}
							{!! Form::reset('Cancelar',['class'=>'btn btn-danger']) !!}
	  					</div>
					{!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
@stop
