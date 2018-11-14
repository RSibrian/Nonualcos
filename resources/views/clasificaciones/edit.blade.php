@extends ('plantilla')
@section('plantilla')
	<div class="row">
	    <div class="col-sm-offset-1 col-md-10">
	        <div class="card">
	            <div class="card-header card-header-icon" data-background-color="orange">
	                <i class="material-icons">work</i>
	            </div>
	            <div class="card-content">
	                <h4 class="card-title">Clasificacion -
	                    <small class="category">Modificar de Clasificacion</small>
	                </h4>
                     {!!Form::model($clasificacionesActivos,['method'=>'PUT','route'=>['clasificaciones.update',$clasificacionesActivos->id]])!!}
                    <input type="hidden" name="clasificacionesActivos[id]" value="{{ $clasificacionesActivos->id }}">
                        @include('clasificaciones.form')
	  					<div align="center">
  						{!! Form::submit('Registrar',['class'=>'btn btn-verde glyphicon glyphicon-floppy-disk']) !!}
							<a href="{{ URL::previous() }}" class='btn btn-ocre '>Regresar</a>
							</div>
					{!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@stop
