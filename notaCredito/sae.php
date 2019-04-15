<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="" content="" />
    <meta name="" content="" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>SAE</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="css/estiloSAE.css" />
    <script type="text/javascript" src="ajax/js/jquery-ui.js"></script>
  	<script type="text/javascript" src="ajax/js/filtro.js"></script>
  	<script type="text/javascript" src="ajax/js/limpia.js"></script>
    <script type="text/javascript" src="ajax/js/limpiaFiltro.js"></script>
  </head>
  <body>

      <?php
      require_once("../funciones.php");
      session_start();
      $usuario = $_SESSION['user'];
      try
      {
        $base = conexion_local();
        $consulta="SELECT DEPARTAMENTO FROM USUARIOS WHERE USUARIO=?";
        $resultado = $base->prepare($consulta);
        $resultado-> execute(array($usuario));
        $registro = $resultado->fetch(PDO::FETCH_NUM);
        $departamento = $registro[0];


      if(!isset($usuario))
      {
        header("location:../index.html");
      }
      else
      {
        // $folio = $_POST['folio'];
      ?>
            <header class="row">
              <div class="container col-md-8">
                <h1 align='center'>
                  Registro Número SAE
                </h1>
                <input type='button' id="home" class="btn btn-primary" style='background:url("imagenes/home3.jpg"); float: left; width: 50px; height: 50px;' />
                <div align="center"><img src="imagenes/apa.jpg" /></div>

              </div>
              <div class="container col-md-4">
                <form action='cierre.php'>
                  <input style="float: right;" class="btn btn-primary" type='submit' value='Cierra Sesión' />
                </form>
              </div>
            </header>
            <section>
              <div class="container" align="center">
                  <h3>Filtro de Búsqueda</h3>
                       <br />
                       <input type="text" id="nocliente" class="nocliente" placeholder="NoCliente"/>
                       <input type="text" id="tag" class="tag" placeholder="Cliente"/>
                       <input type="text" id="fecha" class="fecha" placeholder="Fecha"/>
                       <input type="text" id="folio" class="folio" placeholder="Folio Interno"/>
                       <input type="text" id="sae" class="sae" placeholder="Nota SAE"/>
                       <br /><br />
                       <button class="btn btn-primary" onclick="filtro(document.querySelector('.nocliente').value, document.querySelector('.tag').value, document.querySelector('.fecha').value, document.querySelector('.folio').value, document.querySelector('.sae').value);">Buscar</button>
                       <button type="submit" class="btn btn-primary" id="limpiaFiltro">Limpiar Campos</button>
                       	<input type="button" class="btn btn-primary" onclick="visualizar()" value='Tabla Completa' />

                  <input type=hidden id="folio" value="<?= $folio?>"/>
              </div>
              <br /><br /><br />
              <div class="container">
              <!--<table class="table table-striped table-hover">-->
              <table  border=1 align='center'>
                <thead>
                  <tr>
                    <th>Folio Interno</th>
                    <th>NoCliente</th>
                    <th>Cliente</th>
                    <th>Nota SAE</th>
                    <th>Total Nota</th>
                    <th>Fecha</th>
                    <th>Status</th>
                    <th colspan=2>Info</th>
                  </tr>
                </thead>
                <tbody id="table">

                </tbody>
              </table>
              <div class="col-md-12 text-center">
                <ul class="pagination" id="paginador"></ul>
              </div>

              </div>


            </section>


        <?php
        }

        $resultado->closeCursor();
        }
        catch (Exception $e)
        {
          $mensaje = $e->GetMessage();
          $linea = $e->getline();
          echo "<h1>Error: " . $mensaje . "</h1><br />";
          echo "<h1>Linea del Error: " . $linea . "</h1><br />";

          // die($e->GetMessage());
          // die($e->getline());
        // die("<h1>ERROR: " . $e->GetMessage());
        // echo "<br /><h3>" . $e->getline() . "</h3>";
        }

        finally
        {
          $base = null;
        }
      ?>
      <!-- <script src="ajax/js/bootstrap.min.js"></script> -->
      <script src="ajax/js/paginator.min.js"></script>
      <script src="ajax/js/main.js"></script>
      <script src="ajax/eventos/cierreInactividad.js"></script>
      <script type="text/javascript">

      			$(document).ready(function(){

      									$('#tag').autocomplete({
      											source: function(request, response){
      													$.ajax({
      															url:"colores.php",
      															dataType:"json",
      															data:{q:request.term},
      															success: function(data){
      																	response(data);
      															}
      													});
      											},
      											minLength:3,
      											select: function(event, ui){
      													//alert("Selecciono: "+ui.item.label);
      											}
      									});

                        $("#home").click(function(){

                          setTimeout("location.href='../home.php'", 500);
                        });
      			});
      			$(document).ready(function(){

      				$('#fecha').datepicker();
      			});
            function saludo(folio){
      					setTimeout("location.href='captura_sae.php?folio="+folio+"'");
            }
            function cancela(folio){
                setTimeout("location.href='cancelaSae.php?folio="+folio+"'");
            }
            function vista(folio){
                setTimeout("location.href='vistaCancelada.php?folio="+folio+"'");
            }
            function visualizar(){
                setTimeout("location.href='sae.php'",500);
            }

      </script>

  </body>
</html>
