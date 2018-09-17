<?php

$contra = $_POST['contra'];
$usuario = $_POST['usuario'];
$cifrada = password_hash($contra, PASSWORD_DEFAULT);

try
{
  require_once("funciones.php");
  $base = conexion_local();
  $consulta = "UPDATE USUARIOS SET CLAVE=? WHERE USUARIO=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($cifrada, $usuario));

  header("location: index.html");

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
