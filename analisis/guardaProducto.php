<?php
  require_once("../funciones.php");
  $idApa = $_POST['idApa'];
  $descripcion = $_POST['descripcion'];
  $precio = $_POST['precio'];
  $linea = $_POST['linea'];
  $sublinea = $_POST['sublinea'];
  $idVazlo = $_POST['idVazlo'];
  $precioVazlo = $_POST['precioVazlo'];

  //echo $idApa . " " . $descripcion . " " . $precio . " " . $linea . " " . $sublinea . " " . $idVazlo . " " . $precioVazlo;
  if($idVazlo==""){
    $idVazlo ="NA";
  }
  if($precioVazlo==""){
    $precioVazlo = 0.00;
  }

  $base = conexion_local();
  $consulta = "INSERT INTO PRODUCTOS1(ID_APA, DESCRIPCION, PRECIO, LINEA, SUBLINEA, ID_VAZLO, PRECIO_VAZLO, IMPORTANCIA)
                      VALUES(?,?,?,?,?,?,?,?)";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($idApa, $descripcion, $precio, $linea, $sublinea, $idVazlo, $precioVazlo, $importancia));
  $resultado->closeCursor();

  header("location:analisis.php");

?>
