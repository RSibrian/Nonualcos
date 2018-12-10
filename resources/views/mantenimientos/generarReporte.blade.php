@extends ('plantilla')
@section('plantilla')
	<div class="row">

	    <div class="col-sm-offset-1 col-md-12">
	        <div class="card">
	            <div class="card-header card-header-icon" data-background-color="green">
	                <i class="material-icons">store</i>
	            </div>
	            <div class="card-content">
	                <h4 class="card-title">Mantenimientos -
	                    <small class="category">Generar Reporte por fechas</small>
	                </h4>
                  <div>
                    <h4 class="card-title" align='center'>MANTENIMIENTOS REALIZADOS
  	                </h4>

                  </div>

						{!! Form::open(['route'=>'mantenimientos.reporteTiempo','method'=>'POST','autocomplete'=>'off']) !!}
          <div class="col-sm-5 row">
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">apps</i>
                  </span>
                      <label class="control-label">Fecha Inicio:
                      </label>
											{!!Form::date('fechaInicio',$fechaInicio,['id'=>'fechaInicio','class'=>'form-control datepicker'])!!}
              </div>
          </div>

					<div class="col-sm-5 row">
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">apps</i>
                  </span>
                      <label class="control-label">Fecha Final:
                      </label>
											{!!Form::date('fechaFinal',$fechaFinal,['id'=>'fechaFinal','class'=>'form-control datepicker'])!!}
              </div>
          </div>

	  			<div  class="col-sm-10 row" align="center">
              {!! Form::submit('Reporte',['class'=>'btn  btn-verde glyphicon glyphicon-floppy-disk']) !!}
							<a href="{{ URL::previous() }}" class='btn btn-ocre '>Regresar</a>
	  			</div>
					{!! Form::close() !!}
                </div>
            </div>
        </div>

@stop
