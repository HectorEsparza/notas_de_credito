<!DOCTYPE html>
<html>
<head>
	<title>Visualización</title>
	<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="css/estiloSAE.css" />
  <script type="text/javascript" src="ajax/js/jquery-ui.js"></script>
	<script type="text/javascript" src="ajax/js/filtro.js"></script>
	<!-- <script type="text/javascript" src="ajax/js/limpia.js"></script> -->
	<!-- <script type="text/javascript" src="ajax/js/limpiaFiltro.js"></script> -->
</head>
<body>
	<?php session_start();
	$usuario = $_SESSION['user'];
	require_once("../funciones.php");

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
	elseif($permiso>0)
	{
		header("location:../home.php");
	}
	else
	{
		// $folio = $_POST['folio'];
	?>
	<header class="row">
		<div class="container col-md-8">
			<h1 align='center'>
				Visualización Análisis
			</h1>
			<input type='button' id="home" class="btn btn-primary" style='background:url("imagenes/home3.jpg"); float: left; width: 50px; height: 50px;' />
			<div align="center"><img src="imagenes/apa.jpg" /></div>
		</div>
		<div class="container col-md-4">
			<form action='../cierre.php'>
				<input style="float: right;" class="btn btn-danger" type='submit' value='Cierra Sesión' />
			</form>
			<input type="button" style="float: right;" class="btn btn-success" id="nuevoRegistro" onclick=" nuevo()"value='Nuevo Producto' />

		</div>
	</header>
	<section>
		<div class="container" align="center">
				<h3>Filtro de Búsqueda</h3>
						 <br />

						 <input type="hidden" id="gerente" value="<?= $usuario?>" />
						 <input type="text" id="idApa" class="idApa" placeholder="ID APA"/>
						 <input type="text" id="idVazlo" class="idVazlo" placeholder="ID Vazlo"/>
						 <br /><br />
						 <button type="submit" class="btn btn-primary" onclick="filtro(document.querySelector('.idApa').value, document.querySelector('.idVazlo').value);">Buscar</button>
						 <!-- <button type="submit" class="btn btn-primary" id="limpiaFiltro">Limpiar Campos</button> -->
						 	<input type="button" class="btn btn-primary" onclick="visualizar()" value='Tabla Completa' />
							<input type="button" class="btn btn-primary" onclick="exportar()" value="Exportar a Excel" />
							<input type="button" class="btn btn-primary" onclick="reporte()" value="Reporte de Precios" />

				<input type=hidden id="folio" value="<?= $folio?>"/>
		</div>
		<br /><br /><br />
	<div class="container" id="principal">
	<!--<table class="table table-striped table-hover">-->
	<table  border=1 align='center'>
		<thead>
			<tr>
				<th>ID APA</th>
				<th>Precio</th>
				<th>ID Vazlo</th>
				<th>Precio</th>
        <th>Info</th>
			</tr>
		</thead>
		<tbody id="table">

		</tbody>
	</table>
	<div class="col-md-12 text-center">
		<ul class="pagination" id="paginador"></ul>
	</div>

	</div>

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
<script src="ajax/js/main.js"></script>
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
			});
			$(document).ready(function(){

				$('#fecha').datepicker();
			});


      function nuevo(){
          setTimeout("location.href='nuevoProducto.php'",500);
      }
			function visualizar(){
          setTimeout("location.href='analisis.php'",500);
      }
			function ver(folio){
					setTimeout("location.href='editarAnalisis.php?folio="+folio+"'");
			}
			function exportar(){
				alert("Exportación en proceso");
				setTimeout("location.href='exportar.php'",500);
			}
			function exportar(){
				alert("Exportación en proceso");
				setTimeout("location.href='exportar.php'",500);
			}
			function reporte(){
				setTimeout("location.href='reporte.php'",500);
			}


</script>
</body>
</html>
