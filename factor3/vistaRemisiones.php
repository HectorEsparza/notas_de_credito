<!DOCTYPE html>
<html>
<head>
	<title>Visualización Remisiones</title>
	<link rel="shortcut icon" href="../imagenes/favicon.ico" type="image/x-icon" />
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/verificarSesion.js"></script>
	<script type="text/javascript" src="../js/cierreSesion.js"></script>
	<script type="text/javascript" src="../js/cierreInactividad.js"></script>
    <script type="text/javascript" src="../js/home.js"></script>
    <script type="text/javascript" src="../js/visualizacion.js"></script>
	<script type="text/javascript" src="ajax/eventos/filtroClientes.js"></script>
    <script type="text/javascript" src="ajax/eventos/autocompletarNombreCliente.js"></script>
	<script type="text/javascript" src="../js/formatoNumero.js"></script>
	<script type="text/javascript" src="ajax/eventos/cargarRemisionesCliente.js"></script>
	<script type="text/javascript" src="ajax/eventos/guardarAbono.js"></script>
	
	<style>
		input{
			margin-top: 20px;
		}
		#botonesBusqueda{
			margin-left: 6em;
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
				</div>
			</div>
		</div>
	</header>
	<br /><br />
	<section>
		<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<h4 class="text-center" id="infoCliente"></h4>
					</div>
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
	<!--Ventana modal para ingresar datos de pago-->
	<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="ejemploModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="ejemploModal">Datos del abono</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
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
							<input type="text" class="form-control" id="importeAbono"  value="" readonly />
						</div>
						</div>
						<div class="form-row">
						<div class="form-group col-sm-12 col-md-12">
							<label for="saldoAbono">Saldo actual</label>
							<input type="text" class="form-control" id="saldoAbono"  value="" readonly />
						</div>
						</div>
						<div class="form-row">
						<div class="form-group col-sm-12 col-md-12">
							<label for="importe">Abono</label>
							<input type="number" step="any" class="form-control" id="abono" placeholder="Captura un importe" />
						</div>
						</div>
						<input type="hidden" id="cliente" value="" />
					</form>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancelar" />
					<input type="button" class="btn btn-secondary" id="guardarAbono" value="Abonar" />
				</div>
			</div>
      	</div>
    </div>
	<!--Ventana modal para ver el historial de pagos-->
	<div class="modal fade" id="historial" tabindex="-1" aria-labelledby="historialModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="historialModal">Historial de abonos</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="contenidoHistorial">
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>

	<div id="scriptParaCargas"></div>
	<script>
		$('[data-toggle="popover"]').popover({
			trigger: 'hover',
			container: 'body'
      	});
	</script>
</body>
</html>
