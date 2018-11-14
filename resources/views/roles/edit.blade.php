@extends ('plantilla')
@section('plantilla')
	<div class="row">
		<div class="col-md-1"></div>
	    <div class="col-md-10">
	        <div class="card">
	            <div class="card-header card-header-icon" data-background-color="orange">
	                <i class="material-icons">perm_identity</i>
	            </div>
	            <div class="card-content">
	                <h4 class="card-title">Roles -
	                    <small class="category">Modificar Rol</small>
	                </h4>
                     {!!Form::model($role,['method'=>'PUT','route'=>['roles.update',$role->id]])!!}
                    <input type="hidden" name="rol[id]" value="{{ $role->id }}">
                        @include('roles.form')
	  					<div align="center">
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
