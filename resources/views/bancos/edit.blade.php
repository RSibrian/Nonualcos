@extends ('plantilla')
@section('plantilla')
	<div class="row">
	     <div class="col-sm-offset-1 col-md-10">
	        <div class="card">
	            <div class="card-header card-header-icon" data-background-color="blue">
	                <i class="material-icons">perm_identity</i>
	            </div>
	            <div class="card-content">
	                <h4 class="card-title">Bancos -
	                    <small class="category">Modificar de Banco</small>
	                </h4>
                     {!!Form::model($banco,['method'=>'PUT','route'=>['bancos.update',$banco->id]])!!}
                    <!--input type="hidden" name="cargo[id]" value="{{ $banco->id }}"-->
                        @include('bancos.form')
	  					<div align="center">
  						{!! Form::submit('Registrar',['class'=>'btn btn-verde glyphicon glyphicon-floppy-disk']) !!}
							{!! Form::reset('Limpiar',['class'=>'btn btn-azul']) !!}
							<a href="{{ URL::previous() }}" class='btn btn-ocre '>Regresar</a>
	  					</div>
					{!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@stop
