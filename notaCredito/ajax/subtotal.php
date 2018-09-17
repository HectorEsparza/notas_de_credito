<?php

$cantidad = $_GET['cantidad'];
$clave = $_GET['clave'];
$descuento = floatval($_GET['descuento']);
$importe = 0;
$subtotal = 0;
require_once("../../funciones.php");

try
{
  $base = conexion_local();
  $consulta = "SELECT PRECIO FROM PRODUCTOS1 WHERE CLAVEDEARTÍCULO=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($clave));
  $registro = $resultado->fetch(PDO::FETCH_NUM);
  $importe = imp($cantidad, $registro[0]);
  $subtotal = sub($descuento, $importe);

  echo "$" . $subtotal;



}
catch (Exception $e)
{
  die("<h1>ERROR: " . $e->GetMessage() . "</h1>");
}
finally
{
  $base = null;
}





?>
