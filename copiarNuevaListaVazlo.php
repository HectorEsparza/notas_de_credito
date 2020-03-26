<?php
  ini_set('max_execution_time', 300); //300 seconds = 5 minutes
  require_once("funciones.php");

  $id = array();
  $idVazlo = array();
  $precioVazlo = array();
  $contador = 0;

  $base = conexion_local();
  $consulta = "SELECT ID_APA, ID_VAZLO, PRECIO FROM LISTA_VAZLO";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array());
  
  while ($registro = $resultado->fetch(PDO::FETCH_NUM)){

    $id[$contador] = $registro[0];
    $idVazlo[$contador] = $registro[1];
    $precioVazlo[$contador] = $registro[2];
    $contador++;
  }
  $resultado->closeCursor();

  // //echo $contador;
  for ($i=0; $i < $contador ; $i++) {
      $consulta = "UPDATE PRODUCTOS1 SET ID_VAZLO=?, PRECIO_VAZLO=? WHERE CLAVEDEARTÍCULO=?";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($idVazlo[$i], $precioVazlo[$i], $id[$i]));
  }

  $resultado->closeCursor();

  $base = null;

?>
