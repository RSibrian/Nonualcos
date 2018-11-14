@extends ('plantilla')
@section('plantilla')
	<div class="row">
	    <div class="col-sm-offset-1  col-md-10">
	        <div class="card">
	            <div class="card-header card-header-icon" data-background-color="orange">
	                <i class="material-icons">perm_identity</i>
	            </div>
	            <div class="card-content">
	                <h4 class="card-title">Unidad -
	                    <small class="category">Modificar de Unidad</small>
	                </h4>
                     {!!Form::model($unidad,['method'=>'PUT','route'=>['unidades.update',$unidad->id]])!!}
                    <input type="hidden" name="unidad[id]" value="{{ $unidad->id }}">
                        @include('unidades.form')
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
