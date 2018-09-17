<?php

$sae = $_POST['sae'];
$folio = $_POST['folio'];
$nombre = $_FILES['archivo']['name'];
$ruta = $_FILES['archivo']['tmp_name'];
$destino = "cartas_pdf\\" . $nombre;
$tipo = explode(".", $nombre);
require_once("../funciones.php");

?>

<input type="hidden" id="folio" value="<?= $folio?>" />
<? if($tipo[1]!="pdf"): ?>
    <body onload="mensaje();">

      <?
        //header("location:captura_sae.php?folio=" . $folio);
      ?>
    </body>

<? else :?>
    <h1>Bienvenidos</h1>
    <?
      try
      {


        if(count($sae)>0){
          // echo "<h2>Venimos de captura sae!!!";
            $base = conexion_local();
            $consulta = "UPDATE CARTAS SET NOTASAE=?, PDF=? WHERE FOLIOINTERNO=?";
            $resultado = $base->prepare($consulta);
            $resultado -> execute(array($sae, $nombre, $folio));
            $resultado->closeCursor();
            $consulta = "UPDATE CARTAS_VIS SET NOTASAE=?, PDF=? WHERE FOLIOINTERNO=?";
            $resultado = $base->prepare($consulta);
            $resultado -> execute(array($sae, $nombre, $folio));
            move_uploaded_file($ruta, $destino);
            header("location: visualizarCartas.php");

        }
        else{
          // echo "<h2>Venimos de cancela sae!!!";
          $base = conexion_local();
          $consulta = "UPDATE CARTAS SET PDF_CANCELADA=?, STATUS=? WHERE FOLIOINTERNO=?";
          $resultado = $base->prepare($consulta);
          $resultado -> execute(array($nombre, "CANCELADA", $folio));
          $resultado->closeCursor();
          $consulta = "UPDATE CARTAS_VIS SET PDF_CANCELADA=?, STATUS=? WHERE FOLIOINTERNO=?";
          $resultado = $base->prepare($consulta);
          $resultado -> execute(array($nombre, "CANCELADA", $folio));
          move_uploaded_file($ruta, $destino);
          header("location: visualizarCartas.php");
        }

      }
      catch (Exception $e)
      {
        die("<h1>ERROR: " . $e->GetMessage());
      }
      finally
      {
        $base = null;
      }
    ?>

<? endif?>

<script>
    var folio = document.getElementById('folio').value;
    function mensaje(){
      alert("El archivo introducido no es válido, solamente se permiten archivos pdf");
      setTimeout("location.href='visualizarCartas.php'",500);
    }
</script>
