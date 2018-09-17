<?php
require_once("../../funciones.php");

$cantidad = $_GET['cantidad'];
$importe = $_GET['importe'];

if ($importe!=""){
  $importe = convertidorNumeros($importe);
  if($cantidad!=""){
    $importe = $importe*$cantidad;
    echo "$" . number_format($importe, 2, ".", ",");
  }
  else{
    echo "$" . number_format($importe, 2, ".", ",");
  }

}


?>
