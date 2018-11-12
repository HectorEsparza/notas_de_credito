<!DOCTYPE html>
<html>
<head>
	<title>Visualización</title>
	<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="css/estiloAltas.css" />
  <script type="text/javascript" src="ajax/js/jquery-ui.js"></script>
	<script type="text/javascript" src="ajax/eventos/formularioRecursos.js"></script>
	<script type="text/javascript" src="ajax/eventos/filtroGerentes.js"></script>
	<script type="text/javascript" src="ajax/eventos/filtroUsuarios.js"></script>
	<!-- <script type="text/javascript" src="ajax/js/filtroVentas.js"></script> -->
	<!-- <script type="text/javascript" src="ajax/js/limpia.js"></script> -->
	<script type="text/javascript" src="ajax/eventos/limpiaFiltro.js"></script>
</head>
<body>
	<?php session_start();
	$usuario = $_SESSION['user'];
	require_once("../funciones.php");

	try
	{
		$base = conexion_local();
		$consulta="SELECT DEPARTAMENTO FROM USUARIOS WHERE USUARIO=?";
		$resultado = $base->prepare($consulta);
		$resultado-> execute(array($usuario));
		$registro = $resultado->fetch(PDO::FETCH_NUM);
		$departamento = $registro[0];


	if(!isset($usuario))
	{
		header("location:../index.html");
	}
	else
	{
		// $folio = $_POST['folio'];
	?>
  <input type="text" value="<?= $departamento?>" id="departamento" hidden />
	<header class="row">
		<div class="container col-md-8">
			<h1 align='center'>
				Visualización Altas
			</h1>
			<input type='button' id="home" class="btn btn-primary" style='background:url("imagenes/home3.jpg"); float: left; width: 50px; height: 50px;' />
			<div align="center"><img src="imagenes/apa.jpg" /></div>
		</div>
		<div class="container col-md-4">
			<form action='../cierre.php'>
				<input style="float: right;" class="btn btn-primary" type='submit' value='Cierra Sesión' />
			</form>
			<input type="button" style="float: right;" class="btn btn-primary" onclick="registro()" id="new" value='Nuevo Registro' />

		</div>
	</header>
	<section>
		<div class="container" align="center">
				<h3>Filtro de Búsqueda</h3>
						 <br />

						 <input type="hidden" id="gerente" value="<?= $usuario?>" />
						 <input type="text" id="empleado" class="empleado" placeholder="Número Empleado"/>
						 <input type="text" id="nombre" class="nombre" placeholder="Nombre"/>
						 <!-- <input type="text" id="Status" class="folio" placeholder="Folio Interno"/> -->
						 <br /><br />
						 <button type="submit" class="btn btn-primary" id="gerentes" >Buscar</button>
						 <button type="submit" class="btn btn-primary" id="usuarios">Buscar Usuarios</button>
						 <!-- <button type="submit" class="btn btn-primary" id="gerentes" onclick="filtro(document.querySelector('.nocliente').value, document.querySelector('.tag').value, document.querySelector('.fecha').value, document.querySelector('.folio').value, document.querySelector('.recepcion').value);">Buscar</button>
						 <button type="submit" class="btn btn-primary" id="usuarios" onclick="filtro(document.querySelector('.nocliente').value, document.querySelector('.tag').value, document.querySelector('.fecha').value, document.querySelector('.folio').value, document.querySelector('.recepcion').value);">Buscar Usuarios</button> -->
						 <button type="submit" class="btn btn-primary" id="limpiaFiltro">Limpiar Campos</button>
						 	<input type="button" class="btn btn-primary" onclick="visualizar()" value='Tabla Completa' />

				<input type=hidden id="folio" value="<?= $folio?>"/>
		</div>
		<br /><br /><br />
	<div class="container" id="principal" style="float: left">
	<!--<table class="table table-striped table-hover">-->
	<table  border=1 >
		<thead>
			<tr id='nombreColumnas'>

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

<!-- <script src="ajax/js/jquery-2.min.js"></script> -->
<script src="ajax/js/bootstrap.min.js"></script>
<script src="ajax/js/paginator.min.js"></script>
<script src="ajax/js/main.js"></script>
<!-- <script src="ajax/eventos/cierreInactividad.js"></script> -->


<script type="text/javascript">

			$(document).ready(function(){

									// $('#tag').autocomplete({
									// 		source: function(request, response){
									// 				$.ajax({
									// 						url:"colores.php",
									// 						dataType:"json",
									// 						data:{q:request.term},
									// 						success: function(data){
									// 								response(data);
									// 						}
									// 				});
									// 		},
									// 		minLength:3,
									// 		select: function(event, ui){
									// 				//alert("Selecciono: "+ui.item.label);
									// 		}
									// });
									$("#home").click(function(){

										setTimeout("location.href='../home.php'", 500);
									});
                  // $(function(){
                  //   $.datepicker.setDefaults($.datepicker.regional["es"]);
                  //   $("#fecha").datepicker({
                  //     firstDay: 1
                  //   });
                  // });

                  $('#fecha').datepicker({
                    //dateFormat:'yy-mm-dd'
                    //dateFormat: 'dd-mm-yy'
                    dateFormat: 'dd/mm/yy',
                    changeMonth: true,
                    changeYear: true,
                    yearRange: '1940:2000'
                  });
									if($("#departamento").val()=="RECURSOS_HUMANOS"||$("#departamento").val()=="CONTABILIDAD"){
										$('<th>ID</th>'+
										'<th>NO Empleado</th>'+
										'<th>Nombre</th>'+
										'<th>Curp</th>'+
										'<th>RFC</th>'+
										'<th>NSS</th>'+
										'<th>Salario Diario</th>'+
										'<th>Salario Semanal</th>'+
										'<th>Departamento</th>'+
										'<th>Puesto</th>'+
										'<th>Fecha Alta</th>'+
										'<th>Bancomer</th>'+
										'<th>Si Vale</th>'+
										'<th>Calle y Número</th>'+
										'<th>Colonia</th>'+
										'<th>CP</th>'+
										'<th>Población</th>'+
										'<th>Fecha Nacimiento</th>'+
										'<th>Teléfono Personal</th>'+
										'<th>Teléfono Emergencia</th>'+
										'<th>Persona Emergencia</th>'+
										'<th>Correo</th>'+
										'<th>Estado Civil</th>'+
										'<th>Sexo</th>'+
										'<th>Status</th>'+
										'<th>Info</th>').appendTo($("#nombreColumnas"));
									}
									else{
										$('<th>ID</th>'+
										'<th>Fecha Alta</th>'+
										'<th>Departamento</th>'+
										'<th>Puesto</th>'+
										'<th>Nombre</th>'+
										'<th>Status</th>'+
										'<th>Info</th>').appendTo($("#nombreColumnas"));
									}

			});


      function registro(){
          setTimeout("location.href='registro.php'",500);
      }
			function visualizar(){
          setTimeout("location.href='visualizacion.php'",500);
      }
			function saludo(folio){
					setTimeout("location.href='actualizaRegistro.php?folio="+folio+"'");
			}


</script>
</body>
</html>
