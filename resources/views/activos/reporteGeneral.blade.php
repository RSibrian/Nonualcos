<?php $title="Activos"?>
@extends ('reporte.plantillaHorizontal')
@section('reporte')
	<br><div style="position: absolute;left: 280px; top: -20px; z-index: 1;"><h3>TOMA FISICA DE INVENTARIO DE MOBILIARIO Y EQUIPO</h3></div>
	<table class="table-wrapper" >
		<thead>
		<tr>
			<th>#</th>
			<th>Código Inventario</th>
			<th>Artículo</th>
			<th>Marca</th>
			<th>Modelo</th>
			<th>Color</th>
			<th>Serie</th>
			<th>Estado</th>
			<th>Valor</th>
		</tr>
		</thead>
		<tbody>
        <?php $count=0;?>
		@foreach($activos as $activo)
		<tr>
            <?php $count++;?>
			<td>{{$count}}</td>
			<td>{{$activo->codigoInventario}}</td>
			<td>{{$activo->nombreActivo}}</td>
			<td>{{$activo->marca}}</td>
			<td>{{$activo->modelo}}</td>
			<td>{{$activo->color}}</td>
			<td>{{$activo->serie}}</td>
			@if($activo->estadoActivo==0)
				<td>{{'Desactivado'}}</td>
			@elseif($activo->estadoActivo==1)
				<td>{{'Bueno'}}</td>
			@else
				<td>{{'Dañado'}}</td>
			@endif
			<td>{{'$ '.$activo->precio}}</td>
		</tr>

		@endforeach
		</tbody>
	</table>
@stop
