<?php
require_once("../../funciones.php");

$clave_cliente = $_GET['cliente'];

try
{
  /*$base = new PDO('mysql:host=localhost; dbname=aplicacion', 'root', '');
  $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $base->exec("SET CHARACTER SET utf8");*/
  $base = conexion_local();
  $consulta = "SELECT NOMBRE FROM CLIENTES WHERE CLAVE=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($clave_cliente));
  $registro = $resultado->fetch(PDO::FETCH_NUM);
  echo "NOMBRE: " . $registro[0];

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
