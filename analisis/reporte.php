<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Reporte Precios</title>
    <title>Nuevo Producto</title>
    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="ajax/eventos/lineas.js"></script>
    <script type="text/javascript" src="ajax/eventos/consultas.js"></script>
  </head>
  <body>
    <div class="row">
      <div class="container col-md-4" style="margin-left: 500px">
        <h1>Reporte de Precios</h1>
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
      <div class="container col-md-3" style="margin-left: 400px; margin-top:100px">
        <p>
          <label for="Linea">Línea</label>
          <select  name="linea" style="margin-left: 22px;" id="linea">
            <option value=""></option>
            <option value="Total">Total</option>
            <option value="Soporte APA">Soporte APA</option>
            <option value="Soporte Importado">Soporte Importado</option>
            <option value="Manguera">Manguera</option>
          </select>
        </p>
        <p>
          <label for="Sublinea">Sublínea</label>
            <select  name="sublinea" id="sublinea">
            </select>
        </p>
      </div>
      <div class="container col-md-3" style="margin-top:100px;">
        <p>
          <label for="descuentoApa">Descuento APA</label>
          <select class="" name="descuentoApa" id="descuentoApa">
            <option value=""></option>
            <option value="53.25">45-15</option>
            <option value="55.59">45-15-5</option>
            <option value="57.93">45-15-10</option>
            <option value="60.26">45-15-15</option>
            <option value="62.60">45-15-20</option>
            <option value="64.94">45-15-25</option>
            <option value="67.28">45-15-30</option>
            <option value="69.61">45-15-35</option>
          </select>
        </p>
        <p>
          <label for="descuentoVazlo">Descuento Vazlo</label>
          <select class="" name="descuentoVazlo" id="descuentoVazlo">
            <option value=""></option>
            <option value="19">19%</option>
            <option value="20">20%</option>
            <option value="28">28%</option>
          </select>
        </p>
      </div>
    </div>
    <div class="row" style="margin-left: 400px; margin-top:50px; ">
      <div class="container col-md-8">
        <p>
          <h4 style="font-weight: bold;">Promedio de Variaciones Competencia vs APA</h4>
        </p>
        <table border="1" width='100px'>
          <tr>
            <th>Productos n</th>
            <th>Variación %</th>
            <th>Variación $</th>
          </tr>
          <tr>
            <td id="productos">&nbsp;</td>
            <td id="porcentaje">&nbsp;</td>
            <td id="cantidad">&nbsp;</td>
          </tr>
        </table>
      </div>
    </div>
    <div class="row" style="margin-left: 400px; margin-top:50px; ">
      <div class="container col-md-8">
        <p>
          <h4 style="font-weight: bold;">Resultados de la consulta</h4>
        </p>
        <table border="1" width='100px'>
          <tr>
            <td>&nbsp;</td>
            <td style="font-weight: bold;">Porcentaje</td>
            <td style="font-weight: bold;">Productos n</td>
          </tr>
          <tr>
            <td style="font-weight: bold;">Estamos Caros</td>
            <td id="porcentajeCaro">&nbsp;</td>
            <td id="cantidadCaro">&nbsp;</td>
          </tr>
          <tr>
            <td style="font-weight: bold;">Iguales</td>
            <td id="porcentajeIgual">&nbsp;</td>
            <td id="cantidadIgual">&nbsp;</td>
          </tr>
          <tr>
            <td style="font-weight: bold;">Estamos Baratos</td>
            <td id="porcentajeBarato">&nbsp;</td>
            <td id="cantidadBarato">&nbsp;</td>
          </tr>
          <tr>
            <td style="font-weight: bold;">TOTAL REAL</td>
            <td id="totalPorcentaje">&nbsp;</td>
            <td id="totalCantidad">&nbsp;</td>
          </tr>
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
