@extends ('plantilla')
@section('plantilla')
	<div class="row">

	    <div class=" col-md-10 col-sm-offset-1">
	        <div class="card">
	            <div class="card-header card-header-icon" data-background-color="green">
	                <i class="material-icons">store</i>
	            </div>
	            <div class="card-content">
	                <h4 class="card-title">Activos -
	                    <small class="category">Generar Reporte por Unidad</small>
	                </h4>
                  <div>
                    <h4 class="card-title" align='center'>TOMA FISICA DE INVENTARIO DE MOBILIARIO Y EQUIPO POR UNIDAD
  	                </h4>

                  </div>

						{!! Form::open(['route'=>'activos.reportexUnidad','method'=>'POST','autocomplete'=>'off']) !!}
          <div class="col-sm-8 row">
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">apps</i>
                  </span>
                  <div class="form-group label-floating">
                      <label class="control-label">
                      </label>
                    {!!Form::select('idUnidad',$unidades,null,['id'=>'idUnidad','class'=>'form-control','placeholder'=>'   seleccione una Unidad (requerido)','required'])!!}

                  </div>
              </div>
          </div>

          <div class="col-sm-4 row">
              <div class="input-group">
                  <span class="input-group-addon">
                      <i class="material-icons">apps</i>
                  </span>
                  <div class="form-group label-floating">
                      <label class="control-label">Estado de Activo:
                      </label>
                      <select name="estadoActivo" id="estadoActivo" class="form-control">
                          <option value=1>En uso</option>
                          <option value=0>De Baja</option>
                          <option value=2>Dañados</option>
                          <option value=5>Todos</option>
                      </select>
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
