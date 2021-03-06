<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>

  <?php
    require_once("../funciones.php");
    $folioNotas = $_GET['folio'];


    $base = conexion_local();
    $consulta = "SELECT NOTASAE FROM NOTAS_VIS WHERE FOLIOINTERNO=?";
    $resultado = $base->prepare($consulta);
    $resultado-> execute(array($folioNotas));
    $registro = $resultado->fetch(PDO::FETCH_NUM);
    $sae = $registro[0];
    $resultado->closeCursor();


    if($sae==""){
      $base = conexion_local();
      $consulta = "UPDATE NOTAS SET NOTASAE=?, STATUS=? WHERE FOLIOINTERNO=?";
      $resultado = $base->prepare($consulta);
      $resultado-> execute(array("CANCELADA", "CANCELADA", $folioNotas));
      $resultado->closeCursor();
      $consulta = "UPDATE NOTAS_VIS SET NOTASAE=?, STATUS=? WHERE FOLIOINTERNO=?";
      $resultado = $base->prepare($consulta);
      $resultado-> execute(array("CANCELADA", "CANCELADA", $folioNotas));
      $resultado->closeCursor();
    }


  ?>
  <input type="hidden" id="consecutivo" value="<?= $folioNotas?>" />
  <input type="hidden" id="sae" value="<?= $sae?>" />
  <script>
      $(document).ready(function(){

          var folioNota = $("#consecutivo").val();
          var folioVis = $("#sae").val();

          if(folioVis!=""){
            alert("No se pudo cancelar la nota de credito porque el folio consecutivo "+folioNota+" tiene un numero SAE asociado. Por favor verificarlo con credito y cobranza");
            setTimeout("location.href='visualizacion.php'",500);
          }
          else{
            alert("Se cancelo la nota de credito con folio consecutivo "+folioNota);
            setTimeout("location.href='visualizacion.php'",500);
          }


      });
  </script>
  </body>
</html>
