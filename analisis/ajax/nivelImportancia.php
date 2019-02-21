<?php
  require_once("../../funciones.php");
  //Recuperamos el tipo, caro igual o barato
  $tipo = $_POST['tipo'];
  $descuentoApa = $_POST['descuentoApa'];
  $descuentoVazlo = $_POST['descuentoVazlo'];
  $i = 0;

  $base = conexion_local();
  $consulta = "SELECT IMPORTANCIA, CLAVEDEARTÍCULO, PRECIO, ID_VAZLO, PRECIO_VAZLO FROM PRODUCTOS1 ORDER BY IMPORTANCIA ASC";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array());

  //Construiremos un arreglo bidimensional
  $arreglo = array();


  while($registro = $resultado->fetch(PDO::FETCH_NUM)){

      if(sub($registro[2], $descuentoApa)>sub($registro[4], $descuentoVazlo)){
        // $arreglo[$i][0] = $registro[0];
        // $arreglo[$]
        $i++;
      }

  }

$arreglo[0] = $i;

  echo json_encode($arreglo);

?>
