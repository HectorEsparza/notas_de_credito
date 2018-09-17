<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="" content="" />
    <meta name="" content="" />
    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Home</title>
    <style>
      body{
        background: #F0EEF0;
      }
      #nota{
        background: #FC6363;
        color: #000000;
        width: 150px;
      }
      #carta{
        background: #FCFA63;
        color: #000000;
        width: 150px;
      }
      #sae{
        background: #8AFC63;
        color: #000000;
        width: 150px;
      }
      #nomina{
        background: #63FCF5;
        color: #000000;
        width: 150px;
      }
      #pedido{
        background: #63FCF5;
        color: #000000;
        width: 150px;
      }
      #remision{
        background: #CE63FC
        color: #000000;
        width: 150px;
      }
      #imagen{
        width: 150px;
        height: 75px;
      }
      #ciere{
        float: right;
      }
    </style>
  </head>
  <body>
    <?php session_start();
       $usuario = $_SESSION['user'];
       if(!isset($usuario)){
         header("location:index.html");
       }
       require_once("funciones.php");

       $base = conexion_local();
       $consulta = "SELECT DEPARTAMENTO FROM USUARIOS WHERE USUARIO=?";
       $resultado = $base->prepare($consulta);
       $resultado->execute(array($usuario));
       $registro = $resultado->fetch(PDO::FETCH_NUM);
       $departamento = $registro[0];
    ?>
    <input type="hidden" id="departamento" value="<?= $departamento?>" />
    <header style="margin-top: 0px;">
      <div class="container-fluid">
      <div class="container col-md-8">
        <img class="img-responsive img-rounded" id="imagen" src='imagenes/imagen.jpg' style="float: left;">
        <h1 align='center'>
          Bienvenidos!
        </h1>
      </div>
      <div class="container col-md-4">
        <input type="button" id="cierre" value="Cierra Sesión" class="btn btn-primary" />
      </div>
      </div>

    </header>
    <br /><br />
    <section>
      <div class="container">
          <div class="container row">
            <div class="container col-md-4">
              <input type="button" id="nota" value="Notas de Crédito" class="btn btn-primary" />
            </div>
            <div class="container col-md-4">
              <input type="button" id="pedido" value="Pedidos" class="btn btn-primary" />
            </div>
            <div class="container col-md-4">
              <input type="button" id="carta" value="Cartas Factura" class="btn btn-primary" />
            </div>
          </div>
          <br />
          <div class="container row">
            <div class="container col-md-4">
              <input type="button" id="remision" value="Remision" class="btn btn-primary" />
            </div>
            <div class="container col-md-4">
              <input type="button" id="sae" value="Captura SAE" class="btn btn-primary" />
            </div>
            <div class="container col-md-4">
              <input type="button" id="nomina" value="Pre-Nominas" class="btn btn-primary" />
            </div>
          </div>
     </div>
    </section>
    <script>
      $(document).ready(function(){

        var departamento = $("#departamento").val();

        if(departamento=="VENTAS"){
          $("#nota").show();
          $("#carta").show();
          $("#pedido").show();
          $("#remision").hide();
          $("#sae").hide();
          $("#nomina").hide();
        }
        else if(departamento=="CREDITO Y COBRANZA"){
          $("#nota").hide();
          $("#carta").hide();
          $("#pedido").hide();
          $("#sae").show();
          $("#nomina").hide();
          $("#remision").hide();
        }
        else if(departamento=="RECURSOS HUMANOS"){
          $("#nota").hide();
          $("#carta").hide();
          $("#pedido").hide();
          $("#sae").hide();
          $("#nomina").show();
          $("#remision").hide();
        }

        $("#nota").click(function(){
          setTimeout("location.href='notaCredito/visualizacion.php'",500);
        });
        $("#carta").click(function(){
          setTimeout("location.href='cartaFactura/visualizarCartas.php'",500);
        });
        $("#sae").click(function(){
          setTimeout("location.href='notaCredito/sae.php'",500);
        });
        $("#nomina").click(function(){
          alert("Programa en Proceso...");
          // setTimeout("location.href='cierre.php'",500);
        });
        $("#pedido").click(function(){
          setTimeout("location.href='pedido/visualizarPedidos.php'",500);
        });
        $("#remision").click(function(){
          setTimeout("location.href='remision/visualizarPedidos.php'",500);
        });

        $("#cierre").click(function(){
          setTimeout("location.href='cierre.php'",500);
        });
        // $("body").hide().fadeIn(2000);



      });
    </script>
  </body>
</html>
