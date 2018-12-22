

<?php $title="Depreciación Activo"?>
@extends ('reporte.plantillaVertical')
@section('reporte')
	<style>
		.gris {
			background: rgba(192,192,192,0.1);
		}
    .blanco {
			background: rgb(255,255,255);
		}
	</style>
	<br><div style="position: absolute;left: 180px; top: -20px; z-index: 1;"><h3>TOMA FISICA DE INVENTARIO DE MOBILIARIO Y EQUIPO</h3></div>




        <div align='center'  ><h3>Unidad : {{$unidad->nombreUnidad}}</h3></div>
			  <table class="table-wrapper" align='center'>
					<thead>
						<tr>
							<th></th>
							<th>#</th>
              <th>Código Inventario</th>
							<th>Artículo</th>
							<th>Marca</th>
							<th>Modelo</th>
              <th>Color</th>
							<th>Serie</th>
              <th>Estado</th>
              <th>Precio</th>
						</tr>
					</thead>
					<tbody>
			  <?php $cont=0;?>
				@foreach ($activos as $activo)
						<tr>
							<?php $cont++; ?>
							<td></td>
							<td>{{$cont}}</td>
							<td>{{$activo->codigoInventario}}</td>
							<td>{{$activo->nombreActivo}}</td>
							<td>{{$activo->marca}}</td>
              <td>{{$activo->modelo}}</td>
              <td>{{$activo->color}}</td>
							<td>{{$activo->serie}}</td>
            @if($activo->estadoActivo==0)
              <td>{{'De Baja'}}</td>
            @elseif($activo->estadoActivo==1)
              <td>{{'En Uso'}}</td>
            @else
              <td>{{'Dañado'}}</td>
            @endif
              <td>{{'$ '.$activo->precio}}</td>
					</tr>
				@endforeach
					 </tbody>

				</table>
	@stop
