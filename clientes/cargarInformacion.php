<!DOCTYPE html>
<html>
<head>
	<title>Información a cargar</title>
	<link rel="shortcut icon" href="../imagenes/favicon.ico" type="image/x-icon" />
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="../js/verificarSesion.js"></script>
  <script type="text/javascript" src="../js/cierreSesion.js"></script>
	<script type="text/javascript" src="../js/cierreInactividad.js"></script>
  <script type="text/javascript" src="../js/visualizacion.js"></script>
  <script type="text/javascript" src="ajax/eventos/leerArchivo.js"></script>
</head>
<body>
	<br />
	<div class="container">
			<div class="row justify-content-md-center">
				<div class="col col-md-3 col-sm-12">
        		</div>
				<div class="col col-md-3 col-sm-12">
					<input type="button" class="btn btn-warning" id="visualizacion" value="Cancelar"/>
        		</div>
				<div class="col col-md-3 col-sm-12">
        		</div>
				<div class="col col-md-3 col-sm-12">
					<input type="button" class="btn btn-danger" id="cierreSesion" value="Cierra Sesión"/>	
        		</div>
			</div> 
	</div>
	<br />
	<div class="container">
			<div class="row justify-content-md-center">
				<div class="col col-md-4"></div>
				<div  class="col col-md-4" id="encabezado"></div>
				<div class="col col-md-4"></div>
			</div>
		</div>
	<br />
	<div class="container">
			<div class="row justify-content-md-center" id="principal">
				<div class="col col-md-4"></div>
				<div  class="col col-md-4"></div>
				<div class="col col-md-4"></div>
			</div>
	</div>
	<div id="scriptParaCargas"></div>
</body>
</html>
