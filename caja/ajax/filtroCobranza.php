<?php
require_once("../../funciones.php");
$idCobranza = $_POST['idCobranza'];
$fecha = $_POST['fecha'];
$fechaFin = $_POST['fechaFin'];
$departamento = $_POST['departamento'];
$arreglo = array();
$contador = 0;
$base = conexion_local();

if($departamento=="COBRANZA" || $departamento=="COBRANZA_TECAMAC"){

  if(($idCobranza!=""&&$fecha==""&&$fechaFin=="") || ($idCobranza!=""&&$fecha!=""&&$fechaFin!="")){
    $consulta = "SELECT CLAVE, FECHA, TOTAL, USUARIO FROM CAJA WHERE CLAVE=? AND DEPARTAMENTO=?";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($idCobranza,$departamento));
  }
  elseif($idCobranza==""&&$fecha!=""&&$fechaFin==""){
    $consulta = "SELECT FECHA FROM CAJA ORDER BY FECHA DESC LIMIT 1";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array());
    $registro = $resultado->fetch(PDO::FETCH_ASSOC);
    $fechaFin = $registro["FECHA"];
    $resultado->closeCursor();
    $consulta = "SELECT CLAVE, FECHA, TOTAL, USUARIO FROM CAJA WHERE FECHA BETWEEN ? AND ? AND DEPARTAMENTO=? ORDER BY FECHA DESC ";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array(fechaConsulta($fecha),$fechaFin,$departamento));
  }
  elseif($idCobranza==""&&$fecha==""&&$fechaFin!=""){
    $consulta = "SELECT FECHA FROM CAJA ORDER BY FECHA ASC LIMIT 1";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array());
    $registro = $resultado->fetch(PDO::FETCH_ASSOC);
    $fecha = $registro["FECHA"];
    $resultado->closeCursor();
    $consulta = "SELECT CLAVE, FECHA, TOTAL, USUARIO FROM CAJA WHERE FECHA BETWEEN ? AND ? AND DEPARTAMENTO=? ORDER BY FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($fecha,fechaConsulta($fechaFin),$departamento));
  }
  elseif($idCobranza==""&&$fecha!=""&&$fechaFin!=""){
    $consulta = "SELECT CLAVE, FECHA, TOTAL, USUARIO FROM CAJA WHERE FECHA BETWEEN ? AND ? AND DEPARTAMENTO=? ORDER BY FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array(fechaConsulta($fecha),fechaConsulta($fechaFin),$departamento));
  }

}
else{
  if($idCobranza!=""&&$fecha==""&&$fechaFin==""){
    $consulta = "SELECT CLAVE, FECHA, TOTAL, USUARIO FROM CAJA WHERE CLAVE=?";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($idCobranza));
  }
  elseif($idCobranza==""&&$fecha!=""&&$fechaFin==""){
    $consulta = "SELECT FECHA FROM CAJA ORDER BY FECHA DESC LIMIT 1";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array());
    $registro = $resultado->fetch(PDO::FETCH_ASSOC);
    $fechaFin = $registro["FECHA"];
    $resultado->closeCursor();
    $consulta = "SELECT CLAVE, FECHA, TOTAL, USUARIO FROM CAJA WHERE FECHA BETWEEN ? AND ? ORDER BY FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array(fechaConsulta($fecha),$fechaFin));
  }
  elseif($idCobranza==""&&$fecha==""&&$fechaFin!=""){
    $consulta = "SELECT FECHA FROM CAJA ORDER BY FECHA ASC LIMIT 1";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array());
    $registro = $resultado->fetch(PDO::FETCH_ASSOC);
    $fecha = $registro["FECHA"];
    $resultado->closeCursor();
    $consulta = "SELECT CLAVE, FECHA, TOTAL, USUARIO FROM CAJA WHERE FECHA BETWEEN ? AND ? ORDER BY FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($fecha,fechaConsulta($fechaFin)));
  }
  elseif($idCobranza==""&&$fecha!=""&&$fechaFin!=""){
    $consulta = "SELECT CLAVE, FECHA, TOTAL, USUARIO FROM CAJA WHERE FECHA BETWEEN ? AND ? ORDER BY FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array(fechaConsulta($fecha),fechaConsulta($fechaFin)));
  }

}
$arreglo[$contador]["clave"] = "";
$arreglo[$contador]["fecha"] = "";
$arreglo[$contador]["total"] = "";
$arreglo[$contador]["usuario"] = "";

while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
  $arreglo[$contador]["clave"] = $registro["CLAVE"];
  $arreglo[$contador]["fecha"] = fechaStandar($registro["FECHA"]);
  $arreglo[$contador]["total"] = $registro["TOTAL"];
  $arreglo[$contador]["usuario"] = $registro["USUARIO"];
  $contador++;
}

$resultado->closeCursor();
$base = null;


echo json_encode($arreglo);
?>
