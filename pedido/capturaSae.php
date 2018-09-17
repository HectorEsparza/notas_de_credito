<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="" content="" />
    <meta name="" content="" />
    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Captura SAE</title>
    <style>


      a{
            color: #FFFFFF;
      }

    </style>
  </head>
  <body>
      <?php session_start();
         $usuario = $_SESSION['user'];

        require_once("../funciones.php");
        $base = conexion_local();
        $consulta="SELECT DEPARTAMENTO, USUARIO, PERMISO FROM USUARIOS WHERE USUARIO=?";
        $resultado = $base->prepare($consulta);
        $resultado-> execute(array($usuario));
        $registro = $resultado->fetch(PDO::FETCH_NUM);
        $departamento = $registro[0];
        $user = $registro[2];
        $gerente = $registro[1];



        if(!isset($usuario))
        {
          header("location:../index.html");
        }

        elseif($departamento!="VENTAS")
        {
          header("location:../home.php");
        }

      $folio = $_GET['folio'];


      try
      {
        $base = conexion_local();
        $consulta = "SELECT NOTASAE FROM CARTAS WHERE FOLIOINTERNO=?";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($folio));
        $registro = $resultado->fetch(PDO::FETCH_NUM);

      ?>

      <? if($registro[0]==null) :?>
        <header class="row">
          <div class="container col-md-8">
            <button style="float: left;" class="btn btn-primary" onclick='visualizar()'>Regresa a Tabla</button>
            <h1 align="center">Número SAE</h1>
          </div>
          <div class="container col-md-4">
            <form action='cierre.php'>
              <input style="float: right;" class="btn btn-primary" type='submit' value='Cierra Sesión' />
            </form>
          </div>
          <div class="container">
           <form method='post' action='final_sae.php' enctype="multipart/form-data">

           <table class="table table-condensed table-bordered table-responsive">
           <tr>
           <td colspan=2 align='center'><img src='imagenes/apa.jpg' class="img-responsive"></td>
           </tr>
           <tr>
             <div class="form-group">
               <td><label for="nota">Nota SAE</label></td>
               <td><input class="form-control" id="nota" type='text' name='sae' required></td>
             </div>
           </tr>
           <tr>
             <div class="form-group">
               <td><label for="pdf">PDF</label></td>
               <td><input  id="pdf" type="file" name="archivo"/></td>
             </div>
           </tr>
           <tr>
           <input name='folio' type='hidden' value='<?= $folio?>'>
           <input name='contador' type='hidden' value='<?= $cont?>'>
           <td colspan=2 align='center'><input class="btn btn-primary" type='submit' value='Capturar'></td>
           </tr>
           </table>
           </form>
          </div>
        </header>
      <?else :
        header("location:visualizarCartas.php");
      ?>

      <? endif?>

      <?


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
      <script src="ajax/eventos/cierreInactividad.js"></script>
      <script>


            function sae(){
              setTimeout("location.href='sae.php'",500);
            }
            function visualizar(){
              setTimeout("location.href='visualizarCartas.php'",500);
            }

      </script>
  </body>
</html>
