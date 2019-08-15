<?php
require_once("../../funciones.php");
$cantidad = $_GET['cantidad'];
$subtotal = $_GET['subtotal'];
$descuento = $_GET['descuento'];

if ($subtotal!=""){
  $descuento = convertidorDescuento($descuento);
  $subtotal = convertidorNumeros($subtotal);
  $subtotal = sub($descuento, $subtotal);
  if($cantidad!=""){
    $subtotal = $subtotal*$cantidad;
    echo "$" . number_format($subtotal, 2, ".", ",");
  }
  else{
    echo "$" . number_format($subtotal, 2, ".", ",");
  }

}



?>
