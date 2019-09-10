<?php
require_once("../../funciones.php");

$nocliente = $_GET['nocliente'];
$cliente = $_GET['cliente'];
$fecha = $_GET['fecha'];
$folio = $_GET['folio'];
$recepcion = $_GET['recepcion'];
$clave = $_GET['clave'];
$contador = 1;
$flag = 0;


$base = conexion_local();

if($nocliente!=""&&$cliente!=""&&$fecha!=""&&$recepcion!=""&&$clave!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE NOCLIENTE=? AND CLIENTE=? AND NOTAS_VIS.FECHA=? AND RECEPCION=? AND SKU=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $cliente, fechaConsulta($fecha), $recepcion, $clave, $folio));
  }
  //Grupos de 5
  elseif($nocliente!=""&&$cliente!=""&&$fecha!=""&&$recepcion!=""&&$clave!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE NOCLIENTE=? AND CLIENTE=? AND NOTAS_VIS.FECHA=? AND RECEPCION=? AND SKU=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $cliente, fechaConsulta($fecha), $recepcion, $clave));
  }
  elseif($nocliente!=""&&$cliente!=""&&$fecha!=""&&$recepcion!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE=? AND NOTAS_VIS.FECHA=? AND RECEPCION=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $cliente, fechaConsulta($fecha), $recepcion, $folio));
  }
  elseif($nocliente!=""&&$cliente!=""&&$fecha!=""&&$clave!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE NOCLIENTE=? AND CLIENTE=? AND NOTAS_VIS.FECHA=? AND SKU=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $cliente, fechaConsulta($fecha), $clave, $folio));
  }
  elseif($nocliente!=""&&$cliente!=""&&$recepcion!=""&&$clave!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE NOCLIENTE=? AND CLIENTE=? AND RECEPCION=? AND SKU=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $cliente, $recepcion, $clave, $folio));
  }
  elseif($nocliente!=""&&$fecha!=""&&$recepcion!=""&&$clave!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE NOCLIENTE=? AND NOTAS_VIS.FECHA=? AND RECEPCION=? AND SKU=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, fechaConsulta($fecha), $recepcion, $clave, $folio));
  }
  elseif($cliente!=""&&$fecha!=""&&$recepcion!=""&&$clave!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO CLIENTE=? AND NOTAS_VIS.FECHA=? AND RECEPCION=? AND SKU=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($cliente, fechaConsulta($fecha), $recepcion, $clave, $folio));
  }
  //Grupos 4
  elseif($nocliente!=""&&$cliente!=""&&$fecha!=""&&$recepcion!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE=? AND NOTAS_VIS.FECHA=? AND RECEPCION=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $cliente, fechaConsulta($fecha), $recepcion));
  }
  elseif($nocliente!=""&&$cliente!=""&&$fecha!=""&&$clave!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE NOCLIENTE=? AND CLIENTE=? AND NOTAS_VIS.FECHA=? AND SKU=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $cliente, fechaConsulta($fecha), $clave));
  }
  elseif($nocliente!=""&&$cliente!=""&&$fecha!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE=? AND NOTAS_VIS.FECHA=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $cliente, fechaConsulta($fecha), $folio));
  }
  elseif($nocliente!=""&&$cliente!=""&&$recepcion!=""&&$clave!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE NOCLIENTE=? AND CLIENTE=? AND RECEPCION=? AND SKU=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $cliente, $recepcion, $clave));
  }
  elseif($nocliente!=""&&$cliente!=""&&$recepcion!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE=? AND RECEPCION=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $cliente, $recepcion, $folio));
  }
  elseif($nocliente!=""&&$cliente!=""&&$clave!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE NOCLIENTE=? AND CLIENTE=? AND SKU=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $cliente, $clave, $folio));
  }
  elseif($nocliente!=""&&$fecha!=""&&$recepcion!=""&&$clave!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE NOCLIENTE=? AND NOTAS_VIS.FECHA=? AND RECEPCION=? AND SKU=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, fechaConsulta($fecha), $recepcion, $clave));
  }
  elseif($nocliente!=""&&$fecha!=""&&$recepcion!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND NOTAS_VIS.FECHA=? AND RECEPCION=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, fechaConsulta($fecha), $recepcion, $folio));
  }
  elseif($nocliente!=""&&$fecha!=""&&$clave!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE NOCLIENTE=? AND NOTAS_VIS.FECHA=? AND SKU=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, fechaConsulta($fecha), $clave, $folio));
  }
  elseif($nocliente!=""&&$recepcion!=""&&$clave!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE NOCLIENTE=? AND RECEPCION=? AND SKU=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $recepcion, $clave, $folio));
  }
  elseif($cliente!=""&&$fecha!=""&&$recepcion!=""&&$clave!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE CLIENTE=? AND NOTAS_VIS.FECHA=? AND RECEPCION=? AND SKU=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($cliente, fechaConsulta($fecha), $recepcion, $clave));
  }
  elseif($cliente!=""&&$fecha!=""&&$recepcion!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE=? AND NOTAS_VIS.FECHA=? AND RECEPCION=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($cliente, fechaConsulta($fecha), $recepcion, $folio));
  }
  elseif($cliente!=""&&$fecha!=""&&$clave!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE=? AND NOTAS_VIS.FECHA=? AND SKU=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($cliente, fechaConsulta($fecha), $clave, $folio));
  }
  elseif($cliente!=""&&$recepcion!=""&&$clave!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE=? AND RECEPCION=? AND SKU=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($cliente, $recepcion, $clave, $folio));
  }
  elseif($fecha!=""&&$recepcion!=""&&$clave!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE NOTAS_VIS.FECHA=? AND RECEPCION=? AND SKU=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array(fechaConsulta($fecha), $recepcion, $clave, $folio));
  }
  //Grupos de 3
  elseif($nocliente!=""&&$cliente!=""&&$fecha!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE=? AND NOTAS_VIS.FECHA=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $cliente, fechaConsulta($fecha)));
  }
  elseif($nocliente!=""&&$cliente!=""&&$recepcion!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE=? AND RECEPCION=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $cliente, $recepcion));
  }
  elseif($nocliente!=""&&$cliente!=""&&$clave!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE=? AND SKU=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $cliente, $clave));
  }
  elseif($nocliente!=""&&$cliente!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $cliente, $folio));
  }
  elseif($nocliente!=""&&$fecha!=""&&$recepcion!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND NOTAS_VIS.FECHA=? AND RECEPCION=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, fechaConsulta($fecha), $recepcion));
  }
  elseif($nocliente!=""&&$fecha!=""&&$clave!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE NOCLIENTE=? AND NOTAS_VIS.FECHA=? AND SKU=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, fechaConsulta($fecha), $clave));
  }
  elseif($nocliente!=""&&$fecha!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND NOTAS_VIS.FECHA=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, fechaConsulta($fecha), $folio));
  }
  elseif($nocliente!=""&&$recepcion!=""&&$clave!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE NOCLIENTE=? AND RECEPCION=? AND SKU=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $recepcion, $clave));
  }
  elseif($nocliente!=""&&$recepcion!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND RECEPCION=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $recepcion, $folio));
  }
  elseif($nocliente!=""&&$clave!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE NOCLIENTE=? AND SKU=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $clave, $folio));
  }
  elseif($cliente!=""&&$fecha!=""&&$recepcion!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE=? AND NOTAS_VIS.FECHA=? AND RECEPCION=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($cliente, fechaConsulta($fecha), $recepcion));
  }
  elseif($cliente!=""&&$fecha!=""&&$clave!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE CLIENTE=? AND NOTAS_VIS.FECHA=? AND SKU=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($cliente, fechaConsulta($fecha), $clave));
  }
  elseif($cliente!=""&&$fecha!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE=? AND NOTAS_VIS.FECHA=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($cliente, fechaConsulta($fecha), $folio));
  }
  elseif($cliente!=""&&$recepcion!=""&&$clave!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE CLIENTE=? AND RECEPCION=? AND SKU=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($cliente, $recepcion, $clave));
  }
  elseif($cliente!=""&&$recepcion!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE=? AND RECEPCION=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($cliente, $recepcion, $folio));
  }
  elseif($cliente!=""&&$clave!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE CLIENTE=? AND SKU=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($cliente, $clave, $folio));
  }
  elseif($fecha!=""&&$recepcion!=""&&$clave!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE NOTAS_VIS.FECHA=? AND RECEPCION=? AND SKU=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array(fechaConsulta($fecha), $recepcion, $clave));
  }
  elseif($fecha!=""&&$recepcion!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOTAS_VIS.FECHA=? AND RECEPCION=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array(fechaConsulta($fecha), $recepcion, $folio));
  }
  elseif($fecha!=""&&$clave!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE NOTAS_VIS.FECHA=? AND SKU=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array(fechaConsulta($fecha), $clave, $folio));
  }
  elseif($recepcion!=""&&$clave!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE RECEPCION=? AND SKU=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($recepcion, $clave, $folio));
  }
  //Grupos 2
  elseif($nocliente!=""&&$cliente!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $cliente));
  }
  elseif($nocliente!=""&&$fecha!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND NOTAS_VIS.FECHA=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, fechaConsulta($fecha)));
  }
  elseif($nocliente!=""&&$recepcion!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND RECEPCION=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $recepcion));
  }
  elseif($nocliente!=""&&$clave!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE NOCLIENTE=? AND SKU=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $clave));
  }
  elseif($nocliente!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND SKU=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $folio));
  }
  elseif($cliente!=""&&$fecha!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE=? AND NOTAS_VIS.FECHA=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($cliente, fechaConsulta($fecha)));
  }
  elseif($cliente!=""&&$recepcion!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE=? AND RECEPCION=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($cliente, $recepcion));
  }
  elseif($cliente!=""&&$clave!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE CLIENTE=? AND SKU=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($cliente, $clave));
  }
  elseif($cliente!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($cliente, $folio));
  }
  elseif($fecha!=""&&$recepcion!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOTAS_VIS.FECHA=? AND RECEPCION=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array(fechaConsulta($fecha), $recepcion));
  }
  elseif($fecha!=""&&$clave!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE NOTAS_VIS.FECHA=? AND SKU=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array(fechaConsulta($fecha), $clave));
  }
  elseif($fecha!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOTAS_VIS.FECHA=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array(fechaConsulta($fecha), $folio));
  }
  elseif($recepcion!=""&&$clave!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE RECEPCION=? AND SKU=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($recepcion, $clave));
  }
  elseif($recepcion!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE RECEPCION=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($recepcion, $folio));
  }
  elseif($recepcion!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE RECEPCION=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($recepcion, $folio));
  }
  elseif($clave!=""&&$folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE SKU=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($clave, $folio));
  }
  //Grupos de 1
  elseif ($nocliente!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente));
  }
  elseif ($cliente!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($cliente));
  }
  elseif ($fecha!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOTAS_VIS.FECHA=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array(fechaConsulta($fecha)));
  }
  elseif ($recepcion!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE RECEPCION=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($recepcion));
  }
  elseif ($clave!=""){
    $consulta = "SELECT * FROM NOTAS_VIS INNER JOIN NOTAS ON NOTAS_VIS.FOLIOINTERNO=NOTAS.FOLIOINTERNO WHERE SKU=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($clave));
  }
  elseif ($folio!=""){
    $consulta = "SELECT * FROM NOTAS_VIS WHERE FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($folio));
  }

