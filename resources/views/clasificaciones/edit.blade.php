@extends ('plantilla')
@section('plantilla')
	<div class="row">
	    <div class="col-sm-offset-1 col-md-10">
	        <div class="card">
	            <div class="card-header card-header-icon" data-background-color="orange">
	                <i class="material-icons">work</i>
	            </div>
	            <div class="card-content">
	                <h4 class="card-title">Clasificación -
	                    <small class="category">Modificar </small>
	                </h4>
                     {!!Form::model($clasificacionesActivos,['method'=>'PUT','route'=>['clasificaciones.update',$clasificacionesActivos->id]])!!}
                    <input type="hidden" name="clasificacionesActivos[id]" value="{{ $clasificacionesActivos->id }}">
                        @include('clasificaciones.form')
	  					<div align="center">
  						{!! Form::submit('Actualizar',['class'=>'btn btn-verde glyphicon glyphicon-floppy-disk']) !!}
							<a href="{{ route('clasificaciones.index') }}" class='btn btn-ocre '>Regresar</a>
							</div>
					{!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@stop
