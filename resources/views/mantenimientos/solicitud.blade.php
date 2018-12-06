<?php $title="Mantenimiento"?>
@extends ('reporte.plantillaVertical')
@section('reporte')
	<br><div style="text-align: center; top: -20px; z-index: 1;"><h3>SOLICITUD DE MANTENIMIENTO DE ACTIVO</h3></div>
	<br>
<table border="0">
	<tr>
		<td colspan="4" CELLSPACING=10>ARTÍCULO</td>
	</tr>
<tr>
	<td width="15%"><b>Código: </b></td>
	<td width="20%">{{ $mantenimiento->activos->codigoInventario }}</td>
	<td width="15%"><b>Nombre: </b></td>
	<td>{{ $mantenimiento->activos->nombreActivo }}</td>
</tr>
<tr>
	<td><b>Clasificación: </b></td>
	<td>{{ $mantenimiento->activos->clasificacionActivo->nombreTipo }}</td>
	<td><b>Proveedor: </b></td>
	<td>{{ $mantenimiento->activos->proveedor->nombreEmpresa }}</td>
</tr>

<tr>
	<td colspan="4">DATOS DE SOLICITUD</td>
</tr>
<tr>
<td colspan="2"><b>Fecha de entrega en taller: </b></td>
<td colspan="2">{{ $mantenimiento->fechaRecepcionTaller->format('d/m/Y') }}</td>
</tr>
<tr>
<td colspan="2"><b>Personal que entrega: </b></td>
<td colspan="2">{{ $mantenimiento->empleado1->nombresEmpleado.' '.$mantenimiento->empleado1->apellidosEmpleado }}</td>
</tr>
<tr>
<td colspan="2"><b>Empresa Encargada: </b></td>
<td colspan="2">{{ $mantenimiento->proveedores->nombreEmpresa }}</td>
</tr>
</table>
<br>
<br>
<b>Mantenimiento Solicitado:</b>
<p ALIGN="justify"> {{ $mantenimiento->reparacionesSolicitadas }} </p>
@stop
