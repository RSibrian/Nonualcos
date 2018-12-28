<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{"Reporte de $title"}}</title>
    <style>
        @page { margin: 0; }
        #header { position: fixed;   text-align: center; }
        #footer { position: fixed; text-align: center; }

        body {
            font-family: 'Source Sans Pro', sans-serif;
            font-weight: 300;
            font-size: 12px;
            margin: 15em 4.75em 4.75em 5.92em; //6.32cm top 2cm right 2cm bottom 2.5 left
            padding: 0;
            color: #777777;
        }
        table {
            border-collapse: collapse;
            width: 95%;
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
    <div style="position: absolute; top: 5em; z-index: 1; "><h2>ASOCIACIÓN DE MUNICIPIOS</h2></div>
    <div style="position: absolute; top: 7em; z-index: 1;"><h2>LOS NONUALCOS</h2></div>

    <h3 align="right" style="position: absolute; left:5.92em; top:1em; z-index: 1;"><img class="al" width="100px" height="100px" src="img/sv.png" ></h3>
    <h3 align="right" style="position: absolute; right: 4.75em; top:1em; z-index: 1;"><img class="al" width="100px" height="100px" src="img/logo.png" ></h3>

    <HR style="position: absolute; left: 5.92em; top: 10.6em; right: 4.75em; z-index: 1; color:	#005588;" width=100%>
    <div style="position: absolute; right: 4.75em; top: 11.5em; z-index: 1;">Fecha:  <?=  $date; ?> </div>
    <div style="position: absolute; right: 4.75em; top: 12.5em; z-index: 1;">Hora:  <?=  $date1; ?> </div>
</div>
<div id="footer">
    <HR align="left" style="position: absolute; left:5.92em; right: 4.75em; bottom: 6em; z-index: 1; color:	#005588;" width=100%>
</div>
<div style="position: absolute; left: 3.75em; right: 4.75em; bottom: 0.2em; z-index: 1; ">Barrio San Juan, Avenida Anastasio Aquino y Francisco Gavidia #333. Santiago Nonualco. La Paz</div>
<div style="position: absolute; left: 4.75em; right: 4.75em; bottom: -1em; z-index: 1; text-align: center;">Teléfono: 2330-4366, Fax: 2330-4358</div>

@yield('reporte')

<div align="center" style="position: absolute; left:5.92em; bottom: 4em; z-index: 1;">
    <b>Firma:_______________________________
        <br>
        @if(Auth::user()->idEmpleado!=null)
            {{ Auth::user()->empleado->nombresEmpleado." ".Auth::user()->empleado->apellidosEmpleado }}
        @endif
    </b>
</div>

<script type="text/php">
    if ( isset($pdf) ) {
    $pdf->page_script('
        if ($PAGE_COUNT >= 1) {
            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
            $size = 10;
            $pageText = "Página: " . $PAGE_NUM . " de " . $PAGE_COUNT;
            $y = 740;
            $x = 500;
            $pdf->text($x, $y, $pageText, $font, $size);


        }
    ');
}
</script>
</body>

</html>
