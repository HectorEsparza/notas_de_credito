<?php
  require_once("../../funciones.php");
  $folio = $_GET['folio'];
  $contador = 0;
  $base = conexion_local();
  $consulta = "SELECT RECEPCION FROM NOTAS";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array());
  while ($registro = $resultado->fetch(PDO::FETCH_NUM)){
    if($registro[0]==$folio){
      $contador = 1;
    }
  }
  if($contador==1){
    echo "";
  }
  else{
    echo $folio;
  }

?>
