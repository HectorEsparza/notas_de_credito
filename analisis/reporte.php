<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Reporte Precios</title>
    <title>Nuevo Producto</title>
    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/estiloReporte.css" /> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="ajax/eventos/lineas.js"></script>
    <script type="text/javascript" src="ajax/eventos/consultas.js"></script>
    <script type="text/javascript" src="ajax/eventos/nivelImportancia.js"></script>
    <style media="screen">
      #caros, .Caro{
        background: #FC6C6C;
      }
      #iguales, .Igual{
        background: #FCE26C;
      }
      #baratos, .Barato{
        background: #6CFC72;
      }
      #totales{
        background: #6CE7FC;
      }
    </style>

  </head>
  <body>
    <div class="row" id="header">
      <div class="container col-md-8" style="margin-left: 0px; text-align: center">
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
      <div class="container col-md-3">

      </div>
      <div class="container col-md-3" style="margin-left: 0px; margin-top:100px;">
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
            <option value="10">10</option>
            <option value="14.5">10-5</option>
            <option value="19">10-10</option>
            <option value="20">20</option>
            <option value="24">24</option>
            <option value="28">28</option>
            <option value="32">32</option>
            <option value="34">34</option>
          </select>
        </p>
      </div>
      <div class="container col-md-3">

      </div>
    </div>
    <!-- <div class="row" style="margin-left: 400px; margin-top:50px; ">
      <div class="container col-md-12">
        <p>
          <h4 style="font-weight: bold;">Promedio de Variaciones Competencia vs APA</h4>
        </p>

          <table class="table table-bordered" style="width: 400px">
            <tr>
              <th>Productos n</th>
              <th>Variación %</th>
              <th>Variación $</th>
            </tr>
            <tr>
              <td id="productos">&nbsp;</td>
              <td >&nbsp;</td>
              <td >&nbsp;</td>
            </tr>
          </table>

      </div>
    </div> -->
    <div class="row" style="margin-left: 400px; margin-top:50px; ">
      <div class="container col-md-12">
        <p>
          <h4 style="font-weight: bold;">Resultados de la consulta</h4>
        </p>
        <table class="table table-bordered" style="width: 950px">
          <tr>
            <td>&nbsp;</td>
            <td style="font-weight: bold;">Porcentaje</td>
            <td style="font-weight: bold;">Productos n</td>
            <td style="font-weight: bold;">Variación %</td>
            <td style="font-weight: bold;">Variación $</td>
            <td style="font-weight: bold;" colspan="2">Productos A</td>
            <td style="font-weight: bold;" colspan="2">Productos B</td>
            <td style="font-weight: bold;" colspan="2">Productos C</td>
            <td style="font-weight: bold;">Info</td>
          </tr>
          <tr id="caros">
            <td style="font-weight: bold;">Estamos Caros</td>
            <td id="porcentajeCaro">&nbsp;</td>
            <td id="cantidadCaro">&nbsp;</td>
            <td id="variacionPorcentajeCaro">&nbsp;</td>
            <td id="variacionPesosCaro">&nbsp;</td>
            <td id="porcentajeCaroA">&nbsp;</td>
            <td id="cantidadCaroA">&nbsp;</td>
            <td id="porcentajeCaroB">&nbsp;</td>
            <td id="cantidadCaroB">&nbsp;</td>
            <td id="porcentajeCaroC">&nbsp;</td>
            <td id="cantidadCaroC">&nbsp;</td>
            <td><input type="button" class="btn btn-warning" value="Caro" id="caro"/></td>
          </tr>
          <!-- <tr id="iguales">
            <td style="font-weight: bold;">Iguales</td>
            <td id="porcentajeIgual">&nbsp;</td>
            <td id="cantidadIgual">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td id="porcentajeIgualA">&nbsp;</td>
            <td id="cantidadIgualA">&nbsp;</td>
            <td id="porcentajeIgualB">&nbsp;</td>
            <td id="cantidadIgualB">&nbsp;</td>
            <td id="porcentajeIgualC">&nbsp;</td>
            <td id="cantidadIgualC">&nbsp;</td>
            <td><input type="button" class="btn btn-warning" value="Igual" id="igual" /></td>
          </tr> -->
          <tr id="baratos">
            <td style="font-weight: bold;">Estamos Baratos</td>
            <td id="porcentajeBarato">&nbsp;</td>
            <td id="cantidadBarato">&nbsp;</td>
            <td id="variacionPorcentajeBarato">&nbsp;</td>
            <td id="variacionPesosBarato">&nbsp;</td>
            <td id="porcentajeBaratoA">&nbsp;</td>
            <td id="cantidadBaratoA">&nbsp;</td>
            <td id="porcentajeBaratoB">&nbsp;</td>
            <td id="cantidadBaratoB">&nbsp;</td>
            <td id="porcentajeBaratoC">&nbsp;</td>
            <td id="cantidadBaratoC">&nbsp;</td>
            <td><input type="button" class="btn btn-warning" value="Barato" id="barato"/></td>
          </tr>
          <tr id="totales">
            <td style="font-weight: bold;">TOTAL REAL</td>
            <td id="totalPorcentaje">&nbsp;</td>
            <td id="totalCantidad">&nbsp;</td>
            <td id="porcentaje">&nbsp;</td>
            <td id="cantidad">&nbsp;</td>
            <td id="totalPorcentajeA">&nbsp;</td>
            <td id="totalCantidadA">&nbsp;</td>
            <td id="totalPorcentajeB">&nbsp;</td>
            <td id="totalCantidadB">&nbsp;</td>
            <td id="totalPorcentajeC">&nbsp;</td>
            <td id="totalCantidadC">&nbsp;</td>
            <td><input type="button" class="btn btn-warning" value="Todo" id="todo"/></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="row" style="margin-left: 400px; margin-top:50px;" hidden id="nivel">
      <div class="container col-md-12">
        <p>
          <h4 style="font-weight: bold;" id="tituloImportancia">Productos</h4>
        </p>
        <p id="Prueba"></p>
        <table border="1" width="500px" style="text-align: center">
          <thead>
            <tr style="font-weight: bold;">
              <td>Nivel</td>
              <td>ID APA</td>
              <td>Precio</td>
              <td>ID Vazlo</td>
              <td>Precio</td>

            </tr>
          </thead>
          <tbody id="tablaNivel">
          </tbody>
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
