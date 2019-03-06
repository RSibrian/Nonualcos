<?php $title='Reporte de Datos de Activo '.$activo->codigoInventario.'-'.$date;?>
@extends ('reporte.plantillaVertical')
@section('reporte')
<style>
.gris {
	background: rgba(192,192,192,0.5);
}
</style>
<br><div style="text-align: center;"><h3>ASOCIACION DE MUNICIPIOS LOS NONUALCO
HOJA DE CONSTANCIA DE ENTREGA DE BIEN {{$activo->nombreActivo}}</h3></div>

<table class="table-wrapper" >
	<?php $count=0;?>
	<br>
	<thead>
		<tr>
			<th>Concepto</th>
			<th>Detalle</th>
		</tr>
		<tr>
			<td class="gris">Código de Inventario: </td>
			@if($activo->codigoInventario!=null)
			<td>{{$activo->codigoInventario}}</td>
			@else
			<td>{{'No asignado'}}</td>
			@endif

		</tr>
		<tr>
			<td class="gris">Clasificación:</td>
			<td>{{$activo->clasificacionActivo->nombreTipo}}</td>
		</tr>

		@if($activo->tipoActivo==1)
		<tr>
			<td class="gris">Número de Placa:</td>
			<td>{{$activo->vehiculo->numeroPlaca}}</td>
		</tr>
		@endif

		<tr>
			<td class="gris">Marca:</td>
			<td>{{$activo->marca}}</td>
		</tr>
		<tr>
			<td class="gris">Modelo:</td>
			<td>{{$activo->modelo}}</td>
		</tr>
		<tr>
			<td class="gris">Color:</td>
			<td>{{$activo->color}}</td>
		</tr>
		<tr>
			<td class="gris">Serie:</td>
			<td>{{$activo->serie}}</td>
		</tr>


		<tr>
			<td class="gris">Años de vida útil:</td>
			<td>{{$activo->aniosVida.' Años'}}</td>
		</tr>
		<tr>
			<td class="gris">fecha de adquisición:</td>
			<?php $datead = new DateTime($activo->fechaAdquisicion); ?>
			<td>{{$datead->format('d/m/Y')}}</td>
		</tr>

		@if($activo->ObservacionActivo!=null)
		<tr>
			<td class="gris">Observaciones:</td>
			<td>{{$activo->ObservacionActivo}}</td>
		</tr>
		@endif
		<tr>
			<td class="gris">Precio: </td>
			<td>{{'$'.$activo->precio}}</td>
		</tr>




		@if($activo->estadoActivo==0)
		<?php $dateesta = new DateTime($activo->fechaBajaActivo); ?>

		<tr>
			<td class="gris">Fecha dado De Baja:</td>
			<td>{{$dateesta->format('d/m/Y')}}</td>
		</tr>
		<tr>

			<td class="gris">Justificación: </td>
			<td>{{$activo->justificacionActivo}}</td>
		</tr>
		@endif
	</thead>
</table>
<table class="table-wrapper" >
  @if($activo->codigoInventario!=null)
  <?php
  $traslado=$activo->activosUnidades->last();
  ?>
  <tr >
    <th  colspan="2" >Recibido:</th>
  </tr>
  <tr>
    <td  >Unidad: </td>
    <td>{{$traslado->unidad->nombreUnidad}}</td>
  </tr>
  <tr>
    <td >Encargado: </td>
    <td>  {{$traslado->empleado->nombresEmpleado." ".$traslado->empleado->apellidosEmpleado}}</td>
  </tr>
  <tr>
    <td  >Firma: </td>
    <td> </td>
  </tr>
  @endif
</table>

@stop
