<?php
  require_once("funciones.php");

  $idApa = array();
  $precio = array();
  $contador = 0;
  $base = conexion_local();
  $consulta = "SELECT * FROM LISTA_NUEVA";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array());

  while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $idApa[$contador] = $registro["ID_APA"];
    $precio[$contador] = $registro["PRECIO"];
    $contador++;
  }

  $resultado->closeCursor();
  //echo "ID_APA | PRECIO<br />";
  for ($i=0; $i < $contador; $i++) {
      $consulta = "UPDATE PRODUCTOS9 SET PRECIO=? WHERE CLAVEDEARTÍCULO=?";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($precio[$i], $idApa[$i]));
  }

  $resultado->closeCursor();
  $base = null;
  echo "OK :)";
?>
