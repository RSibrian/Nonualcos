<?php $title='Reporte de Depreciación de Activo Mensual '.$activo->codigoInventario.'-'.$date;?>
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
		<br><div style="text-align: center;"><h3>Depreciación Mensual del Activo: {{ $activo->nombreActivo}}</h3></div>

		<?php
		$valorResidual=$activo->precio*$activo->valorResidual/100;
		$valorDepreciar=($activo->precio-$valorResidual);
		$cuota=$valorDepreciar/$activo->aniosVida;
		$depreAcumulada=0;
		$precio=$activo->precio;
		$fechaBaja=$activo->fechaBajaActivo;

		$mes=date("m");
		$anno=date("Y");


		if($activo->estadoActivo==0){

			$dias_baja=date("d", strtotime($activo->fechaBajaActivo));//dia 12
			$mes_baja=date("m", strtotime($activo->fechaBajaActivo));// mes 07
			$anno_baja=date("Y", strtotime($activo->fechaBajaActivo));//2018
			$fecha_fin_mes = date($anno_baja."-".$mes_baja."-01");//2018-12-01

		}
		else{
			$fecha_fin_mes = date($anno."-".$mes."-01");//2018-12-01
			$ban=0;

		}


		$dias_inicio=date("d", strtotime($activo->fechaAdquisicion));//dia 12
		$mes_inicio=date("m", strtotime($activo->fechaAdquisicion));// mes 07
		$anno_inicio=date("Y", strtotime($activo->fechaAdquisicion));//2018

		$fecha_compra = date($anno_inicio."-".$mes_inicio."-01");//2018-07-01
		$fecha_max=date("Y-m-d", strtotime("$fecha_compra +$activo->aniosVida year"));
		if($dias_inicio<25)
		{
				$fecha_fin_mes2=date("Y-m-d", strtotime("$fecha_fin_mes +1 month"));
		}
		else $fecha_fin_mes2=$fecha_fin_mes;
		$inicio = new \DateTime($fecha_compra);
		$fin = new \DateTime($fecha_fin_mes2);
		$resultado = $inicio->diff($fin);

		$text_anno="año";
		$text_mes="mes";
		if($resultado->y>1)
		{
			$text_anno="años";
		}
		if($resultado->m>1)
		{
			$text_mes="meses";
		}


		if($fecha_fin_mes>=$fecha_max && $activo->estadoActivo!=0) //duda
		{

			$mesesDepre=$activo->aniosVida*12;
			$resultado->y=$activo->aniosVida;
			$resultado->m=0;
		}
		else {

			if($fecha_fin_mes>=$fecha_max && $activo->estadoActivo==0) //duda
			{
				$mesesDepre=$activo->aniosVida*12;
				$resultado->y=$activo->aniosVida;
				$resultado->m=0;

			}
			else
			{
				$mesesDepre=($resultado->y*12)+$resultado->m;

			}
	}
		$depreMen=($cuota/12)*$mesesDepre;
	?>



  <table class="table-wrapper">
<tr>
  <th colspan="6">Información del Activo</th>
