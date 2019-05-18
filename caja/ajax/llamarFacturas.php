<?php
  require_once("../../funciones.php");
  $indice = $_POST['indice'];
  $factura = $_POST['factura'];
  $total = $_POST['total'];
  $total = explode("$", $total);
  $total = $total[1];
  $arreglo = [];
  $base = conexion_local();
  $consulta = "SELECT CLIENTE, NOMBRE, DESCUENTO, IMPORTE, ENTRADA FROM CARGAS WHERE CLAVE=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($factura));
  $registro = $resultado->fetch(PDO::FETCH_NUM);
  $arreglo[0] = $registro[0];
  $arreglo[1] = $registro[1];
  //$arreglo[2] = round((sub($registro[2], $registro[3]))*100)/100;
  $arreglo[2] = $registro[3];
  $arreglo[3] = $indice;
  $arreglo[4] = $total+$arreglo[2];
  $arreglo[5] = $registro[4];
  $arreglo[6] = $factura;
  echo json_encode($arreglo);
  // echo $total;
?>
