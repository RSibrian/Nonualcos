<?php use App\Activos;?>
<?php $title="Activos"?>
@extends ('reporte.plantillaHorizontal')
@section('reporte')
	<style>
		.azul{
			background: rgba(153,217,234,0.5);
		}
	</style>
	<br><div style="text-align: center;"><h3>INVENTARIO DE MOBILIARIO Y EQUIPO</h3></div>




		@foreach($unidades as $unidad)
			<?php $activos=Activos::activosReporte($unidad->id);
			 ?>

			@if(count($activos)>0)
				<table class="table-wrapper" >
					<?php $count=0;?>
					<br>
					<thead>
					<tr>
						<th colspan="9">Unidad: {{$unidad->nombreUnidad}}</th>

					</tr>

					<tr>
						<td class="azul">#</td>
						<td class="azul">Código Inventario</td>
						<td class="azul">Artículo</td>
						<td class="azul">Marca</td>
						<td class="azul">Modelo</td>
						<td class="azul">Color</td>
						<td class="azul">Serie</td>
						<td class="azul">Estado</td>
						<td class="azul">Valor</td>
					</tr>
				</thead>

				<tbody>
					@foreach($activos as $activo)
						<tr>
							<?php $count++;?>
							<td>{{$count}}</td>
							<td>{{$activo->codigoInventario?:"h"}}</td>
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
		@endif
	@endforeach
<?PHP //mostrar los activos sin asignar?>
@if(count($sinCodigoActivos)>0)
	<table class="table-wrapper" >
		<?php $count=0;?>
		<br>
		<thead>
		<tr>
			<th colspan="9">Sin Asignar</th>
		</tr>
	</thead>
	<tr>
		<td class="azul">#</td>
		<td class="azul">Código Inventario</td>
		<td class="azul">Artículo</td>
		<td class="azul">Marca</td>
		<td class="azul">Modelo</td>
		<td class="azul">Color</td>
		<td class="azul">Serie</td>
		<td class="azul">Estado</td>
		<td class="azul">Valor</td>
	</tr>

	<tbody>
		@foreach($sinCodigoActivos as $sinCodigoActivo)


					<tr>
						<?php $count++;?>
						<td>{{$count}}</td>
						<td>{{"------"}}</td>
						<td>{{$sinCodigoActivo->nombreActivo}}</td>
						<td>{{$sinCodigoActivo->marca}}</td>
						<td>{{$sinCodigoActivo->modelo}}</td>
						<td>{{$sinCodigoActivo->color}}</td>
						<td>{{$sinCodigoActivo->serie}}</td>
						@if($sinCodigoActivo->estadoActivo==0)
							<td>{{'Desactivado'}}</td>
						@elseif($sinCodigoActivo->estadoActivo==1)
							<td>{{'Bueno'}}</td>
						@else
							<td>{{'Dañado'}}</td>
						@endif
						<td>{{'$ '.$sinCodigoActivo->precio}}</td>
					</tr>

				@endforeach
		</tbody>
</table>
@endif




@stop
