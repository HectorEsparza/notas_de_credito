<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="" content="" />
    <meta name="" content="" />
    <title>Nuevo Producto</title>
    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="ajax/js/jquery-ui.js"></script>
    <script type="text/javascript" src="ajax/eventos/activaEnvio.js"></script>
    <script type="text/javascript" src="ajax/eventos/idRepetido.js"></script>
    <script type="text/javascript" src="ajax/eventos/idRepetidoVazlo.js"></script>
  </head>
  <body>
    <div class="row">
      <div class="container col-md-4" style="margin-left: 500px">
        <h1>Captura Nuevo Producto</h1>
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
          <form action='guardaProducto.php' method='post'>
             <tr>
               <td colspan=2 align='center'><img src='imagenes/apa.jpg' class="img-responsive"></td>
             </tr>
             <tr>
               <div class="form-group">
                 <th><label for="idApa">ID APA</label></th>
                 <td><input class="form-control" id="idApa" type='text' name='idApa' required></td>
               </div>
             </tr>
             <tr>
               <div class="form-group">
                 <th><label for="descripcion">Descripción</label></th>
                 <td><input class="form-control" id="descripcion" type='text' name='descripcion' required></td>
               </div>
             </tr>
             <tr>
               <div class="form-group">
                 <th><label for="precio">Precio</label></th>
                 <td><input class="form-control" id="precio" type='number' name='precio' step="any" required></td>
               </div>
             </tr>
             <tr>
               <div class="form-group">
                 <th><label for="linea">Línea</label></th>
                 <td>
                   <select class="form-control" id="linea" name="linea" required>
                     <option value=""></option>
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
                   <select class="form-control" id="sublinea" name="sublinea" required>
                     <option value=""></option>
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
                 <td><input class="form-control" id="idVazlo" type='text' name='idVazlo'></td>
               </div>
             </tr>
             <tr>
               <div class="form-group">
                 <th><label for="precioVazlo">Precio Vazlo</label></th>
                 <td><input class="form-control" id="precioVazlo" type='text' name='precioVazlo' readonly></td>
               </div>
             </tr>
             <tr>
               <td align='center' colspan=2><input type='submit' name='inicio' value='Guardar' id="envio" disabled class="btn btn-success"></td>
             </tr>
          </form>

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
