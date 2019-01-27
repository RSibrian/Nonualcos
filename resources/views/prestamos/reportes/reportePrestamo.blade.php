<?php use App\Activos;?>
<?php $title='Reporte de Activos '.$date;?>
@extends ('reporte.plantillaHorizontal')
@section('reporte')
	<style>
		.azul{
			background: rgba(153,217,234,0.5);
		}
	</style>
    <?php $dateInicio = new DateTime($fechaInicio);
          $dateFin = new DateTime($fechaFin);
     ?>
	<br><div style="text-align: center;"><h3>Préstamos de Activo Fijo de: {{$dateInicio->format('d/m/Y')}} al: {{$dateFin->format('d/m/Y')}} </h3></div>




		@foreach($prestamos as $prestamo)
      <table class="table-wrapper" >

        <br>
        <thead>
        <tr>
          <th colspan="6">{{"Préstamo: $prestamo->nombreInstitucion"}}</th>

        </tr>

        <tr>
          <td class="azul">Evento</td>
          <td class="azul">Solicitante</td>
          <td class="azul">DUI</td>
          <td class="azul">Fecha Entrega</td>
          <td class="azul">Fecha Devolución</td>
          <td class="azul">Estado</td>
        </tr>
      </thead>
      <tbody>
        <?php $count=0;?>
      <tr>
        <td>{{$prestamo->evento}}</td>
        <td>{{$prestamo->nombreSolicitante}}</td>
        <td>{{$prestamo->DUISolicitante}}</td>
        <?php $date2 = new DateTime($prestamo->fechaEntregaPrestamo); ?>
        <td>{{$date2->format('d/m/Y')}}</td>
        <?php $date3= new DateTime($prestamo->fechaDevolucionPrestamo); ?>
        <td>{{$date3->format('d/m/Y')}}</td>
        <td>{{$prestamo->estadoPrestamo}}</td>

					<tr>
						<td colspan="6"><b>Activos del Préstamo</d></td>

					</tr>

					<tr>
						<td class="azul">#</td>
						<td class="azul">Código Inventario</td>
						<td class="azul">Artículo</td>
						<td class="azul">Marca</td>
						<td class="azul">Modelo</td>
						<td class="azul">Color</td>
					</tr>

          <?php $prestamosActivos=App\PrestamoActivo::where('prestamo_id',$prestamo->id)->get();
          //dd($prestamosActivos);
          $count=0;
          ?>

					@foreach($prestamosActivos as $prestamoActivo)
          <?php $activo=App\Activos::find($prestamoActivo->activos_id);?>
						<tr>
							<?php $count++;?>
							<td>{{$count}}</td>
							<td>{{$activo->codigoInventario}}</td>
							<td>{{$activo->nombreActivo}}</td>
							<td>{{$activo->marca}}</td>
							<td>{{$activo->modelo}}</td>
							<td>{{$activo->color}}</td>
						</tr>
					@endforeach
			</tbody>
		</table>

	@endforeach


	<script type="text/php">
	    if ( isset($pdf) ) {
	    $pdf->page_script('
	        if ($PAGE_COUNT >= 1) {
	            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
	            $size = 10;
	            $pageText = "Página: " . $PAGE_NUM . " de " . $PAGE_COUNT;
	            $y = 555;
	            $x = 665;
	            $pdf->text($x, $y, $pageText, $font, $size);


	        }
	    ');
	}
	</script>



@stop
