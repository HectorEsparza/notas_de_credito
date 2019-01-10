<?php
  require_once("../../funciones.php");
  $idVazlo = $_POST['idVazlo'];

  $base = conexion_local();
  $consulta = "SELECT ID_VAZLO FROM PRODUCTOS1 WHERE ID_VAZLO=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($idVazlo));
  $registro = $resultado->fetch(PDO::FETCH_NUM);

  if($registro[0]==""){
    echo $idVazlo;
  }
  else{
    echo "";
  }
?>
