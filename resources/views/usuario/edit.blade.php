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
	                <h4 class="card-title">Usuario -
	                    <small class="category">Modificar de Usuarios</small>
	                </h4>
                     {!!Form::model($user,['method'=>'PUT','route'=>['users.update',$user->id]])!!}
                        <input type="hidden" name="user[id]" value="{{ $user->id }}">
	  					@include('usuario.form')
	  					<div align="center">
								{!! Form::submit('Registrar',['class'=>'btn  btn-verde glyphicon glyphicon-floppy-disk']) !!}
								<a href="{{ route('users.index') }}" class='btn btn-ocre '>Regresar</a>
	  					</div>
					{!! Form::close() !!}
                </div>
            </div>
        </div>
         <div class="col-md-1"></div>

         </div>
    </div>
@stop
<?php
    $time=time();
    function dameFecha($fecha,$dia){
        list($year,$mon,$day)=explode('-',$fecha);
        return date('Y-m-d',mktime(0,0,0,$mon,$day+$dia,$year));
    }
   $total=0;
?>
