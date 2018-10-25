<?php
require_once("../funciones.php");
$id = $_POST['ID'];
$siVale = $_POST['siVale'];
$penales = $_POST['penales'];
$fotos = $_POST['fotos'];
$estudios = $_POST['estudios'];
$noEmpleado = $_POST['noEmpleado'];
// $contrato = $_POST['contrato'];
// $imss = $_POST['imss'];
$archivo = $_FILES['contrato']['name'];
$ruta = $_FILES['contrato']['tmp_name'];
$destino = "contrato\\" . $archivo;
move_uploaded_file($ruta, $destino);
$archivo2 = $_FILES['imss']['name'];
$ruta2 = $_FILES['imss']['tmp_name'];
$destino2 = "imss\\" . $archivo2;
move_uploaded_file($ruta2, $destino2);

//echo $penales . " " . $fotos . " " . $estudios;
if($archivo==""&&$archivo2==""){
  $base = conexion_local();
  $consulta = "UPDATE DOCUMENTOS SET ANTECEDENTES=?, FOTOS=?, ESTUDIO=? WHERE ID=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($penales, $fotos, $estudios, $id));
  $resultado->closeCursor();

  $consulta = "UPDATE SOLICITUD SET  STATUS=?, EMPLEADO=?, SIVALE=? WHERE ID=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array("Contratado", $noEmpleado, $siVale, $id));
  $resultado->closeCursor();
}
else{
  $base = conexion_local();
  $consulta = "UPDATE DOCUMENTOS SET ANTECEDENTES=?, FOTOS=?, ESTUDIO=? WHERE ID=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($penales, $fotos, $estudios, $id));
  $resultado->closeCursor();

  $consulta = "UPDATE SOLICITUD SET  STATUS=?, EMPLEADO=?, CONTRATO=?, IMSS=?, SIVALE=? WHERE ID=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array("Contratado", $noEmpleado, $archivo, $archivo2, $siVale, $id));
  $resultado->closeCursor();
}


header("location:visualizacion.php");




?>
