<?php
require_once("../../funciones.php");
$idCobranza = $_POST['idCobranza'];
$fecha = $_POST['fecha'];
$arreglo = array();
$base = conexion_local();
$flag = 1;

//Consulta and de los 2
if($idCobranza!=""&&$fecha!=""){
  $consulta = "SELECT * FROM CAJA WHERE CLAVE=? AND FECHA=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($idCobranza, $fecha));
  $registro = $resultado->fetch(PDO::FETCH_NUM);
  $arreglo[0] = $flag;
  $arreglo[1] = $registro[1];
  $arreglo[2] = $registro[2];
  $arreglo[3] = $registro[3];
  $arreglo[4] = $registro[4];
}
//Consulta individual ID
elseif($idCobranza!=""){
  $consulta = "SELECT * FROM CAJA WHERE CLAVE=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($idCobranza));
  $registro = $resultado->fetch(PDO::FETCH_NUM);
  $arreglo[0] = $flag;
  $arreglo[1] = $registro[1];
  $arreglo[2] = $registro[2];
  $arreglo[3] = $registro[3];
  $arreglo[4] = $registro[4];
}
//Consulta individual Fecha
elseif($fecha!=""){
  $consulta = "SELECT * FROM CAJA WHERE FECHA=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($fecha));
  $registro = $resultado->fetch(PDO::FETCH_NUM);
  $arreglo[0] = $flag;
  $arreglo[1] = $registro[1];
  $arreglo[2] = $registro[2];
  $arreglo[3] = $registro[3];
  $arreglo[4] = $registro[4];
}
else{
  $flag = 0;
  $arreglo[0] = $flag;
  $arreglo[1] = "";
  $arreglo[2] = "";
  $arreglo[3] = "";
  $arreglo[4] = "";
}

echo json_encode($arreglo);

?>