</tr>
  <tr>
    <td class='gris'>Código:&nbsp;&nbsp;</td>
    <td class='blanco'>&nbsp;{{$activo->codigoInventario?:"No asignado"}}&nbsp;</td>


    <?php
        if($activo->codigoInventario!=null)
        $traslado=$activo->activosUnidades->last();
    ?>

    <td class='gris'>Unidad:&nbsp;&nbsp;</td>
    <td class='blanco'>{{$activo->codigoInventario?$traslado->unidad->nombreUnidad:"No asignado"}}&nbsp;</td>

      <td class='gris'>Año de Vida Utíl:</td>
      <td class='blanco'>{{ $activo->aniosVida.' Años' }}</td>
  </tr>


    <tr>
    <td class='gris'>Precio de Adquisición:&nbsp;&nbsp;</td>
    <td class='blanco'>&nbsp;$ {{number_format($activo->precio, 2, '.', ',')}}&nbsp;</td>


    <td class='gris'>Porcentaje Residual:&nbsp;&nbsp;</td>
      <td class='blanco'> {{number_format($activo->valorResidual, 0, '.', ',').' %'}}</td>

    <td class='gris'>Valor Residual:&nbsp;&nbsp;</td>
      <td class='blanco'>$ {{number_format($valorResidual, 2, '.', ',')}}</td>

  </tr>

  <tr>
    <td class='gris'>Costo a Depreciar:&nbsp;&nbsp;</td>
      <td class='blanco'>$ {{number_format($valorDepreciar, 2, '.', ',')}}</td>

    <td class='gris'>Cuota Anual:&nbsp;&nbsp;</td>
    <td class='blanco'>$ {{number_format($cuota, 2, '.', ',')}}</td>

    <?php $datead = new DateTime($activo->fechaAdquisicion); ?>
    <td class='gris'>fecha de Adquisición:&nbsp;&nbsp;</td>
    <td class='blanco'>{{ $datead->format('d/m/Y') }}</td>



  </tr>

  <tr>
    <td class='gris'>Valor depreciado:&nbsp;&nbsp;</td>
      <td class='blanco'>$ {{number_format($depreMen, 2, '.', ',')}}</td>

    <td class='gris'>Años depreciados:&nbsp;&nbsp;</td>
    <td class='blanco'>{{"$resultado->y $text_anno"}}</td>

    <td class='gris'>Meses depreciados:&nbsp;&nbsp;</td>
    <td class='blanco'>{{ "$resultado->m $text_mes"}}</td>



  </tr>
	@if($activo->fechaBajaActivo)
	<tr>
		<td></td>
		<td></td>
		<?php $datebaja = new DateTime($activo->fechaBajaActivo); ?>
    <td class='blanco' ><b>Fecha de Baja:&nbsp;&nbsp;</b></td>
    <td class='blanco'><b>{{ $datebaja->format('d/m/Y') }}</b></td>
		<td></td>
		<td></td>

  </tr>
@endif



  </table>
  <br>


  <table class="table-wrapper">
    <thead>
      <tr>
        <th>#</th>
        <th>Mes</th>


        <th>Valor a Depreciar</th>
        <th>Cuota mensual de Depreciación</th>
        <th>Depreciación acumulada</th>
        <th>Valor en Libros</th>
      </tr>
    </thead>
    <tbody>
      <?php $cont=0;
      $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
      $mes_inicio=(integer) $mes_inicio-1;
      ?>
      <tr>
		  <td>{{ $cont }}</td>
		  <td>{{ $meses[$mes_inicio] }}</td>

        <?php
        $precio=$cuota;
        //$valorResidual=$precio*$activo->valorResidual/100;
        //$valorDepreciar=($precio-$valorResidual);
        $valorDepreciar=$cuota;
        $cuota=$valorDepreciar/12;
        $depreAcumulada=0;

        ?>


        <td>$ {{number_format($valorDepreciar, 2, '.', ',')}}</td>
        <td>$ {{number_format($cuota, 2, '.', ',')}}</td>
        <td></td>
        <td>$ {{number_format($precio, 2, '.', ',')}}</td>
      </tr>

      @for($i=0;$i<12;$i++)
        <?php
          $cont++;
          $valorDepreciar-=$cuota;
          $depreAcumulada+=$cuota;
          $precio-=$cuota;
          $mes_inicio++;
        ?>
        <tr>
            <td>{{ $cont }}</td>
            <td>{{$meses[$mes_inicio]}}</td>


          <td>$ {{number_format($valorDepreciar, 2, '.', ',')}}</td>
          <td>$ {{number_format($cuota, 2, '.', ',')}}</td>
          <td>$ {{number_format($depreAcumulada, 2, '.', ',')}}</td>
          <td>$ {{number_format($precio, 2, '.', ',')}}</td>
        </tr>
        <?php
            if($meses[$mes_inicio]==="Diciembre"){
                $mes_inicio=-1;
            }
        ?>
      @endfor

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
