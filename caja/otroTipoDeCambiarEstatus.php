<?php
  require_once("../funciones.php");
  $archivo = $_FILES['archivo']['name'];
  $ruta = $_FILES['archivo']['tmp_name'];
  $destino = "cargas\\" . $archivo;
  move_uploaded_file($ruta, $destino);
  $archivo = "cargas/".$archivo;
  $factura = array();
  $estatus = array();
  $contador = 0;
  $xlsx = new SimpleXLSX( '' . $archivo . '' );
  foreach ($xlsx->rows() as $fields){
     $factura[$contador] = $fields[0];
     $estatus[$contador] = $fields[1];
     $contador++;
     // echo $fields[0] . " ";
     // echo $fields[1] . " ";
  }
  $base = conexion_local();
  for ($i=0; $i < $contador ; $i++) {
    //echo $factura[$i] . " " . $estatus[$i] . "<br />";
    $consulta = "UPDATE CARGAS SET ESTATUS=? WHERE CLAVE=?";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($estatus[$i], $factura[$i]));
  }
  $resultado->closeCursor();
  $base = null;
  header("location:facturasSinEntrada.php");
?>
