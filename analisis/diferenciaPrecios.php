<?php

  require_once("../funciones.php");

  $idApa = array();
  $diferencia = array();
  $cont = 0;
  $base = conexion_local();
  $consulta = "SELECT CLAVEDEARTÍCULO, PRECIO, ID_VAZLO, PRECIO_VAZLO FROM PRODUCTOS1";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array());

  while ($registro = $resultado->fetch(PDO::FETCH_NUM)){
    if($registro[1]>0&&$registro[2]!=""&&$registro[3]>0){
      $idApa[$cont] = $registro[0];
      $diferencia =
    }
  }

?>
