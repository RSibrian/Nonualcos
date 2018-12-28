<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{"Reporte de $title"}}</title>
    <style>
        @page { margin: 180px 50px; }
        #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px;  text-align: center; }
        #footer { position: fixed; left: 0px; bottom: -220px; right: 0px; height: 150px; }

        body {
            font-family: 'Source Sans Pro', sans-serif;
            font-weight: 300;
            font-size: 12px;
            margin: 0;
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
    <div style="position: absolute;left: 0px; top: 0px; z-index: 1;"><h2>Asociación Los Nonualcos</h2></div>
    <div style="position: absolute;left: 300px; top: 40px; z-index: 1;">Departamento de La Paz</div>
    <HR style="position: absolute;left: 23px; top: 130px; z-index: 1; color:blue;" width=90%>
    <div style="position: absolute;left: 550px; top: 138px; z-index: 1;">Fecha:  <?=  $date; ?> </div>
    <div style="position: absolute;left: 550px; top: 153px; z-index: 1;">Hora:&nbsp;&nbsp;  <?=  $date1; ?> </div>
    <div align="left" style="position: absolute;left: 200px; top: 70px; z-index: 1;"><h5>Barrio san juan  Avenida Anastacio Aquino No.26 Santiago Nonualco </h5></div>
    <div align="left" style="position: absolute;left: 320px; top: 83px; z-index: 1;"><h5>Telefono: 2330-4366</h5></div>
    <h3 align="right" style="position: absolute; left: 550px; top:0px;  z-index: 1;"><img class="al" width="110px" height="110px" src="img/logo.jpg" ></h3>
    <h3 align="right" style="position: absolute;left:10px; top:0px; z-index: 1;"><img class="al" width="110px" height="110px" src="img/sv.png" ></h3>
</div>
<div id="footer">
    <HR align="left" style="position: absolute; left:23px; top:15px; z-index: 1; color:blue;" width=100%>
</div>
@yield('reporte')



<script type="text/php">
    if ( isset($pdf) ) {
    $pdf->page_script('
        if ($PAGE_COUNT >= 1) {
            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
            $size = 10;
            $pageText = "Pagina: " . $PAGE_NUM . " de " . $PAGE_COUNT;
            $y = 735;
            $x = 480;
            $pdf->text($x, $y, $pageText, $font, $size);


        }
    ');
}
</script>
</body>

</html>
