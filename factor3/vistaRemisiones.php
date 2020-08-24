<!DOCTYPE html>
<html>

<head>
	<title>Visualización Remisiones</title>
	<link rel="shortcut icon" href="../imagenes/favicon.ico" type="image/x-icon" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/verificarSesion.js"></script>
	<script type="text/javascript" src="../js/cierreSesion.js"></script>
	<script type="text/javascript" src="../js/cierreInactividad.js"></script>
	<script type="text/javascript" src="../js/home.js"></script>
	<script type="text/javascript" src="../js/visualizacion.js"></script>
	<script type="text/javascript" src="../js/paginator.min.js"></script>
	<script type="text/javascript" src="../js/formatoNumero.js"></script>
	<script type="text/javascript" src="../js/fechaDatepicker.js"></script>
	<script type="text/javascript" src="../js/recargarPagina.js"></script>
	<script type="text/javascript" src="ajax/eventos/guardarAbono.js"></script>
	<script type="text/javascript" src="ajax/js/mainVistaRemisiones.js"></script>
	<script type="text/javascript" src="ajax/eventos/filtroRemisiones.js"></script>

	<style>
		input {
			margin-top: 20px;
		}

		#botonesBusqueda {
			margin-left: 6em;
		}

		.thead-dark {
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
					<h1 class="text-center">Visualización Remisiones</h1>
				</div>
				<div class="col-sm-12 col-md-2">
					<input class="btn btn-danger" type='button' id="cierreSesion" value='Cierra Sesión' />
				</div>
			</div>
			<br />
			<div class="row">
				<div class="col-sm-12 col-md-4">
					<input type="button" class="btn btn-success" id="visualizacion" value="Regresar" />
				</div>
				<div class="col-sm-12 col-md-8">
					<h4 style="margin: 2em 4em 0em 0em;" id="infoCliente"></h4>
				</div>
			</div>
		</div>
	</header>
	<br /><br />
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-4"></div>
				<div class="col-sm-12 col-md-4">
					<h3 class="text-left">Filtro de Búsqueda</h3>
				</div>
				<div class="col-sm-12 col-md-4"></div>
			</div>
			<div class="row form-group">
				<div class="col-sm-12 col-md-6">
					<input type="text" id="folio" class="folio form-control" placeholder="Folio de Remisión" />
				</div>
				<div class="col-sm-12 col-md-6">
					<input type="text" id="fecha" class="fecha form-control" placeholder="Fecha de elaboración" />
				</div>
			</div>
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
			<div class="row">
				<div class="col-sm-12 col-md-3"></div>
				<div class="col-sm-12 col-md-5">
					<ul class="pagination" id="paginador"></ul>
				</div>
				<div class="col-sm-12 col-md-4"></div>
			</div>
			<br /><br />
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-striped text-center">
							<thead class="thead-dark">
								<th>Folio</th>
								<th>Fecha de Elaboración</th>
								<th>Importe</th>
								<th>Saldo</th>
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
	<!--Ventanas de jquery UI para cargar abono e historial de abonos-->
	<div id="abonoVista" title="Datos de la remisión" hidden>
		<form>
			<div class="form-row">
				<div class="form-group col-sm-12 col-md-12">
					<label for="remisionAbono">Remisión</label>
					<input type="text" class="form-control" id="remisionAbono" value="" readonly />
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-sm-12 col-md-12">
					<label for="importeAbono">Importe total</label>
					<input type="text" class="form-control" id="importeAbono" value="" readonly />
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-sm-12 col-md-12">
					<label for="saldoAbono">Saldo actual</label>
					<input type="text" class="form-control" id="saldoAbono" value="" readonly />
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-sm-12 col-md-12">
					<label for="importe">Abono</label>
					<input type="number" step="any" class="form-control" id="abono" placeholder="Captura un importe" />
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-sm-12 col-md-12">
					<label for="importe">Observaciones</label>
					<input type="text" class="form-control" id="observaciones" placeholder="Captura una observación (opcional)" />
				</div>
			</div>
			<input type="hidden" id="cliente" value="" />
		</form>
	</div>
	<div id="contenidoHistorial" title="Historial de abonos" hidden>
		
	</div>
	<div id="scriptParaCargas"></div>
	<script>

	</script>
</body>

</html>