<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{"Reporte de  $title"}}</title>
    <style>
        @page { margin: 0; }
        #header { position: fixed; text-align: center; }
        #footer { position: fixed; text-align: center; }

        body {
            font-family: 'Source Sans Pro', sans-serif;
            font-weight: 300;
            font-size: 12px;
            margin: 45mm 20mm 25mm 20mm; //6cm top 3cm right 2.5cm bottom 3cm left
            margin: ;
            padding: 0;
            color: #777777;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table th, table td {
            text-align: center;
        }
        table th {
            padding: 5px 20px;
            color: white;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }
        th {
            background-color: #4f8ba0;
            color: white;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #FAFBFB;
        }
        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }
    </style>
</head>
<body>
<div id="header">
  <div style="position: absolute; top: 27mm; z-index: 1;"><h2>ASOCIACIÓN DE MUNICIPIOS LOS NONUALCOS</h2></div>

  <h3 align="right" style="position: absolute; left:25mm; top:12.5mm; z-index: 1;"><img class="al" width="100px" height="100px" src="img/sv.png" ></h3>
  <h3 align="right" style="position: absolute; right: 20mm; top:12.5mm; z-index: 1;"><img class="al" width="100px" height="100px" src="img/logo.png" ></h3>

  <HR style="position: absolute; left: 20mm; top: 43mm; right: 20mm; z-index: 1; color:	#005588;" width=100%>
  <div style="position: absolute; right: 20mm; top: 47mm; z-index: 1;">Fecha:  <?=  $date; ?> </div>
  <div style="position: absolute; right: 20mm; top: 50mm; z-index: 1;">Hora:  <?=  $date1; ?> </div>
</div>
<div id="footer">
<HR align="left" style="position: absolute; left:20mm; right: 20mm; bottom: 20mm; color:	#005588;" width=100%>
<div style="position: absolute; left: 20mm; bottom: 17mm; ">Barrio San Juan, Avenida Anastasio Aquino y Francisco Gavidia #333. Santiago Nonualco, La Paz.</div>
<div style="position: absolute; left: 20mm; bottom: 12.5mm; ">Teléfono: 2330-4366, Fax: 2330-4358</div>
</div>
@yield('reporte')

@section('firma')
<div align="center" style="position: absolute; left:5mm; bottom: 15mm; z-index: 1;">
    <b>Firma:_______________________________
        <br>
        @if(Auth::user()->idEmpleado!=null)
            {{ Auth::user()->empleado->nombresEmpleado." ".Auth::user()->empleado->apellidosEmpleado }}
        @endif
    </b>
</div>
@show

<script type="text/php">
    if ( isset($pdf) ) {
    $pdf->page_script('
        if ($PAGE_COUNT >= 1) {
            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
            $size = 10;
            $pageText = "Página: " . $PAGE_NUM . " de " . $PAGE_COUNT;
            $y = 540;
            $x = 710;
            $pdf->text($x, $y, $pageText, $font, $size);


        }
    ');
}
</script>
</body>

</html>
