<?php
require_once("../../funciones.php");

$clave_cliente = $_GET['cliente'];

try
{

  $base = conexion_local();
  $consulta = "SELECT DESCUENTO FROM CLIENTES WHERE CLAVE=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($clave_cliente));
  $registro = $resultado->fetch(PDO::FETCH_NUM);
?>
  <? if($registro[0]!="") :?>

    <?= $registro[0] . "% "?> <input type="button" class="boton" value="?" onclick="listaDescuentos(document.getElementById('user').value)" />
  <? endif ?>



<?php
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
