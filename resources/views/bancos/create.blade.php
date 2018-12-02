
@extends ('plantilla')
@section('plantilla')
    <div class="row">
	    <div class="col-md-8">
	        <div class="card">

	            <div class="card-header card-header-icon" data-background-color="ocre">
	                <i class="material-icons">perm_identity</i>
	            </div>
	            <div class="card-content">
	                <h4 class="card-title">Bancos -
	                    <small class="category">Registro de un Banco</small>
	                </h4>

					{!! Form::open(['route'=>'bancos.store','method'=>'POST','autocomplete'=>'off']) !!}
                        {{ csrf_field() }}
	  					@include('bancos.form')
	  					<div align="center" class="row">
  						    {!! Form::submit('Registrar',['class'=>'btn btn-verde glyphicon glyphicon-floppy-disk']) !!}
	  					    {!! Form::reset('Limpiar',['class'=>'btn btn-azul']) !!}
	  					</div>
					{!! Form::close() !!}
                </div>
            </div>
        </div>

                    </div>
@stop
