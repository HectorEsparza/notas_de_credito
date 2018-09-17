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
      header("location:inicio.html");
    }

    elseif($departamento!="VENTAS")
    {
      header("location:ciere.php");
    }
    $folioNotas = $_GET['folio'];


    $base = conexion_local();
    $consulta = "SELECT * FROM CARTAS_VIS WHERE FOLIOINTERNO=?";
    $resultado = $base->prepare($consulta);
    $resultado-> execute(array($folioNotas));
    $contador = $resultado->rowCount();

    if($contador==1&&$user==1){
      $base = conexion_local();
      $consulta = "UPDATE CARTAS SET NOTASAE=?, STATUS=? WHERE FOLIOINTERNO=?";
      $resultado = $base->prepare($consulta);
      $resultado-> execute(array("CANCELADA", "CANCELADA", $folioNotas));
      $resultado->closeCursor();
      $consulta = "UPDATE CARTAS_VIS SET NOTASAE=?, STATUS=? WHERE FOLIOINTERNO=?";
      $resultado = $base->prepare($consulta);
      $resultado-> execute(array("CANCELADA", "CANCELADA", $folioNotas));
      $resultado->closeCursor();
      header("location:visualizarCartas.php");
    }
    else{
      header("location:visualizarCartas.php");
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
