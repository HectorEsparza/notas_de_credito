<?php
require_once("../../funciones.php");

$costo = $_POST['costo'];
$descuento = $_POST['descuento'];
$cantidad = $_POST['cantidad'];


  if($cantidad==""){
    $costo = convertidorNumeros($costo);
    $descuento = convertidorDescuento($descuento);
    $subtotal = sub($descuento, $costo);
    echo "$" . number_format($subtotal, 2, ".", ",");
  }
  else{
    $costo = convertidorNumeros($costo);
    $descuento = convertidorDescuento($descuento);
    $subtotal = sub($descuento, $costo)*$cantidad;
    echo "$" . number_format($subtotal, 2, ".", ",");
  }

?>
