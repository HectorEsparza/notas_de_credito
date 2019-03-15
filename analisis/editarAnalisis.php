<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="" content="" />
    <meta name="" content="" />
    <title>Edición Producto</title>
    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="ajax/js/jquery-ui.js"></script>
    <script type="text/javascript" src="ajax/eventos/activaEnvio.js"></script>
    <!-- <script type="text/javascript" src="ajax/eventos/idRepetido.js"></script>
    <script type="text/javascript" src="ajax/eventos/idRepetidoVazlo.js"></script> -->
    <script type="text/javascript" src="ajax/eventos/activaCampos.js"></script>
  </head>
  <body>
    <?php
      require_once("../funciones.php");
      $folio = $_GET['folio'];

      $base = conexion_local();
      $consulta = "SELECT * FROM PRODUCTOS1 WHERE CLAVEDEARTÍCULO=?";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($folio));
      $registro = $resultado->fetch(PDO::FETCH_NUM);

      $idApa = $registro[0];
      $descripcion = $registro[1];
      $precio = $registro[2];
      $linea = $registro[3];
      $sublinea = $registro[4];
      $idVazlo = $registro[5];
      $precioVazlo = $registro[6];
      $importancia = $registro[7];

      $resultado->closeCursor();

      if($idVazlo==""){
        $idVazlo = "NA";
      }
      if($precioVazlo==""){
        $precioVazlo = 0.00;
      }


      //echo $folio;
    ?>
    <div class="row">
      <div class="container col-md-4" style="margin-left: 250px">
        <h1>Editar Producto <?= $folio ?></h1>
      </div>
      <div class="container col-md-2">
        <input style="margin-top: 25px" type="button" class="btn btn-warning" value="Editar" id="habilitaCampos" />
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
      <div class="container col-md-8">
        <table style="margin-top: 25px; margin-left: 100px;"class="table table-bordered table-condensed table-responsive">
          <!-- <form action='actualizaProducto.php' method='post'> -->
             <tr>
               <td colspan=2 align='center'><img src='imagenes/apa.jpg' class="img-responsive"></td>
             </tr>
             <tr>
               <div class="form-group">
                 <th><label for="idApa">ID APA</label></th>
                 <td><input class="form-control" id="idApa" type='text' name='idApa' value="<?= $idApa ?>" required readonly></td>
               </div>
             </tr>
             <tr>
               <div class="form-group">
                 <th><label for="descripcion">Descripción</label></th>
                 <td><input class="form-control" id="descripcion" type='text' name='descripcion' value="<?= $descripcion ?>" required readonly></td>
               </div>
             </tr>
             <tr>
               <div class="form-group">
                 <th><label for="precio">Precio</label></th>
                 <td><input class="form-control" id="precio" type='number' name='precio' step="any" value="<?= $precio ?>" required readonly></td>
               </div>
             </tr>
             <tr>
               <div class="form-group">
                 <th><label for="linea">Línea</label></th>
                 <td>
                   <select class="form-control" id="linea" name="linea" required disabled>
                     <option value="<?= $linea ?>"><?= $linea?></option>
                     <option value="Manguera">Manguera</option>
                     <option value="Soporte APA">Soporte APA</option>
                     <option value="Soporte Importado">Soporte Importado</option>
                   </select>
                 </td>
               </div>
             </tr>
             <tr>
               <div class="form-group">
                 <th><label for="sublinea">Sublínea</label></th>
                 <td>
                   <select class="form-control" id="sublinea" name="sublinea" required disabled>
                     <option value="<?= $sublinea?>"><?= $sublinea?></option>
                     <option value="Bases de Amortiguador">Bases de Amortiguador</option>
                     <option value="Codos de Aire">Codos de Aire</option>
                     <option value="Codos y Coples de Silicón">Codos y Coples de Silicón</option>
                     <option value="Coples de Admisión">Coples de Admisión</option>
                     <option value="Gomas, Tapas y Conjuntos Para Cardán">Gomas, Tapas y Conjuntos Para Cardán</option>
                     <option value="Manguera Charter">Manguera Charter</option>
                     <option value="Manguera de Purificador">Manguera de Purificador</option>
                     <option value="Manguera de Silicón Turbo con Anillos">Manguera de Silicón Turbo con Anillos</option>
                     <option value="Manguera Moldadea">Manguera Moldadea</option>
                     <option value="Manguera Recta Silicón Naranja">Manguera Recta Silicón Naranja</option>
                     <option value="Manguera Recta Silicón Verde">Manguera Recta Silicón Verde</option>
                     <option value="Manguera Tanque de Gasolina">Manguera Tanque de Gasolina</option>
                     <option value="Soportes Para Motor y Transmisión">Soportes Para Motor y Transmisión</option>
                     <option value="Varillas, Ganchos y Topes">Varillas, Ganchos y Topes</option>
                   </select>
                 </td>
               </div>
             </tr>
             <tr>
               <div class="form-group">
                 <th><label for="idVazlo">ID Vazlo</label></th>
                 <td><input class="form-control" id="idVazlo" type='text' value="<?= $idVazlo?>" name='idVazlo' readonly></td>
               </div>
             </tr>
             <tr>
               <div class="form-group">
                 <th><label for="precioVazlo">Precio Vazlo</label></th>
                 <td><input class="form-control" id="precioVazlo" type='number' step="any" value="<?= $precioVazlo?>" name='precioVazlo' readonly></td>
               </div>
             </tr>
             <tr>
               <div class="form-group">
                 <th><label for="importancia">Importancia</label></th>
                 <td><input class="form-control" id="importancia" type='text' value="<?= $importancia?>" name='importancia' readonly></td>
               </div>
             </tr>
             <input type="hidden" name="anteriorApa" id="anteriorApa" value="<?= $idApa ?>" />
             <input type="hidden" name="anteriorVazlo" value="<?= $idVazlo ?>" />
             <tr>
               <td align='center' colspan=2><input type='button' name='inicio' value='Confirmar' id="envio" class="btn btn-success" disabled></td>
             </tr>
          <!-- </form> -->

        </table>
      </div>
    </div>
    <script>
      function visualizar(){
          setTimeout("location.href='analisis.php'",500);
      }
    </script>
  </body>
</html>
