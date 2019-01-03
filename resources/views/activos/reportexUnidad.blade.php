

<?php $title='Reporte de Activos por Unidad '.$unidad->nombreUnidad.$date;?>
@extends ('reporte.plantillaHorizontal')
@section('reporte')
	<style>
		.gris {
			background: rgba(192,192,192,0.1);
		}
    .blanco {
			background: rgb(255,255,255);
		}
	</style>
	<br><div style="text-align: center;"><h3>INVENTARIO DE MOBILIARIO Y EQUIPO</h3></div>
	<br><div style="text-align: center;"><h3>Unidad : {{$unidad->nombreUnidad}}</h3></div>

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
				<script type="text/php">
				    if ( isset($pdf) ) {
				    $pdf->page_script('
				        if ($PAGE_COUNT >= 1) {
				            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
				            $size = 10;
				            $pageText = "Página: " . $PAGE_NUM . " de " . $PAGE_COUNT;
				            $y = 555;
				            $x = 680;
				            $pdf->text($x, $y, $pageText, $font, $size);


				        }
				    ');
				}
				</script>
	@stop
