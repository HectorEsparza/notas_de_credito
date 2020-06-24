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
	<script type="text/javascript" src="ajax/js/filtroVentas.js"></script>
	<script type="text/javascript" src="ajax/js/limpia.js"></script>
	<script type="text/javascript" src="ajax/js/limpiaFiltro.js"></script>
</head>
<body>
	<?php session_start();
	$usuario = $_SESSION['user'];
	require_once("../funciones.php");
	?>
	<? if(!isset($usuario)) :?>
		<? header("location:../index.html"); ?>
	<? else :?>
			<header class="row">
				<div class="container col-md-8">
					<h1 align='center'>
						Visualización Notas
					</h1>
					<input type='button' id="home" class="btn btn-primary" style='background:url("imagenes/home3.jpg"); float: left; width: 50px; height: 50px;' />
					<div align="center"><img src="imagenes/apa.jpg" /></div>
				</div>
				<div class="container col-md-4">
					<form action='cierre.php'>
						<input style="float: right;" class="btn btn-primary" type='submit' value='Cierra Sesión' />
					</form>
					<input type="button" style="float: right;" class="btn btn-primary" onclick="nota()" value='Nueva Nota' />

				</div>
			</header>
			<section>
				<div class="container" align="center">
						<h3>Filtro de Búsqueda</h3>
								 <br />

								 <input type="hidden" id="gerente" value="<?= $usuario?>" />
								 <input type="text" id="nocliente" class="nocliente" placeholder="NO Cliente"/>
								 <input type="text" id="tag" class="tag" placeholder="Cliente"/>
								 <input type="text" id="fecha" class="fecha" placeholder="Fecha"/>
								 <input type="text" id="folio" class="folio" placeholder="Folio Interno"/>
								 <input type="text" id="recepcion" class="recepcion" placeholder="Folio Recepción"/>
								 <input type="text" id="clave" class="clave" placeholder="Clave Producto"/>
								 <br /><br />
								 <button type="submit" class="btn btn-primary" onclick="filtro(document.querySelector('.nocliente').value, document.querySelector('.tag').value, document.querySelector('.fecha').value, document.querySelector('.folio').value, document.querySelector('.recepcion').value, document.querySelector('.clave').value);">Buscar</button>
								 <button type="submit" class="btn btn-primary" id="limpiaFiltro">Limpiar Campos</button>
								 	<input type="button" class="btn btn-primary" onclick="visualizar()" value='Tabla Completa' />

						<input type=hidden id="folio" value="<?= $folio?>"/>
				</div>
				<br /><br /><br />
			<div class="container" id="principal">
			<!--<table class="table table-striped table-hover">-->
			<table  border=1 align='center' width="1000px">
				<thead>
					<tr>
						<th>Folio Interno</th>
						<th>Folio Recepción</th>
						<th>NO Cliente</th>
						<th>Cliente</th>
						<th>NO SAE</th>
						<th>Total Nota</th>
						<th>Fecha</th>
						<th>Status</th>
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
  <? endif?>

<!--<script src="ajax/js/jquery-2.min.js"></script>-->
<script src="ajax/js/bootstrap.min.js"></script>
<script src="ajax/js/paginator.min.js"></script>
<script src="ajax/js/mainNotas.js"></script>
<script type="text/javascript" src="../js/cierreInactividad.js"></script>


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

				var abrevia_dias = ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"];
			  $('#fecha').datepicker({
			    //dateFormat:'yy-mm-dd'
			    dateFormat: 'dd/mm/yy',
			    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			    changeMonth: false,
			    changeYear: false,
			    dayNamesMin: abrevia_dias,
			    selectOtherMonths: true,
			  });
		});


      function nota(){
          setTimeout("location.href='nota.php'",500);
      }
			function visualizar(){
          setTimeout("location.href='visualizacion.php'",500);
      }
			function saludo(folio){
					setTimeout("location.href='impresionNota.php?folio="+folio+"'");
			}


</script>
</body>
</html>