// if($nocliente!=""&&$cliente!=""&&$fecha!=""&&$folio!=""&&$recepcion!=""){
//   // echo "Consulta AND de los 5";
//   $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE LIKE ? AND NOTAS_VIS.FECHA=? AND FOLIOINTERNO=? AND RECEPCION=? ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//   $resultado = $base->prepare($consulta);
//   $resultado->execute(array($nocliente, '%' . $cliente . '%', fechaConsulta($fecha), $folio,  $recepcion));
// }
// elseif($nocliente!=""&&$cliente!=""&&$fecha!=""&&$folio!=""){
//   // echo "Consulta AND de los 4; nocliente, cliente, fecha, folio";
//   $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE LIKE ? AND NOTAS_VIS.FECHA=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//   $resultado = $base->prepare($consulta);
//   $resultado->execute(array($nocliente, '%' . $cliente . '%', fechaConsulta($fecha), $folio));
// }
// elseif($nocliente!=""&&$fecha!=""&&$folio!=""&&$recepcion!=""){
//   // echo "Consulta AND de los 4; nocliente, cliente, fecha, folioRecepcion";
//   $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND NOTAS_VIS.FECHA=? AND FOLIOINTERNO=? AND RECEPCION=? ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//   $resultado = $base->prepare($consulta);
//   $resultado->execute(array($nocliente, fechaConsulta($fecha), $folio, $recepcion));
// }
// elseif ($cliente!=""&&$fecha!=""&&$folio!=""&&$recepcion!="") {
//   // echo "Consulta AND de los 4; cliente, fecha, folio, folioRecepcion";
//   $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE LIKE ? AND NOTAS_VIS.FECHA=? AND FOLIOINTERNO=? AND RECEPCION=? ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//   $resultado = $base->prepare($consulta);
//   $resultado->execute(array('%' . $cliente . '%', fechaConsulta($fecha), $folio,  $recepcion));
// }
// elseif ($nocliente!=""&&$cliente!=""&&$fecha!=""&&$recepcion!="") {
//     // echo "Consulta AND de los 4; nocliente, cliente, fecha, folioRecepcion";
//     $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE LIKE ? AND NOTAS_VIS.FECHA=? AND RECEPCION=? ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//     $resultado = $base->prepare($consulta);
//     $resultado->execute(array($nocliente, '%' . $cliente . '%', fechaConsulta($fecha), $recepcion));
// }
// elseif ($nocliente!=""&&$cliente!=""&&$fecha!="") {
//     // echo "Consulta AND de los 3; nocliente, cliente, fecha";
//     $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE LIKE ? AND NOTAS_VIS.FECHA=? ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//     $resultado = $base->prepare($consulta);
//     $resultado->execute(array($nocliente, '%' . $cliente . '%', fechaConsulta($fecha)));
// }
// elseif ($nocliente!=""&&$fecha!=""&&$folio!="") {
//     // echo "Consulta AND de los 3; nocliente, fecha, folio";
//     $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND NOTAS_VIS.FECHA=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//     $resultado = $base->prepare($consulta);
//     $resultado->execute(array($nocliente, fechaConsulta($fecha), $folio));
// }
// elseif ($nocliente!=""&&$folio!=""&&$recepcion!="") {
//     // echo "Consulta AND de los 3; nocliente, folio, folioRecepcion";
//     $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND FOLIOINTERNO=? AND RECEPCION=? ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//     $resultado = $base->prepare($consulta);
//     $resultado->execute(array($nocliente, $folio, $recepcion));
// }
// elseif ($cliente!=""&&$fecha!=""&&$folio!="") {
//     // echo "Consulta AND de los 3; cliente, fecha, folio";
//     $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND NOTAS_VIS.FECHA=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//     $resultado = $base->prepare($consulta);
//     $resultado->execute(array($nocliente, fechaConsulta($fecha), $folio));
// }
// elseif ($cliente!=""&&$folio!=""&&$recepcion!="") {
//     // echo "Consulta AND de los 3; cliente, folio, folioRecepcion";
//     $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE LIKE ? AND FOLIOINTERNO=? AND RECEPCION=? ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//     $resultado = $base->prepare($consulta);
//     $resultado->execute(array('%' . $cliente . '%', $folio, $recepcion));
// }
// elseif ($fecha!=""&&$folio!=""&&$recepcion!="") {
//     // echo "Consulta AND de los 3; fecha, folio, folioRecepcion";
//     $consulta = "SELECT * FROM NOTAS_VIS WHERE NOTAS_VIS.FECHA=? AND FOLIOINTERNO=? AND RECEPCION=?ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//     $resultado = $base->prepare($consulta);
//     $resultado->execute(array(fechaConsulta($fecha), $folio, $recepcion));
// }
// elseif ($folio!=""&&$nocliente!=""&&$cliente!="") {
//     // echo "Consulta AND de los 3; folio, nocliente, cliente";
//     $consulta = "SELECT * FROM NOTAS_VIS WHERE FOLIOINTERNO=? AND NOCLIENTE=? AND CLIENTE=? ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//     $resultado = $base->prepare($consulta);
//     $resultado->execute(array($folio, $nocliente, '%' . $cliente . '%'));
// }
// elseif ($nocliente!=""&&$cliente!=""&&$recepcion!="") {
//     // echo "Consulta AND de los 3; nocliente, cliente, folioRecepcion";
//     $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE=? AND RECEPCION=? ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//     $resultado = $base->prepare($consulta);
//     $resultado->execute(array($nocliente, '%' . $cliente . '%', $recepcion));
// }
// elseif ($cliente!=""&&$fecha!=""&&$recepcion!="") {
//     // echo "Consulta AND de los 3; cliente, fecha, folioRecepcion";
//     $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE=? AND NOTAS_VIS.FECHA=? AND RECEPCION=? ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//     $resultado = $base->prepare($consulta);
//     $resultado->execute(array($folio, $nocliente, $recepcion));
// }
// elseif ($nocliente!=""&&$cliente!="") {
//     // echo "Consulta AND de los 2; nocliente y cliente";
//     $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE LIKE ? AND NOCLIENTE=? ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//     $resultado = $base->prepare($consulta);
//     $resultado->execute(array('%' . $cliente . '%', $nocliente));
// }
// elseif ($nocliente!=""&&$fecha!="") {
//     // echo "Consulta AND de los 2; nocliente y fecha";
//     $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND NOTAS_VIS.FECHA=? ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//     $resultado = $base->prepare($consulta);
//     $resultado->execute(array($nocliente, $fecha));
// }
// elseif ($nocliente!=""&&$folio!="") {
//     // echo "Consulta AND de los 2; nocliente y folio";
//     $consulta = "SELECT * FROM NOTAS_VIS WHERE FOLIOINTERNO=? AND NOCLIENTE=? ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//     $resultado = $base->prepare($consulta);
//     $resultado->execute(array($folio, $nocliente));
// }
// elseif ($nocliente!=""&&$recepcion!="") {
//     // echo "Consulta AND de los 2; nocliente y folioRecepcion";
//     $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND RECEPCION=? ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//     $resultado = $base->prepare($consulta);
//     $resultado->execute(array($nocliente, $recepcion));
// }
// elseif ($cliente!=""&&$fecha!="") {
//     // echo "Consulta AND de los 2; cliente y fecha";
//     $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE LIKE ? AND NOTAS_VIS.FECHA=? ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//     $resultado = $base->prepare($consulta);
//     $resultado->execute(array('%' . $cliente . '%', fechaConsulta($fecha)));
// }
// elseif ($cliente!=""&&$folio!="") {
//     // echo "Consulta AND de los 2; cliente y folio";
//     $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE LIKE ? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//     $resultado = $base->prepare($consulta);
//     $resultado->execute(array('%' . $cliente . '%', $folio));
// }
// elseif ($cliente!=""&&$recepcion!="") {
//     // echo "Consulta AND de los 2; cliente y folioRecepcion";
//     $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE LIKE ? AND RECEPCION=? ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//     $resultado = $base->prepare($consulta);
//     $resultado->execute(array('%' . $cliente . '%', $recepcion));
// }
// elseif ($fecha!=""&&$folio!="") {
//     // echo "Consulta AND de los 2; fecha y folio";
//     $consulta = "SELECT * FROM NOTAS_VIS WHERE NOTAS_VIS.FECHA=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//     $resultado = $base->prepare($consulta);
//     $resultado->execute(array(fechaConsulta($fecha), $folio));
// }
// elseif ($fecha!=""&&$recepcion!="") {
//     // echo "Consulta AND de los 2; fecha y folioRecepcion";
//     $consulta = "SELECT * FROM NOTAS_VIS WHERE NOTAS_VIS.FECHA=? AND RECEPCION=? ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//     $resultado = $base->prepare($consulta);
//     $resultado->execute(array(fechaConsulta($fecha), $recepcion));
// }
// elseif ($recepcion!=""&&$folio!="") {
//     // echo "Consulta AND de los 2; folioRecepcion y folio";
//     $consulta = "SELECT * FROM NOTAS_VIS WHERE RECEPCION=? AND FOLIOINTERNO=? ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//     $resultado = $base->prepare($consulta);
//     $resultado->execute(array($recepcion, $folio));
// }
// elseif ($nocliente!="") {
//   // echo "Consulta individual nocliente";
//   $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE= ?  ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//   $resultado = $base->prepare($consulta);
//   $resultado->execute(array($nocliente));
// }
// elseif ($cliente!="") {
//   // echo "Consulta individual cliente";
//   $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE LIKE ?  ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//   $resultado = $base->prepare($consulta);
//   $resultado->execute(array('%' . $cliente . '%'));
// }
// elseif ($fecha!="") {
//   // echo "Consulta individual fecha";
//   $consulta = "SELECT * FROM NOTAS_VIS WHERE FECHA= ?  ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//   $resultado = $base->prepare($consulta);
//   $resultado->execute(array(fechaConsulta($fecha)));
// }
// elseif ($folio!="") {
//   // echo "Consulta individual folio";
//   $consulta = "SELECT * FROM NOTAS_VIS WHERE FOLIOINTERNO= ?  ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//   $resultado = $base->prepare($consulta);
//   $resultado->execute(array($folio));
// }
// elseif ($recepcion!="") {
//   // echo "Consulta individual folioRecepcion";
//   $consulta = "SELECT * FROM NOTAS_VIS WHERE RECEPCION= ?  ORDER BY NOTAS_VIS.FECHA DESC DESC LIMIT 20";
//   $resultado = $base->prepare($consulta);
//   $resultado->execute(array($recepcion));
// }
else{
  echo "No introdujo ningun campo!!!";
  $flag = 1; //Está bandera me indica que no entro a ninguna consulta de la base de datos
}
?>
<? if($flag==0) :?>
    <table  border=1 align='center'>
        <thead>
            <tr>
              <th>Folio Interno</th>
              <th>Folio Recepción</th>
              <th>NO Cliente</th>
              <th>Cliente</th>
              <th>NO SAE</th>
              <th>Total Nota</th>
              <th>Fecha</th>
              <th>Status</th>
              <th>Info</th>
            </tr>
        </thead>
        <tbody id="table">
           <? while($registro = $resultado->fetch(PDO::FETCH_ASSOC)) :?>
                  <? if($registro["STATUS"]=="ACTIVA") :?>
                      <tr>
                              <td class='principal'><input type='text' class='folio<?= $contador?>' value='<?= $registro["FOLIOINTERNO"]?>' readonly /></td>
                              <td class='principal'><?= $registro["RECEPCION"]?></td>
                              <td class='principal'><?= $registro["NOCLIENTE"]?></td>
                              <td class='principal'><?= $registro["CLIENTE"]?></td>
                              <td class='principal'><?= $registro["NOTASAE"]?></td>
                              <td class='principal'><?= "$" . number_format($registro["TOTAL"], 2, ".", ",")?></td>
                              <td class='principal'><?= fechaJquery($registro["FECHA"])?></td>
                              <td class='principal'><?= $registro["STATUS"]?></td>
                              <td><button class='ver' onclick="saludo(document.querySelector('.folio<?= $contador?>').value)">Ver</button></td>
                      </tr>
                  <? else :?>
                     <tr>
                              <td class='cancelada'><input type='text' class='folio<?= $contador?>' value='<?= $registro["FOLIOINTERNO"]?>' readonly /></td>
                              <td class='cancelada'><?= $registro["RECEPCION"]?></td>
                              <td class='cancelada'><?= $registro["NOCLIENTE"]?></td>
                              <td class='cancelada'><?= $registro["CLIENTE"]?></td>
                              <td class='cancelada'><?= $registro["NOTASAE"]?></td>
                              <td class='cancelada'><?= "$" . number_format($registro["TOTAL"], 2, ".", ",")?></td>
                              <td class='cancelada'><?= fechaJquery($registro["FECHA"])?></td>
                              <td class='cancelada'><?= $registro["STATUS"]?></td>
                              <td>&nbsp;</td>
                     </tr>
                  <? endif?>

              <? $contador++;?>
           <? endwhile?>


        </tbody>
    </table>

<? endif?>
