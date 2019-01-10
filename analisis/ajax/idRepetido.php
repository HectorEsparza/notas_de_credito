<?php
  require_once("../../funciones.php");
  $idApa = $_POST['idApa'];

  $base = conexion_local();
  $consulta = "SELECT CLAVEDEARTÍCULO FROM PRODUCTOS1 WHERE CLAVEDEARTÍCULO=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($idApa));
  $registro = $resultado->fetch(PDO::FETCH_NUM);

  if($registro[0]==""){
    echo $idApa;
  }
  else{
    echo "";
  }
?>
