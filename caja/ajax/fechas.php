<?php
  require_once("../../funciones.php");

  $fecha = $_POST['fecha'];
  $opcion = "fechaDisponible";
  $base = conexion_local();
  $consulta = "SELECT ID, FECHA FROM CAJA ORDER BY ID ASC";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array());
  $arreglo = array();

  while($registro = $resultado->fetch(PDO::FETCH_NUM)){
    if($registro[1]==$fecha){
      $opcion = "fechaNoDisponoble";
    }
    if($registro[0]==""){
      $arreglo[0] = 1;
      $arreglo[1] = $opcion;
    }
    else{
      $arreglo[0] = $registro[0]+1;
      $arreglo[1] = $opcion;
    }
  }
  $resultado->closeCursor();

  echo json_encode($arreglo);

?>
