<?php $title='Comprobante Entrega de Activo-'.$date;?>
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
<br><div style="text-align: center;"><h3>Comprobante Entrega de Activos</h3></div>

<table class="table-wrapper">
<tr>
<th colspan="6">Información del Préstamo</th>
</tr>
<tr>
  <td class='blanco' aling="left"><b>Institución:</b>&nbsp;&nbsp;</td>
  <td class='blanco' colspan="5">&nbsp;{{$prestamo->institucion->nombreInstitucion}}&nbsp;</td>
</tr>
<tr>
  <td class='blanco' aling="left"><b>Evento:</b>&nbsp;&nbsp;</td>
  <td class='blanco' colspan="5">{{$prestamo->evento}}&nbsp;</td>
</tr>
<tr>
  <td class='blanco'><b>Nombre del Solicitante:</b></td>
  <td class='blanco'  colspan="5">{{ $prestamo->nombreSolicitante}}</td>


</tr>
<tr>
  <td class='blanco'><b>DUI Solicitante:</b>&nbsp;&nbsp;</td>
  <td class='blanco'colspan="2">&nbsp;{{$prestamo->DUISolicitante}}&nbsp;</td>

  <td class='blanco'><b>Télefono:</b>&nbsp;&nbsp;</td>
  <td class='blanco'colspan="2">{{$prestamo->telefonoSolicitante}}&nbsp;</td>
</tr>
<tr>
  <td class='blanco' ><b>Fecha Entrega:</b></td>
  <?php $date2 = new DateTime($prestamo->fechaEntregaPrestamo); ?>
  <td class='blanco' colspan="2" >{{$date2->format('d/m/Y')}}</td>

  <td class='blanco'><b>Fecha Devolución:</b></td>
  <?php $date3= new DateTime($prestamo->fechaDevolucionPrestamo); ?>
  <td class='blanco'colspan="2" >{{$date3->format('d/m/Y')}}</td>
</tr>
</table>
<br><br>


<h4 align='center'><b>Activos del Préstamo </b></h4>
<table class="table-wrapper" >
  <thead>
    <tr>
      <b>
      <th></th>
      <th>#</th>
      <th>Código Inventario</th>
      <th>Artículo</th>
      <th>Marca</th>
      <th>Modelo</th>
      <th>Color</th>

    </b>
    </tr>
  </thead>
  <tbody>
    <?php $cont=0;?>
    @foreach($activos as $activo)
      <?php
      $cont++;
    //  $activoPrestado=$activo->activo;
      $activoPrestado=App\Activos::find($activo->activos_id);
    //  dd($activoPrestado);
      ?>
      <tr>
        <td></td>
        <td>{{$cont}}</td>
        <td>{{$activoPrestado->codigoInventario}}</td>
        <td>{{$activoPrestado->nombreActivo}}</td>
        <td>{{$activoPrestado->marca}}</td>
        <td>{{$activoPrestado->modelo}}</td>
        <td>{{$activoPrestado->color}}</td>
      </tr>
    @endforeach
  </tbody>
</table>

@section('firma')
<div align="center" style="position: absolute; left:5mm; bottom: 15mm; z-index: 1;">
    <b>Firma:_______________________________
        <br>
        {{ $prestamo->nombreSolicitante }}
				<br>
				Firma de Entrega.
    </b>
</div>

<div align="center" style="position: absolute; right: :5mm; bottom: 15mm; z-index: 1;">
    <b>Firma:_______________________________
        <br>
        {{ $prestamo->nombreSolicitante }}
				<br>
				Firma de Devolución.
    </b>
</div>
@stop


@stop
