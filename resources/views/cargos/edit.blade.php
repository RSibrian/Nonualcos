@extends ('plantilla')
@section('plantilla')
	<div class="row">
	    <div class="col-sm-offset-1 col-md-10">
	        <div class="card">
	            <div class="card-header card-header-icon" data-background-color="orange">
	                <i class="material-icons">work</i>
	            </div>
	            <div class="card-content">
	                <h4 class="card-title">Cargo -
	                    <small class="category">Modificar de Cargo</small>
	                </h4>
                     {!!Form::model($cargo,['method'=>'PUT','route'=>['cargos.update',$cargo->id]])!!}
                    <input type="hidden" name="cargo[id]" value="{{ $cargo->id }}">
                        @include('cargos.form')
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
