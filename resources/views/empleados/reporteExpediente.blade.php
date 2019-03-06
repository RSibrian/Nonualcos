<?php $title='Reporte de Expediente '.$empleado->nombresEmpleado.' '.$empleado->apellidosEmpleado.'-'.$date;?>
@extends ('reporte.plantillaVertical')
@section('reporte')
<style>
.gris {
	background: rgba(192,192,192,0.5);
}
</style>
<br><div style="text-align: center;"><h3>EXPEDIENTE DEL EMPLEADO: {{$empleado->nombresEmpleado.' '.$empleado->apellidosEmpleado}}</h3></div>

<table class="table-wrapper" >
	<?php $count=0;?>
	<br>
	<thead>
		<tr>

			<th colspan="2">Datos Generales</th>
		</tr>
		<tr>
			<td class="gris">DUI: </td>
      <td>{{$empleado->DUIEmpleado}}</td>
		</tr>
    <tr>
			<td class="gris">Nombre: </td>
      <td>{{$empleado->nombresEmpleado.' '.$empleado->apellidosEmpleado}}</td>
		</tr>
		<tr>
			<td class="gris">Fecha Nacimiento:</td>
      <?php $datenac = new DateTime($empleado->fechaNacimiento); ?>
			<td>{{$datenac->format('d/m/Y')}}</td>
		</tr>

		<tr>
			<td class="gris">NIT:</td>
			<td>{{$empleado->NITEmpleado}}</td>
		</tr>


		<tr>
			<td class="gris">Dirección:</td>
			<td>{{$empleado->dirreccionEmpleado}}</td>
		</tr>

	</thead>
</table>

<table class="table-wrapper" >

  <tr >
    <th  colspan="2" >Información del cargo</th>
  </tr>
  <tr>
    <td class="gris">Unidad:</td>
    <td>{{$empleado->cargo->unidad->nombreUnidad}}</td>
  </tr>
  <tr>
    <td class="gris">Cargo:</td>
    <td>{{$empleado->cargo->nombreCargo}}</td>
  </tr>
  <tr>
    <td class="gris">Fecha de Ingreso:</td>
    <?php $dateIng = new DateTime($empleado->fechaIngreso); ?>
    <td>{{$dateIng->format('d/m/Y')}}</td>
  </tr>
  <tr>
    <td class="gris">Salario:</td>
    <td>${{$empleado->salarioBruto}}</td>
  </tr>
  <tr>
    <td class="gris">Tipo Contrato:</td>
    <td>{{$empleado->sistemaContratacion}}</td>
  </tr>
  <tr>
    <td class="gris">Número de ISSS:</td>
    <td>{{$empleado->numeroSeguro}}</td>
  </tr>
  <tr>
    <td class="gris">Tipo de AFP:</td>
    <td>{{$empleado->AFP->nombreAportacion}}</td>
  </tr>
  <tr>
    <td class="gris">Número de AFP:</td>
    <td>{{$empleado->numeroAFP}}</td>
  </tr>

</table>

@stop
