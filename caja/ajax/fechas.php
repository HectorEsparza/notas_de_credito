<?php
  require_once("../../funciones.php");
  
  $base = conexion_local();
  $consulta = "SELECT ID FROM CAJA ORDER BY ID DESC";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array());
  $registro = $resultado->fetch(PDO::FETCH_NUM);

  if($registro==""){
    echo 1;
  }
  else{
    echo $registro+1;
  }

?>
