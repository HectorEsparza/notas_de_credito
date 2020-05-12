<?php
  session_start();
  $usuario = $_SESSION["user"];
  require_once("../../funciones.php");
  $arreglo = array();
  $fecha = $_POST['fecha'];
  $tipo = $_POST['tipo'];
  $folio = "";
  //$fecha = "29/07/2019";
  // $departamento = "COBRANZA";
  // $tipo = "remisiones";
  $clave = "";
  $opcion = "fechaDisponible";
  $contador = 1;
  $base = conexion_local();
  //Obtenemos el departamento y permiso del usuario
  $consulta = "SELECT DEPARTAMENTO,PERMISO FROM USUARIOS WHERE USUARIO=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($usuario));
  $registro = $resultado->fetch(PDO::FETCH_ASSOC);
  $departamento = $registro["DEPARTAMENTO"];
  $permiso = $registro["PERMISO"];
  $resultado->closeCursor();

  //Verificar si la fecha esta disponible
  if($tipo=="facturas"){
    $consulta = "SELECT FECHA FROM CONTADO WHERE DEPARTAMENTO=? AND FOLIO LIKE ? ORDER BY FECHA ASC";
    $clave = "CF%";
  }
  elseif($tipo=="remisiones"){
    $consulta = "SELECT FECHA FROM CONTADO WHERE DEPARTAMENTO=? AND FOLIO LIKE ? ORDER BY FECHA ASC";
    $clave = "CR%";
  }
  //$consulta = "SELECT FECHA FROM CONTADO WHERE DEPARTAMENTO=? ORDER BY FECHA ASC";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($departamento, $clave));
  while($registro = $resultado->fetch(PDO::FETCH_ASSOC)){
    if($registro["FECHA"]==fechaConsulta($fecha)){
      $opcion = "fechaNoDisponoble";
    }
    $contador++;
  }
  $resultado->closeCursor();
  $base = null;
  if($tipo=="facturas"){
    if($departamento=="CONTADOS"){
      $folio = "CFPB" . $contador;
    }
    else if($departamento=="CONTADOS_TECAMAC"){
      $folio = "CFTC" . $contador;
    }
  }
  else if($tipo=="remisiones"){
    if($departamento=="CONTADOS"){
      $folio = "CRPB" . $contador;
    }
    else if($departamento=="CONTADOS_TECAMAC"){
      $folio = "CRTC" . $contador;
    }
  }
  
  $arreglo[0] = $folio;
  $arreglo[1] = $opcion;
  echo json_encode($arreglo);

?>
