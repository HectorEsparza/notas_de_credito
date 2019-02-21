<?php
  require_once("../../funciones.php");
  $linea = $_POST['linea'];
  $sublinea = $_POST['sublinea'];
  $descuentoApa = $_POST['descuentoApa'];
  $descuentoVazlo = $_POST['descuentoVazlo'];
  $idApa = array();
  $precioApa = array();
  $idVazlo = array();
  $precioVazlo = array();
  $importancia = array();
  $cont = 0;
  $base = conexion_local();

  //Si se escogen todos los productos
  if($linea=="Total"){
    $consulta = "SELECT CLAVEDEARTÍCULO, PRECIO, ID_VAZLO, PRECIO_VAZLO, IMPORTANCIA FROM PRODUCTOS1 ORDER BY IMPORTANCIA ASC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array());
  }
  else{
    if($sublinea=="Total"){
      $consulta = "SELECT CLAVEDEARTÍCULO, PRECIO, ID_VAZLO, PRECIO_VAZLO, IMPORTANCIA FROM PRODUCTOS1 WHERE LINEA=? ORDER BY IMPORTANCIA ASC";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($linea));
    }
    else{
      $consulta = "SELECT CLAVEDEARTÍCULO, PRECIO, ID_VAZLO, PRECIO_VAZLO, IMPORTANCIA FROM PRODUCTOS1 WHERE LINEA=? AND SUBLINEA=? ORDER BY IMPORTANCIA ASC";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($linea, $sublinea));
    }

  }
  while($registro = $resultado->fetch(PDO::FETCH_NUM)){
    if($registro[1]>0&&$registro[2]!=""&&$registro[3]>0){
      $idApa[$cont] = $registro[0];
      $precioApa[$cont] = $registro[1];
      $idVazlo[$cont] = $registro[2];
      $precioVazlo[$cont] = $registro[3];
      $importancia[$cont] = $registro[4];

      $cont++;
    }
  }

  $resultado->closeCursor();

  echo json_encode(reportePrecios($precioApa, $precioVazlo, $descuentoApa, $descuentoVazlo, $importancia, $idApa, $idVazlo));

?>
