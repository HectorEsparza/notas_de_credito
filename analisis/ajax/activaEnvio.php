<?php

  require_once("../../funciones.php");
  $idApa = $_POST['idApa'];
  $descripcion = $_POST['descripcion'];
  $precio = $_POST['precio'];
  $linea = $_POST['linea'];
  $sublinea = $_POST['sublinea'];
  $idVazlo = $_POST['idVazlo'];
  $precioVazlo = $_POST['precioVazlo'];
  $importancia = $_POST['importancia'];
  $anteriorApa = $_POST['anteriorApa'];
  $contador = 0;

  // $arreglo = array();
  // $arreglo[0] = $_POST['idApa'];
  // $arreglo[1] = $_POST['descripcion'];
  // $arreglo[2] = $_POST['precio'];
  // $arreglo[3] = $_POST['linea'];
  // $arreglo[4] = $_POST['sublinea'];
  // $arreglo[5] = $_POST['idVazlo'];
  // $arreglo[6] = $_POST['precioVazlo'];
  // $arreglo[7] = $_POST['importancia'];
  // $arreglo[8] = $_POST['anteriorApa'];
  //
  // echo json_encode($arreglo);

  if($idApa!=""){
    $base = conexion_local();
    $consulta = "SELECT CLAVEDEARTÍCULO FROM PRODUCTOS1";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array());
    while($registro = $resultado->fetch(PDO::FETCH_NUM)){
      if($idApa==$registro[0]){
        $contador++;
      }
    }
    $resultado->closeCursor();

    if($contador==0){
      if($idVazlo==""){
        $idVazlo="NA";
      }
      if($precio==""){
        $precio=0.00;
      }
      if($precioVazlo==""){
        $precioVazlo=0.00;
      }
      if($importancia==""){
        $importancia="C";
      }

      $consulta = "UPDATE PRODUCTOS1 SET CLAVEDEARTÍCULO=?, DESCRIPCIÓN=?, PRECIO=?, LINEA=?, SUBLINEA=?, ID_VAZLO=?, PRECIO_VAZLO=?, IMPORTANCIA=? WHERE CLAVEDEARTÍCULO=?";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($idApa, $descripcion, $precio, $linea, $sublinea, $idVazlo, $precioVazlo, $importancia, $anteriorApa));
      $resultado->closeCursor();
      echo "exito";
    }
    else{
      echo "repetido";
    }


  }
  else{
    echo "vacio";
  }
?>
