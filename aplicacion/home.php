<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="" content="" />
  <meta name="" content="" />
  <link rel="shortcut icon" href="../imagenes/favicon.ico" type="image/x-icon" />
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/estiloHome.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="../js/verificarSesion.js"></script>
  <script type="text/javascript" src="../js/cierreSesion.js"></script>
  <script type="text/javascript" src="../js/cierreInactividad.js"></script>
  <script type="text/javascript" src="../js/cargarModulos.js"></script>
  <title>Home</title>
</head>

<body>
  <header>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-4">
          <img class="img-responsive rounded mx-auto d-block" id="imagen" src='../imagenes/apa.png' />
        </div>
        <div class="col-sm-12 col-md-4">
          <h1>Bienvenidos!</h1>
        </div>
        <div class="col-sm-12 col-md-4">
          <input class="btn btn-danger" type='button' id="cierreSesion" value='Cierra Sesión' />
        </div>
      </div>
    </div>
  </header>
  <br /><br />
  <section>
    <div class="container">
      <div class="row" id="modulos">

      </div>
    </div>
  </section>
</body>

</html>