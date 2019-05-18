<?php

  require_once("../../funciones.php");
  $factura = $_POST['factura'];
  $cliente = $_POST['cliente'];
  $fecha = $_POST['fecha'];
  $tipo = $_POST['tipo'];
  $facturas = array();
  $clientes = array();
  $nombre = array();
  $estatus = array();
  $fechas = array();
  $descuento = array();
  $importe = array();
  $vendedor = array();
  $entrada = array();
  $contador = 0;
  $arreglo = array();
  $base = conexion_local();

  //Consulta and de los 3
  if($factura!=""&&$cliente!=""&&$fecha!=""){
    $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND CLIENTE=? AND FECHA=? ORDER BY CLAVE DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($factura, $cliente, $fecha));
  }
  //Consulta and de factura y cliente
  elseif($factura!=""&&$cliente!=""){
    $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND CLIENTE=? ORDER BY CLAVE DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($factura, $cliente));
  }
  //Consulta and de factura y fecha
  elseif ($factura!=""&&$fecha!=""){
    $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND FECHA=? ORDER BY CLAVE DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($factura, $fecha));
  }
  //Consulta and de cliente y fecha
  elseif ($cliente!=""&&$fecha!=""){
    $consulta = "SELECT * FROM CARGAS WHERE CLIENTE=? AND FECHA=? ORDER BY CLAVE DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($cliente, $fecha));
  }
  //Consulta individual factura
  elseif ($factura!=""){
    $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? ORDER BY CLAVE DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($factura));
  }
  //Consulta individual cliente
  elseif ($cliente!=""){
    $consulta = "SELECT * FROM CARGAS WHERE CLIENTE=? ORDER BY CLAVE DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($cliente));
  }
  //Consulta individual fecha
  elseif ($fecha!=""){
    $consulta = "SELECT * FROM CARGAS WHERE FECHA=? ORDER BY CLAVE DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($fecha));
  }


  while ($registro = $resultado->fetch(PDO::FETCH_NUM)){
    $facturas[$contador] = $registro[0];
    $clientes[$contador] = $registro[1];
    $nombre[$contador] = $registro[2];
    $estatus[$contador] = $registro[3];
    $fechas[$contador] = $registro[4];
    $descuento[$contador] = $registro[5];
    $importe[$contador] = $registro[6];
    $vendedor[$contador] = $registro[7];
    $entrada[$contador] = $registro[10];

    $contador++;
  }
  $arreglo[0] = $contador;
  $arreglo[1] = $facturas;
  $arreglo[2] = $clientes;
  $arreglo[3] = $nombre;
  $arreglo[4] = $estatus;
  $arreglo[5] = $fechas;
  $arreglo[6] = $importe;
  $arreglo[7] = $vendedor;
  $arreglo[8] = $descuento;
  $arreglo[9] = $entrada;
  $arreglo[10] = $tipo;
  //$arreglo = [$contador, $facturas, $clientes, $nombre, $estatus, $fechas, $descuento, $importe, $vendedor];
  echo json_encode($arreglo);
?>
