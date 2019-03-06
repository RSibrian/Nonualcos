<?php use App\Activos;?>
<?php $title='Reporte de Empleados '.$date;?>
@extends ('reporte.plantillaHorizontal')
@section('reporte')
	<style>
		.azul{
			background: rgba(153,217,234,0.5);
		}
	</style>
	<br><div style="text-align: center;"><h3>LISTADO DE EMPLEADOS ALN</h3></div>





				<table class="table-wrapper" >
					<?php $count=0;?>
					<br>
					<thead>


					<tr>
						<th >#</th>
						<th >DUI</th>
						<th >Nombres</th>
						<th  >Apllidos</th>
						<th  >Unidad</th>
						<th >Cargo</th>
						<th  >Estado</th>

					</tr>
				</thead>

				<tbody>
				@foreach($empleados as $empleado)
						<tr>
							<?php $count++;?>
							<td>{{$count}}</td>
							<td>{{$empleado->DUIEmpleado}}</td>
							<td>{{$empleado->nombresEmpleado}}</td>
							<td>{{$empleado->apellidosEmpleado}}</td>
							<td>{{$empleado->cargo->unidad->nombreUnidad}}</td>
							<td>{{$empleado->cargo->nombreCargo}}</td>
							@if($empleado->estadoEmpleado==0)
								<td>{{'Inactivo'}}</td>
							@else
								<td>{{'Activo'}}</td>
							@endif

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
            $x = 665;
            $pdf->text($x, $y, $pageText, $font, $size);


        }
    ');
}
</script>



@stop
