<?php

  require_once("funciones.php");
  $idApa = array();
  $idVazlo = array();
  $precioVazlo = array();
  $i = 0;
  $contador = 0;
  $diferentes = array();

  $base = conexion_local();
  $consulta = "SELECT CLAVEDEARTÍCULO, PRECIO, ID_VAZLO, PRECIO_VAZLO FROM PRODUCTOS1";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array());
  while($registro = $resultado->fetch(PDO::FETCH_NUM)){
    if($registro[1]==0&&$registro[1]!=""&&$registro[2]>0){

      $diferentes[$i] = $registro[0];
      $i++;
    }

  }
  echo "<h1>Productos APA sin precio " . $i . "</h1><br />";
  echo "<h1>" . $diferentes[0] . " " . $diferentes[1] . " " . $diferentes[2];
  $i = 0;
  $consulta = "SELECT ID_APA, ID_VAZLO, PRECIO_VAZLO FROM LISTA_BUENA";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array());

  while($registro = $resultado->fetch(PDO::FETCH_NUM)){
    if($registro[1]!=""&&$registro[2]>0){
      $contador++;
      $idApa[$i] = $registro[0];
      $idVazlo[$i] = $registro[1];
      $precioVazlo[$i] = $registro[2];
      $i++;
    }

  }
  $resultado->closeCursor();
  echo "<h1>Total de productos APA con corespondiente id Vazlo " . $i . "</h1><br />";

  // echo count($idApa);
  // $contador = count($idApa);
  // echo "<h1>El contador: " . $contador . "</h1><br />";
  // echo "<h1>El arreglo: " . count($idApa) . "</h1><br />";
  // for ($i=0; $i < $contador ; $i++) {
  //   echo $idApa[$i] . " " . $idVazlo[$i] . " " . $precioVazlo[$i] . "<br />";
  // }

  // for ($i=0; $i < $contador; $i++){
  //   $consulta = "UPDATE PRODUCTOS1 SET ID_VAZLO=?, PRECIO_VAZLO=? WHERE CLAVEDEARTÍCULO=?";
  //   $resultado = $base->prepare($consulta);
  //   $resultado->execute(array($idVazlo[$i], $precioVazlo[$i], $idApa[$i]));
  // }
  //
  // $resultado->closeCursor();
  // $i = 0;
  // $consulta = "SELECT CLAVEDEARTÍCULO FROM PRODUCTOS1";
  // $resultado = $base->prepare($consulta);
  // $resultado->execute(array());
  //
  // while($registro = $resultado->fetch(PDO::FETCH_NUM)){
  //   if($idApa[$diferentes]==$registro[0]){
  //     $diferentes++;
  //   }
  //   $i++;
  // }
  // echo $i;

?>
