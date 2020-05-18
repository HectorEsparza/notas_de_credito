<!DOCTYPE html>
<html>
<head>
	<title>Visualización</title>
	<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
  	<script type="text/javascript" src="ajax/js/jquery-ui.js"></script>
	<script type="text/javascript" src="ajax/eventos/filtroFacturasSinEntrada.js"></script>
	<script type="text/javascript" src="ajax/eventos/facturas.js"></script>
	<script type="text/javascript" src="ajax/eventos/exportarFacturasSinEntrada.js"></script>
	<script type="text/javascript" src="../js/verificarSesion.js"></script>
	<script type="text/javascript" src="../js/cierreSesion.js"></script>
	<script type="text/javascript" src="../js/cierreInactividad.js"></script>

</head>
<body>
	<?php session_start();
	$usuario = $_SESSION['user'];
	require_once("../funciones.php");
	$nombres = ["Héctor", "Daniel", "Esparza", "Méndez"];

	try
	{
		$base = conexion_local();
		$consulta="SELECT DEPARTAMENTO, PERMISO FROM USUARIOS WHERE USUARIO=?";
		$resultado = $base->prepare($consulta);
		$resultado-> execute(array($usuario));
		$registro = $resultado->fetch(PDO::FETCH_NUM);
		$departamento = $registro[0];
    $permiso = $registro[1];


	if(!isset($usuario))
	{
		header("location:../index.html");
	}

	else
	{
		// $folio = $_POST['folio'];
	?>
	<header class="row">
		<input type="hidden" id="arreglo" value="<?= json_encode($nombres)?>" />
		<div class="container col-md-6">
			<h1 align='center'>
				Visualización Facturas sin Entrada
			</h1>
			<input type='button' id="home" class="btn btn-primary" style='background:url("imagenes/home3.jpg"); float: left; width: 50px; height: 50px;' />
			<div align="center"><img src="imagenes/apa.jpg" /></div>
		</div>
		<div class="container col-md-6">
			<form action='../cierre.php'>
				<input style="float: right;" class="btn btn-danger" type='submit' value='Cierra Sesión' />
			</form>
      <input type="button" style="float: right;" class="btn btn-success" id="nuevaCobranza" onclick=" visualizar()"value='Regresar' />
		</div>
	</header>
	<section>
    <div class="container" align="center">
				<h3>Actualizar Estatus</h3>
        <table border="1">
  				<form action="cambiarEstatusTXT.php" method="post" enctype="multipart/form-data">
  				<tr style="font-weight: bold; text-align: center;">
  					<td colspan="2">Carga Facturas</td>
  				</tr>
  				<tr>
  						<td colspan="2">
  								<input type="file" name="archivo"  style="float: right;" id="archivo" />
  						</td>
  				</tr>
  				<tr style="font-weight: bold; text-align: center;">
  					<td colspan="2">
  						<input type="submit" value="cargar" class="btn btn-primary btn-sm" id="cargar" disabled/>
  					</td>
  				</tr>
  				</form>
  			</table>
		</div>
		<div class="container" align="center">
				<h3>Filtro de Búsqueda</h3>
						 <br />

						 <input type="hidden" id="gerente" value="<?= $usuario?>" />
						 <input type="text" id="factura" class="factura" placeholder="Factura" />
						 <input type="text" id="cliente" class="cliente" placeholder="NO. Cliente" />
						 <input type="text" id="fecha" class="fecha" placeholder="Fecha Elaboración Inicio" />
						 <input type="text" id="fechaFin" class="fechaFin" placeholder="Fecha Elaboración Fin" />
						 <br /><br />
						 <input type="button" class="btn btn-primary" id="buscar" value="Buscar" />
						 <input type="button" class="btn btn-primary" onclick="facturas()" value='Tabla Completa' />
						 <!-- <input type="button" class="btn btn-primary" id="exportarFacturasSinEntrada" value='Exportar' /> -->


				<input type=hidden id="folio" value="<?= $folio?>"/>
		</div>
		<br /><br />
		<div class="col-md-12 text-center">
			<ul class="pagination" id="paginador"></ul>
			<button  id="exportaExcel" class="btn btn-info">Exportar Excel</button>
		</div>
	<div class="container" id="principal">
	<!--<table class="table table-striped table-hover">-->
	<table  border=1 align='center' width="100%" style="text-align: center;">
		<thead>
			<tr style="font-weight: bold;">
				<td>Clave</td>
				<td>Cliente</td>
				<td>Nombre</td>
				<td>Estatus</td>
				<td>Fecha de elaboracion</td>
				<td>Importe total</td>
				<td>Nombre del vendedor</td>
				<td>Porcentaje de descuento</td>
				<td>Folio de Contado</td>
			</tr>
		</thead>
		<tbody id="table">

		</tbody>
	</table>
	</div>
	<br /><br />
</section>
	<?php
	}

	$resultado->closeCursor();
	}
	catch (Exception $e)

	{
		die("<h1>ERROR: " . $e->GetMessage());
	}

	finally
	{
		$base = null;
	}
	?>

<!--<script src="ajax/js/jquery-2.min.js"></script>-->
<script src="ajax/js/bootstrap.min.js"></script>
<script src="ajax/js/paginator.min.js"></script>
<script src="ajax/js/mainFacturasSinEntrada.js"></script>
<!-- <script src="ajax/eventos/cierreInactividad.js"></script> -->


<script type="text/javascript">

			$(document).ready(function(){

									$('#tag').autocomplete({
											source: function(request, response){
													$.ajax({
															url:"colores.php",
															dataType:"json",
															data:{q:request.term},
															success: function(data){
																	response(data);
															}
													});
											},
											minLength:3,
											select: function(event, ui){
													//alert("Selecciono: "+ui.item.label);
											}
									});
									$("#home").click(function(){

										setTimeout("location.href='../home.php'", 500);
									});


				$('#fecha').datepicker();

			});
			$("#exportaExcel").hide();

			$("#exportaExcel").click(function(){
				alert("Exportación en proceso");
				setTimeout("location.href='exportar.php'",500);
			});

			function visualizar(){
          setTimeout("location.href='visualizacion.php'",500);
      }
      function facturas(){
        setTimeout("location.href='facturasSinEntrada.php'",500);
      }
</script>
</body>
</html>
