<?php
  ini_set('max_execution_time', 300); //300 seconds = 5 minutes
  require_once("funciones.php");

  $id = array();
  $idVazlo = array();
  $precioVazlo = array();
  $importancia = array();
  $contador = 0;

  $base = conexion_local();
  $consulta = "SELECT CLAVEDEARTÍCULO, ID_VAZLO, PRECIO_VAZLO, IMPORTANCIA FROM PRODUCTOS2";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array());

  while ($registro = $resultado->fetch(PDO::FETCH_NUM)){

    $id[$contador] = $registro[0];
    $idVazlo[$contador] = $registro[1];
    $precioVazlo[$contador] = $registro[2];
    $importancia[$contador] = $registro[3];
    $contador++;
  }
  $resultado->closeCursor();

  // //echo $contador;
  for ($i=0; $i < $contador ; $i++) {
      $consulta = "UPDATE PRODUCTOS1 SET ID_VAZLO=?, PRECIO_VAZLO=?, IMPORTANCIA=? WHERE CLAVEDEARTÍCULO=?";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($idVazlo[$i], $precioVazlo[$i], $importancia[$i], $id[$i]));
  }

  $resultado->closeCursor();


?>
