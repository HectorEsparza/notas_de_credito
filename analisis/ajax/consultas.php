<?php
  require_once("../../funciones.php");
  $linea = $_POST['linea'];
  $sublinea = $_POST['sublinea'];
  $descuentoApa = $_POST['descuentoApa'];
  $descuentoVazlo = $_POST['descuentoVazlo'];
  $arreglo = array();
  $precioApa = array();
  $precioVazlo = array();
  $cont = 0;
  $base = conexion_local();

  //Si se escogen todos los productos
  if($linea=="Total"){
    $consulta = "SELECT PRECIO, ID_VAZLO, PRECIO_VAZLO FROM PRODUCTOS1";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array());
  }
  else{
    if($sublinea=="Total"){
      $consulta = "SELECT PRECIO, ID_VAZLO, PRECIO_VAZLO FROM PRODUCTOS1 WHERE LINEA=?";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($linea));
    }
    else{
      $consulta = "SELECT PRECIO, ID_VAZLO, PRECIO_VAZLO FROM PRODUCTOS1 WHERE LINEA=? AND SUBLINEA=?";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($linea, $sublinea));
    }

  }
  while($registro = $resultado->fetch(PDO::FETCH_NUM)){
    if($registro[0]>0&&$registro[1]!=""&&$registro[2]>0){
      $precioApa[$cont] = $registro[0];
      $precioVazlo[$cont] = $registro[2];
      $cont++;
    }
  }

  $resultado->closeCursor();
  
  echo json_encode(reportePrecios($precioApa, $precioVazlo, $descuentoApa, $descuentoVazlo));
  //echo sub($descuentoApa, $precioApa[0]);
   // $arreglo[0] = 5;
   // $arreglo[1] = 10;
   // $arreglo[2] = 15;
  // $arreglo[3] = $descuentoVazlo;
  //
  // echo json_encode($arreglo);
  // echo $cont;
?>
