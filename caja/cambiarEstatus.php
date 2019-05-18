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
  require_once 'PHPExcel/Classes/PHPExcel.php';
  $inputFileType = PHPExcel_IOFactory::identify($archivo);
  $objReader = PHPExcel_IOFactory::createReader($inputFileType);
  $objPHPExcel = $objReader->load($archivo);
  $sheet = $objPHPExcel->getSheet(0);
  $highestRow = $sheet->getHighestRow();
  $highestColumn = $sheet->getHighestColumn();

  for ($row = 2; $row <= $highestRow; $row++){
      $factura[$contador] = $sheet->getCell("A".$row)->getValue();
      $estatus[$contador] = $sheet->getCell("B".$row)->getValue();
      $contador++;
      // echo $sheet->getCell("A".$row)->getValue()." - ";
      // echo $sheet->getCell("B".$row)->getValue()." - ";
      // echo $sheet->getCell("C".$row)->getValue()." - ";
      // echo $sheet->getCell("D".$row)->getValue()." - ";
      // echo $sheet->getCell("E".$row)->getValue()." - ";
      // echo $sheet->getCell("F".$row)->getValue()." - ";
      // echo $sheet->getCell("G".$row)->getValue()." - ";
      // echo $sheet->getCell("H".$row)->getValue();
      //echo "<br />";
  }
  //echo $descuento[0];
  //echo $factura[0]." ".$cliente[0]." ".$nombre[0]." ".$estatus[0]." ".$fecha[0]." ".$descuento[0]." ".$importe[0]." ".$vendedor[0];
  //echo $archivo;
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
