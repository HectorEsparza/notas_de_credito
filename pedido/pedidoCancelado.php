<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
      header("location:../ciere.php");
    }
    $folioNotas = $_GET['folio'];


    $base = conexion_local();
    $consulta = "SELECT * FROM PEDIDOS_VIS WHERE FOLIOINTERNO=?";
    $resultado = $base->prepare($consulta);
    $resultado-> execute(array($folioNotas));
    $contador = $resultado->rowCount();

    if($contador==1&&$user==1){
      $base = conexion_local();
      $consulta = "UPDATE PEDIDOS SET CARTAFACTURA=?, STATUS=? WHERE FOLIOINTERNO=?";
      $resultado = $base->prepare($consulta);
      $resultado-> execute(array("CANCELADO", "CANCELADO", $folioNotas));
      $resultado->closeCursor();
      $consulta = "UPDATE PEDIDOS_VIS SET CARTAFACTURA=?, STATUS=? WHERE FOLIOINTERNO=?";
      $resultado = $base->prepare($consulta);
      $resultado-> execute(array("CANCELADO", "CANCELADO", $folioNotas));
      $resultado->closeCursor();
      header("location:visualizarPedidos.php");
    }
    else{
      header("location:visualizarPedidos.php");
    }



  ?>
  <!-- <input type="hidden" id="consecutivo" value="<?//= $folioNotas?>" />
  <input type="hidden" id="sae" value="<?//= $sae?>" /> -->
  <script>
      $(document).ready(function(){

          // var folioNota = $("#consecutivo").val();
          // var folioVis = $("#sae").val();
          //
          // if(folioVis!=""){
          //   alert("No se pudo cancelar la carta factura porque el folio consecutivo "+folioNota+" tiene un numero SAE asociado. Por favor verificarlo con el gerente");
          //   setTimeout("location.href='visualizarCartas.php'",500);
          // }
          // else{
          //   alert("Se cancelo la carta factura con folio consecutivo "+folioNota);
          //   setTimeout("location.href='visualizarCartas.php'",500);
          // }


      });
  </script>
  </body>
</html>
