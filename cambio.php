<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Nueva Contraseña</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <?php
      $usuario = $_GET['user'];
      if($usuario==null)
      {
        header("location:index.html");
      }
    ?>
    <header>
      <div class="container">
        <h1 align='center'>Nueva Contraseña</h1>
      </div>
    </header>
    <section>
      <div class="container">
        <!--<table width='30%' align='center' border=1>-->
        <table class="table table-bordered table-condensed table-responsive">
          <form name="contra" action='contra.php' method='post'>
          <tr>
            <td colspan=2 align='center'><img src='imagenes/apa.jpg' class="img-responsive"></td>
          </tr>
          <tr>
            <div class="form-group">
              <th><label for="contra">Contraseña:</label></th>
              <td><input class="form-control" type='password' id="contra" name='contra' value=''></td>
            </div>
          </tr>
          <tr>
            <div class="form-group">
              <th><label for="contra2">Confirmar Contraseña:</label></th>
              <td><input class="form-control" type='password' id="contra2" name='contra2' value=''></td>
            </div>
          </tr>
          <tr>
            <input type="hidden" name="usuario" value="<?= $usuario?>" />
            <td align='center' colspan=2 ><input class="btn btn-primary" id="boton" type='submit' value='Confirmar'></td>
          </tr>
          </form>
        </table>
      </div>
    </section>
    <script>
       var formulario = document.getElementsByName('contra')[0];

       var confirma = function(e)
       {
         if(document.getElementById('contra').value!=document.getElementById('contra2').value)
         {
           alert("Las Contraseñas no coinciden");
           e.preventDefault();
         }

       }

       formulario.addEventListener("submit", confirma);
    </script>
    <script src="ajax/js/bootstrap.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </body>
</html>
