<?php
$cantidad = array();
$clave = array();
$precio = array();
$sub = array();
$subtotal = 0;
$letra = "";
$descuento = floatval($_POST['descuento']);
require_once("../../funciones.php");

$base = conexion_local();

for ($i=1; $i <=3 ; $i++)
{
  $cantidad[$i] = $_POST['cantidad' . $i];
  $clave[$i] = $_POST['clave' . $i];
  $consulta = "SELECT PRECIO FROM PRODUCTOS1 WHERE CLAVEDEARTÍCULO=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($clave[$i]));
  $registro = $resultado->fetch(PDO::FETCH_NUM);
  $precio[$i] = $registro[0]*$cantidad[$i];
  $sub[$i] = sub($descuento, $precio[$i]);
}

$subtotal = subtotal($sub);
$letra = num2letras($subtotal, $fem = false, $dec = true);

echo $letra;


$resultado->closeCursor();


?>
