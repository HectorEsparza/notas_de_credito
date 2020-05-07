<!DOCTYPE html>
<html>
<head>
	<title>Visualización</title>
	<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
  <script type="text/javascript" src="ajax/js/jquery-ui.js"></script>
	<script type="text/javascript" src="ajax/eventos/filtroContado.js"></script>
	<script type="text/javascript" src="ajax/eventos/facturas.js"></script>
	<script type="text/javascript" src="../js/verificarSesion.js"></script>
	<!-- <script type="text/javascript" src="ajax/js/limpia.js"></script> -->
	<!-- <script type="text/javascript" src="ajax/js/limpiaFiltro.js"></script> -->
</head>
<body>
	<header class="row">
		<div class="container col-md-6">
			<h1 align='center'>
				Visualización Contados
			</h1>
			<input type='button' id="home" class="btn btn-primary" style='background:url("imagenes/home3.jpg"); float: left; width: 50px; height: 50px;' />
			<div align="center"><img src="imagenes/apa.jpg" /></div>
		</div>
		<div class="container col-md-6">
			<form action='../cierre.php'>
				<input style="float: right;" class="btn btn-danger" type='submit' value='Cierra Sesión' />
			</form>
			<input type="button" style="float: right;" class="btn btn-success" id="nuevoContado" onclick=" nuevoContado()" value='Nuevo Contado' />
		</div>
	</header>
	<section>
		<div class="container" align="center">
				<h3>Filtro de Búsqueda</h3>
						 <br />

						 <input type="hidden" id="gerente" value="<?= $usuario?>" />
						 <input type="text" id="idContado" class="idContado" placeholder="ID Contado"/>
						 <input type="text" id="fecha" class="fecha" placeholder="Fecha Inicio"/>
						 <input type="text" id="fechaFin" class="fechaFin" placeholder="Fecha Fin"/>
						 <br /><br />
						 <input type="button" class="btn btn-primary" id="buscar" value="Buscar" />
						 <!-- <button type="submit" class="btn btn-primary" id="limpiaFiltro">Limpiar Campos</button> -->
						 <input type="button" class="btn btn-primary" onclick="visualizar()" value='Tabla Completa' />
						 <input type="button" class="btn btn-primary" onclick="facturas()"   id="factura" value="Facturas" />
						 <input type="button" class="btn btn-primary" onclick="facturasSinContado()"   id="sinEntrada" value="Facturas sin Contado" />


				<input type=hidden id="folio" value="<?= $folio?>"/>
		</div>
		<br /><br />
	<div class="col-md-12 text-center">
		<ul class="pagination" id="paginador"></ul>
	</div>
	<div class="container" id="principal">
	<!--<table class="table table-striped table-hover">-->
	<table  border=1 align='center' width="500px" style="text-align: center;">
		<thead>
			<tr style="font-weight: bold;">
				<td>ID Contado</td>
				<td>Fecha</td>
				<td>Total</td>
				<td>Usuario</td>
        <td>Info</td>
			</tr>
		</thead>
		<tbody id="table">

		</tbody>
	</table>
	<br /><br />
	</div>

<!--<script src="ajax/js/jquery-2.min.js"></script>-->
<script src="ajax/js/bootstrap.min.js"></script>
<script src="ajax/js/paginator.min.js"></script>
<script src="ajax/js/main.js"></script>
<!-- <script src="ajax/eventos/cierreInactividad.js"></script> -->


<script type="text/javascript">

			$(document).ready(function(){

									$("#home").click(function(){

										setTimeout("location.href='../home.php'", 500);
									});
			});


      function nuevoContado(){
          setTimeout("location.href='nuevoContado.php'",500);
      }
			function visualizar(){
          setTimeout("location.href='visualizacion.php'",500);
      }
			function ver(folio){
					setTimeout("location.href='impresion.php?folio="+folio+"'");
			}
			function facturas(){
				setTimeout("location.href='facturas.php'",500);
			}
			function facturasSinContado(){
				setTimeout("location.href='facturasSinContado.php'",500);
			}


</script>
</body>
</html>
