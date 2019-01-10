<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Ver</title>
    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
  	<link href="css/bootstrap.min.css" rel="stylesheet">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
    <script type="text/javascript" src="ajax/js/jquery-ui.js"></script>
  </head>
  <body>
    <?php
        $folio = $_GET['folio'];
        require_once("../funciones.php");
        $base = conexion_local();
        $consulta = "SELECT PRECIO, ID_VAZLO FROM APA1 WHERE ID_APA=?";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($folio));
        $registro = $resultado->fetch(PDO::FETCH_NUM);
        $precioAPA = "$" . $registro[0];
        $idVazlo = $registro[1];
        $resultado->closeCursor();

        $consulta = "SELECT PRECIO FROM VAZLO1 WHERE ID_VAZLO=?";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($idVazlo));
        $registro = $resultado->fetch(PDO::FETCH_NUM);
        $precioVazlo = "$" . $registro[0];
        $resultado->closeCursor();

        if($idVazlo==""){

          $idVazlo= "NA";
          $precioVazlo = "NA";
        }
    ?>
    <div class="row">
      <div class="container col-md-4" style="margin-left: 500px">
        <h1>Producto <?= $folio?></h1>
      </div>
      <div class="container col-md-2">
        <input style="margin-top: 25px" type="button" class="btn btn-primary" value="Regresar" onclick="visualizar()" />
      </div>
      <div class="container col-md-2">
        <form action='../cierre.php'>
  				<input style="margin-top: 25px" class="btn btn-danger" type='submit' value='Cierra Sesión' />
  			</form>
      </div>
    </div>
    <div class="row">
      <div class="container col-md-8" style="margin-left: 100px">
        <div class="table-responsive">
          <table class="table table-bordered table-condensed table-hover">
            <tr>
              <th>ID APA</th>
              <th>Precio</th>
              <th>ID Vazlo</th>
              <th>Precio</th>
              <!-- <th>Info</th> -->
            </tr>
            <tr align='center'>
              <td><?= $folio?></td>
              <td><?= $precioAPA?></td>
              <td><?= $idVazlo?></td>
              <td><?= $precioVazlo?></td>
              <!-- <td><input type="button" class="btn btn-info" value="Análisis" /></td> -->
            </tr>
          </table>
        </div>
      </div>
    </div>
    <!-- <div class="row">
      <div class="container col-md-8">
        <h3 style="margin: 300px;">Zona de gráficos</h3>
      </div>
    </div> -->
  <script>
    function visualizar(){
        setTimeout("location.href='analisis.php'",500);
    }
  </script>
  </body>
</html>
