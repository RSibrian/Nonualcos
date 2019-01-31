<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{"Reporte de  $title"}}</title>
    <style type="text/css">
        @page { margin: 0; }
        #header { position: fixed; text-align: center; }
        #footer { position: fixed; text-align: center; }

        body {
            font-family: 'Source Sans Pro', sans-serif;
            font-weight: 300;
            font-size: 12px;
            margin: 60mm 20mm 20mm 25mm; //6cm top 2cm right 2cm bottom 2.5cm left
        padding: 0;
            color: #3b3b3b;
        }
    </style>
</head>
<body>
<div id="header">
  <div style="position: absolute; top: 27mm; z-index: 1;"><h2>ASOCIACIÓN DE MUNICIPIOS LOS NONUALCOS</h2></div>

  <h3 align="right" style="position: absolute; left:20mm; top:12.5mm; z-index: 1;"><img class="al" width="100px" height="100px" src="img/sv.png" ></h3>
  <h3 align="right" style="position: absolute; right:20mm; top:12.5mm; z-index: 1;"><img class="al" width="100px" height="100px" src="img/logo.png" ></h3>

  <HR style="position: absolute; left: 20mm; top: 43mm; right:20mm; z-index: 1; color:	#005588;" width=100%>
  <div style="position: absolute; right: 20mm; top: 47mm; z-index: 1;">Fecha:  <?=  $date; ?> </div>
  <div style="position: absolute; right: 20mm; top: 50mm; z-index: 1;">Hora:  <?=  $date1; ?> </div>
</div>
<div id="footer">
<HR align="left" style="position: absolute; left:20mm; right: 20mm; bottom: 20mm; color:	#005588;" width=100%>
<div style="position: absolute; left: 20mm; right: 20mm; bottom: 17mm; text-align: center">Barrio San Juan, Avenida Anastasio Aquino y Francisco Gavidia #333. Santiago Nonualco, La Paz.</div>
<div style="position: absolute; left: 20mm; right: 20mm; bottom: 12.5mm; text-align: center">Teléfono: 2330-4366, Fax: 2330-4358</div>
</div>

@yield('reporte')


</body>

</html>
