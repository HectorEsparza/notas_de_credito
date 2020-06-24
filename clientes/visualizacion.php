<!DOCTYPE html>
<html>
<head>
	<title>Visualización Clientes</title>
	<link rel="shortcut icon" href="../imagenes/favicon.ico" type="image/x-icon" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/verificarSesion.js"></script>
	<script type="text/javascript" src="../js/cierreSesion.js"></script>
	<script type="text/javascript" src="../js/cierreInactividad.js"></script>
	<script type="text/javascript" src="../js/paginator.min.js"></script>
	<script type="text/javascript" src="ajax/js/main.js"></script>
	<script type="text/javascript" src="ajax/js/formularioClientesVendedores.js"></script>
	<script type="text/javascript" src="ajax/eventos/autocompletarNombreCliente.js"></script> 
	<script type="text/javascript" src="ajax/eventos/autocompletarNombreVendedor.js"></script>
	<script type="text/javascript" src="ajax/eventos/obtenerEstatus.js"></script>
	<script type="text/javascript" src="ajax/eventos/obtenerDescuento.js"></script>
	<script type="text/javascript" src="ajax/eventos/filtroClientes.js"></script>

	<style>
		select, input{
			height: 25px;
		}
	</style>
	
</head>
<body>
	<header class="row">
		<div class="container col-md-6">
			<h1 align='center'>
				Visualización Clientes
			</h1>
			<input type='button' id="home" class="btn btn-primary" style='background:url("../imagenes/home3.jpg"); float: left; width: 50px; height: 50px;' />
			<div align="center"><img src="../imagenes/apa.jpg" /></div>
		</div>
		<div class="container col-md-6">
			<input style="float: right;" class="btn btn-danger" type='button' id="cierreSesion" value='Cierra Sesión' />
			<input style="float: right;" class="btn btn-success" type='button' id="registrosYactualizaciones" value='Registros/Actualizaciones' />
		</div>
	</header>
	<section>
		<div class="container" align="center">
				<h3>Filtro de Búsqueda</h3>
						 <br />
						 <input type="text" id="idCliente" class="idCliente" placeholder="Número de Cliente"/>
						 <input type="text" id="nombre" class="nombre" placeholder="Nombre"/>
						 <select name="estatus" id="estatus"></select>
						 <select name="descuento" id="descuento"></select>
						 <input type="text" id="vendedor" class="estatus" placeholder="Vendedor"/>
						 <br /><br />
						 <input type="button" class="btn btn-primary" id="buscar" value="Buscar" />
						 <!-- <button type="submit" class="btn btn-primary" id="limpiaFiltro">Limpiar Campos</button> -->
						 <input type="button" class="btn btn-primary" onclick="visualizar()" value='Tabla Completa' />
		</div>
		<br /><br />
		<div class="container">
			<div class="row justify-content-md-center">
				<div class="col col-md-4"></div>
				<div  class="col col-md-4" id="formularioParaCargas"></div>
				<div class="col col-md-4"></div>
			</div>
		</div>
	<div class="col-md-12 text-center">
		<ul class="pagination" id="paginador"></ul>
	</div>
	<div class="container" id="principal">
	<!--<table class="table table-striped table-hover">-->
	<table  border=1 align='center' width="100%" style="text-align: center;">
		<thead>
			<tr style="font-weight: bold;">
				<td>Número Cliente</td>
				<td>Nombre</td>
				<td>Descuento</td>
				<td>RFC</td>
				<td>Estatus</td>
				<td>Vendedor</td>
			</tr>
		</thead>
		<tbody id="table">

		</tbody>
	</table>
	<br /><br />
	</div>
	</section>	
	<div id="scriptParaCargas"></div>
<script type="text/javascript">

			$(document).ready(function(){

									$("#home").click(function(){

										setTimeout("location.href='../home.php'", 500);
									});
			});


    //   function nuevoFacturas(){
    //       setTimeout("location.href='nuevoContadoFacturas.php'",500);
    //   }
	//   function nuevoRemisiones(){
    //       setTimeout("location.href='nuevoContadoRemisiones.php'",500);
    //   }
	//   function visualizar(){
    //       setTimeout("location.href='visualizacion.php'",500);
    //   }
	//   function ver(folio){
	// 	  setTimeout("location.href='impresion.php?folio="+folio+"'");
	//   }
	//   function facturas(){
	// 	  setTimeout("location.href='facturas.php'",500);
	//   }
	//   function facturasSinContado(){
	// 	  setTimeout("location.href='facturasSinContado.php'",500);
	//   }


</script>
</body>
</html>
