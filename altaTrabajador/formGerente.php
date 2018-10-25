<?php

require_once("../funciones.php");
$id = $_POST['ID'];
$bancomer = $_POST['bancomer'];
$estatus = $_POST['estatusFinal'];

//echo $estatus;
$base = conexion_local();
$consulta = "UPDATE SOLICITUD SET BANCOMER=?, STATUS=? WHERE ID=?";
$resultado = $base->prepare($consulta);
$resultado->execute(array($bancomer, $estatus, $id));
$resultado->closeCursor();

header("location:visualizacion.php");
?>
