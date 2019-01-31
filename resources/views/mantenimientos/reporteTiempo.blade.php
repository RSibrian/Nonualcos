<?php $title="Mantenimientos Realizados"?>
@extends ('reporte.plantillaHorizontal')
@section('reporte')
	<br><div align="center" style="position: top: 170px; z-index: 1;"><h3>Mantenimientos Realizados</h3></div>
	<div align='center'  ><h3>Del: {{\Helper::fecha($fechaInicio)}} ---- Al: {{\Helper::fecha($fechaFinal)}}</h3> </div>


	<table class="table-wrapper" >
		<?php $count=0;?>
					<thead>
						<tr>
							<th>#</th>
							<th>Código Inventario</th>
							<th>Artículo</th>
							<th>Fecha en taller</th>
							<th>Empresa Encargada</th>
							<th>Personal que solicita</th>
							<th>Fecha de Recepción</th>
							<th>Personal que Recibe</th>
							<th>Costo</th>
						</tr>
					</thead>
					<tbody>

				@foreach($mantenimientos as $mantenimiento)
				<?php $count++;?>
									<tr>
											<td rowspan="2">{{$count}}</td>
											<td>{{$mantenimiento->Activos->codigoInventario}}</td>
											<td>{{$mantenimiento->Activos->nombreActivo}}</td>
											<td>{{\Helper::fecha($mantenimiento->fechaRecepcionTaller)}}</td>
											<td>{{ $mantenimiento->proveedores->nombreEmpresa }}</td>
											<td>{{ $mantenimiento->empleado1->fullName }}</td>
											<td>{{\Helper::fecha($mantenimiento->fechaRetornoTaller)}}</td>
											<td>{{ $mantenimiento->empleado2->fullName }}</td>
											<td>$ {{$mantenimiento->costoMantenimiento}}</td>
									</tr>
									<tr>
										<td colspan="2">Mantenimiento Realizado: </td>
										<td> {{ $mantenimiento->reparacionesRealizadas }}</td>
									</tr>
@endforeach
					 </tbody>

				</table>
