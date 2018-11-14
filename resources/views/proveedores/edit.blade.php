@extends ('plantilla')
@section('plantilla')
	<div class="row">
		 <div class="col-md-1"></div>
	    <div class="col-md-10">
	        <div class="card">
	            <div class="card-header card-header-icon" data-background-color="orange">
	                <i class="material-icons">store</i>
	            </div>
	            <div class="card-content">
	                <h4 class="card-title">Proveedores -
	                    <small class="category">Modificar Proveedor</small>
	                </h4>
                     {!!Form::model($prov,['method'=>'PUT','route'=>['proveedores.update',$prov->id]])!!}
                        <input type="hidden" name="prov[id]" value="{{ $prov->id }}">
	  					@include('proveedores.form')
	  					<div align="center">
  						{!! Form::submit('Modificar',['class'=>'btn btn-verde glyphicon glyphicon-floppy-disk']) !!}
							<a href="{{ URL::previous() }}" class='btn btn-ocre '>Regresar</a>
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
