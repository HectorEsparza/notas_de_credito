<!DOCTYPE html>
<html>
<head>
	<title>Visualización Factor 3</title>
	<link rel="shortcut icon" href="../imagenes/favicon.ico" type="image/x-icon" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/verificarSesion.js"></script>
	<script type="text/javascript" src="../js/cierreSesion.js"></script>
	<script type="text/javascript" src="../js/cierreInactividad.js"></script>
	<script type="text/javascript" src="../js/paginator.min.js"></script>
	<script type="text/javascript" src="../js/home.js"></script>
	<script type="text/javascript" src="../js/recargarPagina.js"></script>
	<script type="text/javascript" src="ajax/js/main.js"></script>
	<script type="text/javascript" src="ajax/eventos/filtroClientes.js"></script>
	<script type="text/javascript" src="ajax/eventos/autocompletarNombreCliente.js"></script>
	
	<style>
		input{
			margin-top: 20px;
		}
		#botonesBusqueda{
			margin-left: 6em;
		}
		.thead-dark{
			color: #fff;
			background-color: #343a40;
			border-color: #454d55;
		}
	</style>
</head>
<body>
	<header>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-2">
					<img src="../imagenes/apa.jpg" class="rounded mx-auto d-block" alt="APA">
				</div>
				<div class="col-sm-12 col-md-8">
					<h1 class="text-center">Visualización Factor 3</h1>
				</div>
				<div class="col-sm-12 col-md-2">
					<input class="btn btn-danger" type='button' id="cierreSesion" value='Cierra Sesión' />
				</div>
			</div>
			<br />
			<div class="row">
				<div class="col-sm-12 col-md-4">
					<input type='button' id="home" class="btn btn-primary" style='background:url("../imagenes/home3.jpg"); width: 50px; height: 50px;' />
				</div>
				<div class="col-sm-12 col-md-8">
						<h3 class="text-left">Filtro de Búsqueda</h3>
						<ul class="pagination" id="paginador"></ul>
				</div>
			</div>
		</div>
	</header>
	<section>
		<div class="container">
				<div class="row form-group">
					<div class="col-sm-12 col-md-6">
						<input type="text" id="idCliente" class="idCliente form-control" placeholder="Número de Cliente"/>
					</div>
					<div class="col-sm-12 col-md-6">
						<input type="text" id="nombre" class="nombre form-control" placeholder="Nombre"/>
					</div>
				</div>
				<br />
				<div class="row">
					<div class="col-sm-12 col-md-4">
						
					</div>
					<div class="col-sm-12 col-md-4" id="botonesBusqueda">
						<input type="button" class="btn btn-primary" id="buscar" value="Buscar" />
						<input type="button" class="btn btn-primary" id="recargar" value='Tabla Completa' />
					</div>
					<div class="col-sm-12 col-md-4">
						
					</div>
				</div>
				<br />
				<!-- <div class="row">
					<div class="col-sm-12 col-md-12 text-center">
						<ul class="pagination" id="paginador"></ul>
					</div>
				</div>		 -->
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<div class="table-responsive">
							<table class="table table-bordered table-striped">
								<thead class="thead-dark">
									<th>Número Cliente</th>
									<th>Nombre</th>
									<th>Info</th>
								</thead>
								<tbody id="table">

								</tbody>
							</table>
						</div>
					</div>
				</div>			
		</div>
	</section>	
	<div id="scriptParaCargas"></div>
</body>
</html>
