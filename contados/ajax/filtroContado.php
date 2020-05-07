<?php
session_start();
$usuario = $_SESSION["user"];
require_once("../../funciones.php");
$idContado = $_POST['idContado'];
$fecha = $_POST['fecha'];
$fechaFin = $_POST['fechaFin'];
$arreglo = array();
$contador = 0;
$base = conexion_local();

//Obtenemos el departamento y permiso del usuario
$consulta = "SELECT DEPARTAMENTO,PERMISO FROM USUARIOS WHERE USUARIO=?";
$resultado = $base->prepare($consulta);
$resultado->execute(array($usuario));
$registro = $resultado->fetch(PDO::FETCH_ASSOC);
$departamento = $registro["DEPARTAMENTO"];
$permiso = $registro["PERMISO"];
$resultado->closeCursor();

if($departamento=="CONTADOS" || $departamento=="CONTADOS_TECAMAC"){

  if(($idContado!=""&&$fecha==""&&$fechaFin=="") || ($idContado!=""&&$fecha!=""&&$fechaFin!="")){
    $consulta = "SELECT FOLIO, FECHA, TOTAL, USUARIO FROM CONTADO WHERE FOLIO=? AND DEPARTAMENTO=?";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($idContado,$departamento));
  }
  elseif($idContado==""&&$fecha!=""&&$fechaFin==""){
    $consulta = "SELECT FECHA FROM CONTADO ORDER BY FECHA DESC LIMIT 1";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array());
    $registro = $resultado->fetch(PDO::FETCH_ASSOC);
    $fechaFin = $registro["FECHA"];
    $resultado->closeCursor();
    $consulta = "SELECT FOLIO, FECHA, TOTAL, USUARIO FROM CONTADO WHERE FECHA BETWEEN ? AND ? AND DEPARTAMENTO=? ORDER BY FECHA DESC ";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array(fechaConsulta($fecha),$fechaFin,$departamento));
  }
  elseif($idContado==""&&$fecha==""&&$fechaFin!=""){
    $consulta = "SELECT FECHA FROM CONTADO ORDER BY FECHA ASC LIMIT 1";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array());
    $registro = $resultado->fetch(PDO::FETCH_ASSOC);
    $fecha = $registro["FECHA"];
    $resultado->closeCursor();
    $consulta = "SELECT FOLIO, FECHA, TOTAL, USUARIO FROM CONTADO WHERE FECHA BETWEEN ? AND ? AND DEPARTAMENTO=? ORDER BY FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($fecha,fechaConsulta($fechaFin),$departamento));
  }
  elseif($idContado==""&&$fecha!=""&&$fechaFin!=""){
    $consulta = "SELECT FOLIO, FECHA, TOTAL, USUARIO FROM CONTADO WHERE FECHA BETWEEN ? AND ? AND DEPARTAMENTO=? ORDER BY FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array(fechaConsulta($fecha),fechaConsulta($fechaFin),$departamento));
  }

}
else{
  if($idContado!=""&&$fecha==""&&$fechaFin==""){
    $consulta = "SELECT FOLIO, FECHA, TOTAL, USUARIO FROM CONTADO WHERE FOLIO=?";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($idContado));
  }
  elseif($idContado==""&&$fecha!=""&&$fechaFin==""){
    $consulta = "SELECT FECHA FROM CONTADO ORDER BY FECHA DESC LIMIT 1";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array());
    $registro = $resultado->fetch(PDO::FETCH_ASSOC);
    $fechaFin = $registro["FECHA"];
    $resultado->closeCursor();
    $consulta = "SELECT FOLIO, FECHA, TOTAL, USUARIO FROM CONTADO WHERE FECHA BETWEEN ? AND ? ORDER BY FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array(fechaConsulta($fecha),$fechaFin));
  }
  elseif($idContado==""&&$fecha==""&&$fechaFin!=""){
    $consulta = "SELECT FECHA FROM CONTADO ORDER BY FECHA ASC LIMIT 1";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array());
    $registro = $resultado->fetch(PDO::FETCH_ASSOC);
    $fecha = $registro["FECHA"];
    $resultado->closeCursor();
    $consulta = "SELECT FOLIO, FECHA, TOTAL, USUARIO FROM CONTADO WHERE FECHA BETWEEN ? AND ? ORDER BY FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($fecha,fechaConsulta($fechaFin)));
  }
  elseif($idContado==""&&$fecha!=""&&$fechaFin!=""){
    $consulta = "SELECT FOLIO, FECHA, TOTAL, USUARIO FROM CONTADO WHERE FECHA BETWEEN ? AND ? ORDER BY FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array(fechaConsulta($fecha),fechaConsulta($fechaFin)));
  }

}
$arreglo[$contador]["folio"] = "";
$arreglo[$contador]["fecha"] = "";
$arreglo[$contador]["total"] = "";
$arreglo[$contador]["usuario"] = "";

while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
  $arreglo[$contador]["folio"] = $registro["FOLIO"];
  $arreglo[$contador]["fecha"] = fechaStandar($registro["FECHA"]);
  $arreglo[$contador]["total"] = $registro["TOTAL"];
  $arreglo[$contador]["usuario"] = $registro["USUARIO"];
  $contador++;
}

$resultado->closeCursor();
$base = null;


echo json_encode($arreglo);
?>
