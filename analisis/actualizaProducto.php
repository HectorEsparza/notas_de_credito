<?php

require_once("../funciones.php");
$anteriorApa = $_POST['anteriorApa'];
$anteriorVazlo = $_POST['anteriorVazlo'];
$idApa = $_POST['idApa'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$linea = strtoupper($_POST['linea']);
$sublinea = strtoupper($_POST['sublinea']);
$idVazlo = $_POST['idVazlo'];
$precioVazlo = $_POST['precioVazlo'];
$importancia = $_POST['importancia'];

if($idVazlo==""){
  $idVazlo ="NA";
}
if($precioVazlo==""){
  $precioVazlo = 0.00;
}

  // echo $anteriorApa . " " . $anteriorVazlo . "<br />";
  // echo $idApa . " " . $descripcion . " " . $precio . " " . $linea . " " . $sublinea . " " . $idVazlo . " " . $precioVazlo . " " . $importancia;
//echo $anteriorApa . " " . $anteriorVazlo;
$base = conexion_local();
$consulta = "UPDATE PRODUCTOS1 SET CLAVEDEARTÍCULO=?, DESCRIPCIÓN=?, PRECIO=?, LINEA=?, SUBLINEA=?, ID_VAZLO=?, PRECIO_VAZLO=?, IMPORTANCIA=? WHERE CLAVEDEARTÍCULO=?";
$resultado = $base->prepare($consulta);
$resultado->execute(array($idApa, $descripcion, $precio, $linea, $sublinea, $idVazlo, $precioVazlo, $importancia, $anteriorApa));
$resultado->closeCursor();

header("location:analisis.php");

?>
