<?php
  require_once("../../funciones.php");
  $arreglo = array();
  $fecha = $_POST['fecha'];
  $departamento = $_POST['departamento'];
  $tipo = $_POST['tipo'];
  $folio = "";
  // $fecha = "29/07/2019";
  // $departamento = "COBRANZA";
  // $tipo = "remisiones";
  $clave = "";
  $opcion = "fechaDisponible";
  $contador = 1;
  $base = conexion_local();
  if($tipo=="facturas"){
    $consulta = "SELECT FECHA FROM CAJA WHERE DEPARTAMENTO=? AND CLAVE LIKE ? ORDER BY CLAVE ASC";
    $clave = "F%";
  }
  elseif($tipo=="remisiones"){
    $consulta = "SELECT FECHA FROM CAJA WHERE DEPARTAMENTO=? AND CLAVE LIKE ? ORDER BY CLAVE ASC";
    $clave = "R%";
  }
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($departamento, $clave));
  while($registro = $resultado->fetch(PDO::FETCH_NUM)){
    if($registro[0]==fechaConsulta($fecha)){
      $opcion = "fechaNoDisponoble";
    }
    $contador++;
  }
  $resultado->closeCursor();
  if($tipo=="facturas"){
    if($departamento=="COBRANZA"){
      $folio = "FPB" . $contador;
    }
    else if($departamento=="COBRANZA_TECAMAC"){
      $folio = "FTC" . $contador;
    }
  }
  else if($tipo=="remisiones"){
    if($departamento=="COBRANZA"){
      $folio = "RPB" . $contador;
    }
    else if($departamento=="COBRANZA_TECAMAC"){
      $folio = "RTC" . $contador;
    }
  }
  $arreglo[0] = $folio;
  $arreglo[1] = $opcion;
  echo json_encode($arreglo);

?>
