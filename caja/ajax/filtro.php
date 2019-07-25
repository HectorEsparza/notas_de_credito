<?php

  require_once("../../funciones.php");
  $factura = $_POST['factura'];
  $cliente = $_POST['cliente'];
  $fecha = $_POST['fecha'];
  $fechaCorte = $_POST['fechaCorte'];
  $pago = $_POST['pago'];
  $folio = $_POST['folio'];
  $tipo = $_POST['tipo'];
  // $factura = "FD60290";
  // $cliente = "1767";
  // $fecha = "02/05/2019";
  // $fechaCorte = "01/06/2019";
  // $pago = "";
  // $folio = "";
  // $tipo = "conEntrada";
  $facturas = array();
  $clientes = array();
  $nombre = array();
  $estatus = array();
  $fechas = array();
  $descuento = array();
  $importe = array();
  $vendedor = array();
  $entrada = array();
  $metodos = array();
  $folios = array();
  $fechasCorte = array();
  $contador = 0;
  $arreglo = array();
  $base = conexion_local();

    if($factura!=""&&$cliente!=""&&$fecha!=""&&$fechaCorte!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND CLIENTE=? AND FECHA=? AND FECHA_ENTRADA=? AND METODO=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, $fecha, $fechaCorte, $pago, $folio));
    }
    //Grupos de 5
    elseif($factura!=""&&$cliente!=""&&$fecha!=""&&$fechaCorte!=""&&$pago!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND CLIENTE=? AND FECHA=? AND FECHA_ENTRADA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, $fecha, $fechaCorte, $pago));
    }
    elseif($factura!=""&&$cliente!=""&&$fecha!=""&&$fechaCorte!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND CLIENTE=? AND FECHA=? AND FECHA_ENTRADA=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, $fecha, $fechaCorte, $folio));
    }
    elseif($factura!=""&&$cliente!=""&&$fecha!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND CLIENTE=? AND FECHA=? AND METODO=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, $fecha, $pago, $folio));
    }
    elseif($factura!=""&&$cliente!=""&&$fechaCorte!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND CLIENTE=? AND FECHA_ENTRADA=? AND METODO=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, $fechaCorte, $pago, $folio));
    }
    elseif($factura!=""&&$fecha!=""&&$fechaCorte!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND FECHA=? AND FECHA_ENTRADA=? AND METODO=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $fecha, $fechaCorte, $pago, $folio));
    }
    elseif($cliente!=""&&$fecha!=""&&$fechaCorte!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLIENTE=? AND FECHA=? AND FECHA_ENTRADA=? AND METODO=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, $fecha, $fechaCorte, $pago, $folio));
    }
    //Grupos 4
    elseif($factura!=""&&$cliente!=""&&$fecha!=""&&$fechaCorte!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND CLIENTE=? AND FECHA=? AND FECHA_ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, $fecha, $fechaCorte));
    }
    elseif($factura!=""&&$cliente!=""&&$fecha!=""&&$pago!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND CLIENTE=? AND FECHA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, $fecha, $pago));
    }
    elseif($factura!=""&&$cliente!=""&&$fecha!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND CLIENTE=? AND FECHA=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, $fecha, $folio));
    }
    elseif($factura!=""&&$cliente!=""&&$fechaCorte!=""&&$pago!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND CLIENTE=? AND FECHA_ENTRADA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, $fechaCorte, $pago));
    }
    elseif($factura!=""&&$cliente!=""&&$fechaCorte!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND CLIENTE=? AND FECHA_ENTRADA=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, $fechaCorte, $folio));
    }
    elseif($factura!=""&&$cliente!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND CLIENTE=? AND METODO=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, $pago, $folio));
    }
    elseif($factura!=""&&$fecha!=""&&$fechaCorte!=""&&$pago!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND FECHA=? AND FECHA_ENTRADA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $fecha, $fechaCorte, $pago));
    }
    elseif($factura!=""&&$fecha!=""&&$fechaCorte!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND FECHA=? AND FECHA_ENTRADA=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $fecha, $fechaCorte, $folio));
    }
    elseif($factura!=""&&$fecha!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND FECHA=? AND METODO=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $fecha, $pago, $folio));
    }
    elseif($factura!=""&&$fechaCorte!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND FECHA_ENTRADA=? AND METODO=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $fechaCorte, $pago, $folio));
    }
    elseif($cliente!=""&&$fecha!=""&&$fechaCorte!=""&&$pago!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLIENTE=? AND FECHA=? AND FECHA_ENTRADA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, $fecha, $fechaCorte, $pago));
    }
    elseif($cliente!=""&&$fecha!=""&&$fechaCorte!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLIENTE=? AND FECHA=? AND FECHA_ENTRADA=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, $fecha, $fechaCorte, $folio));
    }
    elseif($cliente!=""&&$fecha!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLIENTE=? AND FECHA=? AND METODO=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, $fecha, $pago, $folio));
    }
    elseif($cliente!=""&&$fechaCorte!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLIENTE=? AND FECHA_ENTRADA=? AND METODO=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, $fechaCorte, $pago, $folio));
    }
    elseif($fecha!=""&&$fechaCorte!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE FECHA=? AND FECHA_ENTRADA=? AND METODO=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($fecha, $fechaCorte, $pago, $folio));
    }
    //Grupos de 3
    elseif($factura!=""&&$cliente!=""&&$fecha!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND CLIENTE=? AND FECHA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, $fecha));
    }
    elseif($factura!=""&&$cliente!=""&&$fechaCorte!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND CLIENTE=? AND FECHA_ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, $fechaCorte));
    }
    elseif($factura!=""&&$cliente!=""&&$pago!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND CLIENTE=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, $pago));
    }
    elseif($factura!=""&&$cliente!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND CLIENTE=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, $folio));
    }
    elseif($factura!=""&&$fecha!=""&&$fechaCorte!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND FECHA=? AND FECHA_ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $fecha, $fechaCorte));
    }
    elseif($factura!=""&&$fecha!=""&&$pago!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND FECHA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $fecha, $pago));
    }
    elseif($factura!=""&&$fecha!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND FECHA=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $fecha, $folio));
    }
    elseif($factura!=""&&$fechaCorte!=""&&$pago!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND FECHA_ENTRADA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $fechaCorte, $pago));
    }
    elseif($factura!=""&&$fechaCorte!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND FECHA_ENTRADA=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $fechaCorte, $folio));
    }
    elseif($factura!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND METODO=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $pago, $folio));
    }
    elseif($cliente!=""&&$fecha!=""&&$fechaCorte!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLIENTE=? AND FECHA=? AND FECHA_ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, $fecha, $fechaCorte));
    }
    elseif($cliente!=""&&$fecha!=""&&$pago!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLIENTE=? AND FECHA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, $fecha, $pago));
    }
    elseif($cliente!=""&&$fecha!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLIENTE=? AND FECHA=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, $fecha, $folio));
    }
    elseif($cliente!=""&&$fechaCorte!=""&&$pago!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLIENTE=? AND FECHA_ENTRADA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, $fechaCorte, $pago));
    }
    elseif($cliente!=""&&$fechaCorte!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLIENTE=? AND FECHA_ENTRADA=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, $fechaCorte, $folio));
    }
    elseif($cliente!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLIENTE=? AND METODO=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, $pago, $folio));
    }
    elseif($fecha!=""&&$fechaCorte!=""&&$pago!=""){
      $consulta = "SELECT * FROM CARGAS WHERE FECHA=? AND FECHA_ENTRADA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($fecha, $fechaCorte, $pago));
    }
    elseif($fecha!=""&&$fechaCorte!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE FECHA=? AND FECHA_ENTRADA=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($fecha, $fechaCorte, $folio));
    }
    elseif($fecha!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE FECHA=? AND METODO=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($fecha, $pago, $folio));
    }
    elseif($fechaCorte!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE FECHA_ENTRADA=? AND METODO=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($fechaCorte, $pago, $folio));
    }
    //Grupos 2
    elseif($factura!=""&&$cliente!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND CLIENTE=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente));
    }
    elseif($factura!=""&&$fecha!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND FECHA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $fecha));
    }
    elseif($factura!=""&&$fechaCorte!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND FECHA_ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $fechaCorte));
    }
    elseif($factura!=""&&$pago!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $pago));
    }
    elseif($factura!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $folio));
    }
    elseif($cliente!=""&&$fecha!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLIENTE=? AND FECHA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, $fecha));
    }
    elseif($cliente!=""&&$fechaCorte!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLIENTE=? AND FECHA_ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, $fechaCorte));
    }
    elseif($cliente!=""&&$pago!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLIENTE=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, $pago));
    }
    elseif($cliente!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLIENTE=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, $folio));
    }
    elseif($fecha!=""&&$fechaCorte!=""){
      $consulta = "SELECT * FROM CARGAS WHERE FECHA=? AND FECHA_ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($fecha, $fechaCorte));
    }
    elseif($fecha!=""&&$pago!=""){
      $consulta = "SELECT * FROM CARGAS WHERE FECHA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($fecha, $pago));
    }
    elseif($fecha!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE FECHA=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($fecha, $folio));
    }
    elseif($fechaCorte!=""&&$pago!=""){
      $consulta = "SELECT * FROM CARGAS WHERE FECHA_ENTRADA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($fechaCorte, $pago));
    }
    elseif($fechaCorte!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE FECHA_ENTRADA=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($fechaCorte, $folio));
    }
    elseif($fechaCorte!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE FECHA_ENTRADA=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($fechaCorte, $folio));
    }
    elseif($pago!=""&&$folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE METODO=? AND ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($pago, $folio));
    }
    //Grupos de 1
    elseif ($factura!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLAVE=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura));
    }
    elseif ($cliente!=""){
      $consulta = "SELECT * FROM CARGAS WHERE CLIENTE=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente));
    }
    elseif ($fecha!=""){
      $consulta = "SELECT * FROM CARGAS WHERE FECHA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($fecha));
    }
    elseif ($fechaCorte!=""){
      $consulta = "SELECT * FROM CARGAS WHERE FECHA_ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($fechaCorte));
    }
    elseif ($pago!=""){
      $consulta = "SELECT * FROM CARGAS WHERE METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($pago));
    }
    elseif ($folio!=""){
      $consulta = "SELECT * FROM CARGAS WHERE ENTRADA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($folio));
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
    $metodos[$contador] = $registro[8];
    $entrada[$contador] = $registro[10];
    $fechasCorte[$contador] = $registro[11];

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
  $arreglo[11] = $metodos;
  $arreglo[12] = $fechasCorte;
  //$arreglo = [$contador, $facturas, $clientes, $nombre, $estatus, $fechas, $descuento, $importe, $vendedor];
  echo json_encode($arreglo);
?>
