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

//echo $anteriorApa . " " . $anteriorVazlo;
$base = conexion_local();
$consulta = "UPDATE PRODUCTOS1 SET ID_APA=?, DESCRIPCION=?, PRECIO=?, LINEA=?, SUBLINEA=?, ID_VAZLO=?, IMPORTANCIA=? WHERE ID_APA=?";
$resultado = $base->prepare($consulta);
$resultado->execute($idApa, $descripcion, $precio, $linea, $sublinea, $idVazlo, $importancia, $anteriorApa);
$resultado->closeCursor();

header("location:analisis.php");

?>
