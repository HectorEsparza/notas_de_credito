<?php
require_once("../../funciones.php");
  $costo = $_POST['costo'];
  $cantidad = $_POST['cantidad'];


  if($cantidad==""){
    echo $costo;
  }
  else{
    $importe = convertidorNumeros($costo)*$cantidad;
    echo "$" . number_format($importe, 2, ".", ",");
  }


?>
