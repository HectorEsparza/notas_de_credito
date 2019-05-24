<?php
require_once("../../funciones.php");
//$clave = $_GET['clave'];
$i = $_POST['indice'];
$clave = $_POST['clave'];
$usuario = $_POST['usuario'];
$lista = "PRODUCTOS2";
$lista = "PRODUCTOS1";
try
{
  $base = conexion_local();
  $consulta = "SELECT PRECIO FROM " . $lista . " WHERE CLAVEDEARTÍCULO=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($clave));
  $registro = $resultado->fetch(PDO::FETCH_NUM);
?>
  <input type="hidden" id='user' value=<?= $usuario?> />
<?php if($registro[0]!=null):?>
  <?= "$" . number_format($registro[0], 2, ".", ",") . " "?>
  <input type='button' class="boton" value='?' onclick="listas(document.querySelector('.clave<?= $i?>').value, <?= $i?>, document.getElementById('user').value)" /></td>
<?php else:?>
  <input type='button' class="boton" value='?' onclick="listas(document.querySelector('.clave<?= $i?>').value, <?= $i?>, document.getElementById('user').value)" /></td>

<?php endif?>
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
