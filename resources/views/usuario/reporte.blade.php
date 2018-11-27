<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reporte de Usuarios</title>




	<style>
	.page-break {
    page-break-after: always;
}
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


table th,
table td {
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
  section .table-wrapper {
    position: relative;
    overflow: hidden;
  }

/*tr:nth-child(even){background-color: #F0FDFF}
*/
table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}
#footer{
	width: 100%;

	height: 14px;

	padding: 4px 0px;

	background: #1d1d1d;

	font-family: "century gothic","arial";

	color: #F7F2EF;

	font-size: 10px;

    bottom:0px;

	margin-top: -14px;

	clear:both;
}
</style>
</head>
<body>
	<?php
	$total=sizeof($users)/20;
	$total=ceil($total);
	$count=0;
	$numero=0;
	?>
	@foreach ($users as $u)
 @if($count==$numero)
<?php $numero=$numero+20;?>
  <div class="col-md-12">
    <div class="box-body">
      <div class="box-header with-border">
        <div style="position: absolute;left: 220px; top: 0px; z-index: 1;"><h2>Asociación Los Nonualcos</h2></div>
        <div style="position: absolute;left: 280px; top: 50px; z-index: 1;">Departamento de La Paz</div>
        <!--div style="position: absolute;left: 350px; top: 80px; z-index: 1;"><h5> Telefax 0000-0000</h5></div>
        <div style="position: absolute;left: 385px; top: 93px; z-index: 1;"><h5> Teléfono 0000-0000</h5></div>
        <div style="position: absolute;left: 123px; top: 93px; z-index: 1;"><h5>Depto, El Salvador, C.A.</h5></div-->
        <HR style="position: absolute;left: 23px; top: 130px; z-index: 1; color:blue;" width=90%>
        <div style="position: absolute;left: 550px; top: 138px; z-index: 1;">Fecha:  <?=  $date; ?> </div>
        <div style="position: absolute;left: 550px; top: 153px; z-index: 1;">Hora:&nbsp;&nbsp;  <?=  $date1; ?> </div>
        <h3 align="right" style="position: absolute;left:20; top:0px; px; z-index: 1;"><img class="al" width="110px" height="110px" src="img/logo.jpg" ></h3>
        <!--h3 align="right" style="position: absolute; left:550px; top:0px; z-index: 1;"><img class="al" width="120px" height="110px" src="img/sv.png" ></h3-->
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      </div><!-- /.box-header -->
      <div class="box-body">
        <div style="position: absolute;left: 250px; top: 170px; z-index: 1;"><h3>Consolidado de Usuarios</h3></div>



			  <table class="table-wrapper" >
					<thead>
						<tr>
							<th></th>
							<th>#</th>
							<th>Nombre</th>
							<th>Empleado</th>
							<th>Correo</th>
						</tr>
					</thead>
					<tbody>
				@endif


<?php $count++;?>
									<tr>

											<td></td>
											<td>{{$count}}</td>
											<td>{{$u->name}}</td>
											<td>{{$u->idEmpleado? $u->empleado->nombresEmpleado.' '.$u->empleado->apellidosEmpleado : "No consignado"}}</td>
											<td>{{$u->email}}</td>
									</tr>




				 @if($count==$numero)
					 </tbody>

				</table>
  	 </div><!-- /.box-body -->
	  </div><!-- /.box -->
  </div>
	<footer class="footer"  align="right" style="position: absolute;left:450; top:920px; px; z-index: 1;">
			<div class="container-fluid">

					<p class="copyright pull-right">
							<?php
							$pag=$numero/20;
							?>
							{{"Pagina $pag de $total"}}
					</p>
			</div>
	</footer>
		@if($pag!=$total)
	<div class="page-break"></div>
@else
	<div align="center" style="position: absolute; left:70; top:920px; px; z-index: 1;">
			Firma:_______________________________
			<br>
			@if(Auth::user()->idEmpleado!=null)
					{{ Auth::user()->empleado->nombresEmpleado." ".Auth::user()->empleado->apellidosEmpleado }}
			@endif

	</div>
	@endif
	@endif



	@endforeach
	<?php
		$final=sizeof($users)%20;;
	?>
	@if($final>0)
</tbody>

</table>
</div><!-- /.box-body -->
</div><!-- /.box -->
</div>
<div align="center" style="position: absolute; left:70; top:920px; px; z-index: 1;">
		Firma:_______________________________
		<br>
		@if(Auth::user()->idEmpleado!=null)
				{{ Auth::user()->empleado->nombresEmpleado." ".Auth::user()->empleado->apellidosEmpleado }}
		@endif

</div>
	 <footer class="footer"  align="right" style="position: absolute;left:450; top:920px; px; z-index: 1;">
			<div class="container-fluid">

					<p class="copyright pull-right">
							<?php
							$pag=$numero/20;
							$pag=ceil($pag);
							?>
							{{"Pagina $pag de $total"}}
					</p>
			</div>
	</footer>
@endif

</body>

</html>
