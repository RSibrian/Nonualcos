@extends ('plantilla')
@section('plantilla')
	<div class="row">

	    <div class=" col-md-10 col-sm-offset-1">
	        <div class="card">
	            <div class="card-header card-header-icon" data-background-color="green">
	                <i class="material-icons">store</i>
	            </div>
	            <div class="card-content">
	                <h4 class="card-title">Préstamo -
	                    <small class="category">Generar Reporte de Préstamo por Fecha</small>
	                </h4>
                  <h6 class="campoObligatorio">Los campos con ( * ) son obligatorios</h6>
                  <h4 class="card-title" align='center'>Seleccione el rango de fecha
                  </h4>

						{!! Form::open(['route'=>'prestamos.reportePrestamo',"target"=>"_blank",'method'=>'POST','autocomplete'=>'off']) !!}
            <div class="col-sm-10 ">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">date_range</i>
                    </span>
                    <div class="form-group label-floating">
                        <label class="control-label"><code>*</code>Fecha Inicio
                        </label>
                        {!!Form::date('fechaInicio',$date,['id'=>'fechaInicio','class'=>'form-control datepicker'])!!}

                    </div>
                </div>
            </div>

            <div class="col-sm-10 ">
                <div class="input-group">
                      <span class="input-group-addon">
                          <i class="material-icons">date_range</i>
                      </span>
                    <div class="form-group label-floating">
                        <label class="control-label "><code>*</code>Fecha Fin
                        </label>
                        {!!Form::date('fechaFin',$date1,['id'=>'fechaFin','class'=>'form-control datepicker'])!!}

                    </div>
                </div>
            </div>







	  			<div  class="col-sm-10 row" align="center">

              {!! Form::submit('Reporte',[ 'class'=>'btn  btn-verde glyphicon glyphicon-floppy-disk']) !!}
							<a href="{{ URL::previous() }}" class='btn btn-ocre '>Regresar</a>
	  			</div>
					{!! Form::close() !!}
                </div>
            </div>
        </div>

@stop
