<?php $title="Activo"?>
@extends ('reporte.plantillaVertical')
@section('reporte')
	<style>
		.gris {
			background: rgba(192,192,192,0.5);
		}
	</style>
	<br><div style="position: absolute;left: 230px; top: -20px; z-index: 1;"><h3>Caracteristicas del Activo: {{$activo->nombreActivo}}</h3></div>

  <table class="table-wrapper" >
    <?php $count=0;?>
    <br>
    <thead>
      <tr>
        <th>Concepto</th>
        <th>Detalle</th>
      </tr>
    <tr>
      <td class="gris">Codigo de Inventario: </td>
      @if($activo->codigoInventario!=null)
        <td>{{$activo->codigoInventario}}</td>
      @else
        <td>{{'No asignado'}}</td>
      @endif

    </tr>
    <tr>
      <td class="gris">Clasificación</td>
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
      <td class="gris">Estado:</td>

				@if($activo->estadoActivo==0)
					<td>{{' De Baja'}}</td>
				@elseif($activo->estadoActivo==1)
					<td>{{'Activo'}}</td>
				@elseif($activo->estadoActivo==2)
					<td>{{'Dañado'}}</td>
				@elseif($activo->estadoActivo==3)
				<td>{{'Prestado'}}</td>
				@else
						<td>{{'Mantenimiento'}}</td>
				@endif
			</tr>
	    <tr>
      <td class="gris">Tipo Adquisición:</td>

				@if($activo->tipoAdquisicion==1)
				<td>{{'Compra'}}</td>
				@else
					<td>{{'Donación'}}</td>
				@endif
			</tr>
			<tr>
      <td class="gris">Valor Residual:</td>
        <td>{{$activo->valorResidual.'%'}}</td>
			</tr>
	    <tr>
      <td class="gris">Años de Vida utíl:</td>
        <td>{{$activo->aniosVida.' Años'}}</td>
			</tr>
	    <tr>
      	<td class="gris">fecha Adquisición:</td>
				<?php $datead = new DateTime($activo->fechaAdquisicion); ?>
			  <td>{{$datead->format('d/m/Y')}}</td>
			</tr>

			@if($activo->ObservacionActivo!=null)
			<tr>
      	<td class="gris">Observación:</td>
        <td>{{$activo->ObservacionActivo}}</td>
			</tr>
			@endif

		<tr>
			@if($activo->idProveedor!=null)
      <td class="gris">Proveedor:</td>
        <td>{{$activo->proveedor->nombreEmpresa}}</td>
			@endif
		</tr>
		<tr>
			@if($activo->numeroFactura!=null)
      <td class="gris">factura:</td>
        <td>{{$activo->numeroFactura}}</td>
			@endif
		</tr>
		<tr>
      <td class="gris">Precio: </td>
        <td>{{'$'.$activo->precio}}</td>
			</tr>


			@if($activo->codigoInventario!=null)
				<?php
						$traslado=$activo->activosUnidades->last();
				?>
			<tr>
      	<td class="gris">Unidad: </td>
        <td>{{$traslado->unidad->nombreUnidad}}</td>
			</tr>
	    <tr>
      <td class="gris">Encargado: </td>
        <td>  {{$traslado->empleado->nombresEmpleado." ".$traslado->empleado->apellidosEmpleado}}</td>
			</tr>
			@endif

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

@stop
