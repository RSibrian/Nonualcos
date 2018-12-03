<?php $title="Usuarios"?>
@extends ('reporte.plantillaVertical')
@section('reporte')
	<br><div style="position: absolute;left: 280px; top: -20px; z-index: 1;"><h3>Consolidado de Usuarios</h3></div>
	<table >
		<thead>
			<tr>
				<th>#</th>
				<th>Nombre</th>
				<th>Empleado</th>
				<th>Correo</th>
			</tr>
		</thead>
		<tbody>
		<?php $cont=0;?>
		@foreach ($users as $u)
			<tr>
                <?php $cont++;?>
				<td>{{$cont}}</td>
				<td>{{$u->name}}</td>
				<td>{{$u->idEmpleado? $u->empleado->nombresEmpleado.' '.$u->empleado->apellidosEmpleado : "No consignado"}}</td>
				<td>{{$u->email}}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@stop