<!DOCTYPE html>
<html>
<head>
	<title>Visualización</title>
	<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
  <script type="text/javascript" src="ajax/js/jquery-ui.js"></script>
	<script type="text/javascript" src="ajax/eventos/filtroCobranza.js"></script>
	<script type="text/javascript" src="ajax/eventos/facturas.js"></script>
	<!-- <script type="text/javascript" src="ajax/js/limpia.js"></script> -->
	<!-- <script type="text/javascript" src="ajax/js/limpiaFiltro.js"></script> -->
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
		<input type="hidden" id="departamento" value="<?= $departamento?>">
		<input type="hidden" id="permiso" value="<?= $permiso?>">
		<div class="container col-md-6">
			<h1 align='center'>
				Visualización Entradas a Caja
			</h1>
			<input type='button' id="home" class="btn btn-primary" style='background:url("imagenes/home3.jpg"); float: left; width: 50px; height: 50px;' />
			<div align="center"><img src="imagenes/apa.jpg" /></div>
		</div>
		<div class="container col-md-6">
			<form action='../cierre.php'>
				<input style="float: right;" class="btn btn-danger" type='submit' value='Cierra Sesión' />
			</form>
      <input type="button" style="float: right;" class="btn btn-success" id="nuevaCobranza" onclick=" nuevo()"value='Nueva Cobranza' />
		</div>
	</header>
	<section>
		<div class="container" align="center">
				<h3>Filtro de Búsqueda</h3>
						 <br />

						 <input type="hidden" id="gerente" value="<?= $usuario?>" />
						 <input type="text" id="idCobranza" class="idCobranza" placeholder="ID Cobranza"/>
						 <input type="text" id="fecha" class="fecha" placeholder="Fecha"/>
						 <br /><br />
						 <input type="button" class="btn btn-primary" id="buscar" value="Buscar" />
						 <!-- <button type="submit" class="btn btn-primary" id="limpiaFiltro">Limpiar Campos</button> -->
						 <input type="button" class="btn btn-primary" onclick="visualizar()" value='Tabla Completa' />
						 <input type="button" class="btn btn-primary" onclick="facturas()"   id="factura" value="Facturas" />
						 <input type="button" class="btn btn-primary" onclick="facturasSinEntrada()"   id="sinEntrada" value="Facturas sin Entrada" />


				<input type=hidden id="folio" value="<?= $folio?>"/>
		</div>
		<br /><br />
		<div class="container" align='center' id="cargarFacturas">
			<table border="1">
				<form action="otroTipoDeCargarFacturas.php" method="post" enctype="multipart/form-data">
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
		<br /><br />
	<div class="container" id="principal">
	<!--<table class="table table-striped table-hover">-->
	<table  border=1 align='center' width="500px" style="text-align: center;">
		<thead>
			<tr style="font-weight: bold;">
				<td>ID Cobranza</td>
				<td>Fecha</td>
				<td>Total</td>
				<td>Usuario</td>
        <td>Info</td>
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


				$('#fecha').datepicker();
				$("#cargar").click(function(){
					setTimeout("location.href='cargarFacturas.php'", 500);
				});

				var departamento = $("#departamento").val();
				var permiso = $("#permiso").val();
				if(departamento=="COBRANZA"){
					$("#factura").hide();
					$("#sinEntrada").hide();
					$("#cargarFacturas").hide();
				}
				else if(departamento=="CREDITO_Y_COBRANZA"){
					if(permiso==1){
						$("#nuevaCobranza").hide();
					}
				else if(permiso==2){
						$("#nuevaCobranza").hide();
						$("#cargarFacturas").hide();
					}

				}
			});


      function nuevo(){
          setTimeout("location.href='nuevaCobranza.php'",500);
      }
			function visualizar(){
          setTimeout("location.href='analisis.php'",500);
      }
			function ver(folio){
					setTimeout("location.href='impresion.php?folio="+folio+"'");
			}
			function facturas(){
				setTimeout("location.href='facturas.php'",500);
			}
			function facturasSinEntrada(){
				setTimeout("location.href='facturasSinEntrada.php'",500);
			}


</script>
</body>
</html>
