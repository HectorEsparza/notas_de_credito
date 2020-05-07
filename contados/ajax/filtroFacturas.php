<?php

  require_once("../../funciones.php");
  $factura = $_POST['factura'];
  $cliente = $_POST['cliente'];
  $fecha = $_POST['fecha'];
  $fechaCorte = $_POST['fechaCorte'];
  $pago = "";
  $folio = $_POST['folio'];
  $tipo = $_POST['tipo'];
  // $factura = "";
  // $cliente = "";
  // $fecha = "06/08/2019";
  // $fechaCorte = "";
  // $pago = "";
  // $folio = "";
  // $tipo = "sinEntrada";
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

    if($factura!=""&&$cliente!=""&&$fecha!=""&&$fechaCorte!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM
                   CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CLIENTE=? AND CARGAS.FECHA=? AND
                   CONTADO.FECHA=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, fechaConsulta($fecha), fechaConsulta($fechaCorte), $pago, $folio));
    }
    //Grupos de 5
    elseif($factura!=""&&$cliente!=""&&$fecha!=""&&$fechaCorte!=""&&$pago!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CLIENTE=? AND CARGAS.FECHA=? AND CONTADO.FECHA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, fechaConsulta($fecha), fechaConsulta($fechaCorte), $pago));
    }
    elseif($factura!=""&&$cliente!=""&&$fecha!=""&&$fechaCorte!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CLIENTE=? AND CARGAS.FECHA=? AND CONTADO.FECHA=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, fechaConsulta($fecha), fechaConsulta($fechaCorte), $folio));
    }
    elseif($factura!=""&&$cliente!=""&&$fecha!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CLIENTE=? AND CARGAS.FECHA=? AND METODO=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, fechaConsulta($fecha), $pago, $folio));
    }
    elseif($factura!=""&&$cliente!=""&&$fechaCorte!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CLIENTE=? AND CONTADO.FECHA=? AND METODO=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, fechaConsulta($fechaCorte), $pago, $folio));
    }
    elseif($factura!=""&&$fecha!=""&&$fechaCorte!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CARGAS.FECHA=? AND CONTADO.FECHA=? AND METODO=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, fechaConsulta($fecha), fechaConsulta($fechaCorte), $pago, $folio));
    }
    elseif($cliente!=""&&$fecha!=""&&$fechaCorte!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLIENTE=? AND CARGAS.FECHA=? AND CONTADO.FECHA=? AND METODO=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, fechaConsulta($fecha), fechaConsulta($fechaCorte), $pago, $folio));
    }
    //Grupos 4
    elseif($factura!=""&&$cliente!=""&&$fecha!=""&&$fechaCorte!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CLIENTE=? AND CARGAS.FECHA=? AND CONTADO.FECHA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, fechaConsulta($fecha), fechaConsulta($fechaCorte)));
    }
    elseif($factura!=""&&$cliente!=""&&$fecha!=""&&$pago!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CLIENTE=? AND CARGAS.FECHA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, fechaConsulta($fecha), $pago));
    }
    elseif($factura!=""&&$cliente!=""&&$fecha!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CLIENTE=? AND CARGAS.FECHA=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, fechaConsulta($fecha), $folio));
    }
    elseif($factura!=""&&$cliente!=""&&$fechaCorte!=""&&$pago!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CLIENTE=? AND CONTADO.FECHA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, fechaConsulta($fechaCorte), $pago));
    }
    elseif($factura!=""&&$cliente!=""&&$fechaCorte!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CLIENTE=? AND CONTADO.FECHA=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, fechaConsulta($fechaCorte), $folio));
    }
    elseif($factura!=""&&$cliente!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CLIENTE=? AND METODO=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, $pago, $folio));
    }
    elseif($factura!=""&&$fecha!=""&&$fechaCorte!=""&&$pago!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CARGAS.FECHA=? AND CONTADO.FECHA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, fechaConsulta($fecha), fechaConsulta($fechaCorte), $pago));
    }
    elseif($factura!=""&&$fecha!=""&&$fechaCorte!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CARGAS.FECHA=? AND CONTADO.FECHA=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, fechaConsulta($fecha), fechaConsulta($fechaCorte), $folio));
    }
    elseif($factura!=""&&$fecha!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CARGAS.FECHA=? AND METODO=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, fechaConsulta($fecha), $pago, $folio));
    }
    elseif($factura!=""&&$fechaCorte!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CONTADO.FECHA=? AND METODO=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, fechaConsulta($fechaCorte), $pago, $folio));
    }
    elseif($cliente!=""&&$fecha!=""&&$fechaCorte!=""&&$pago!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLIENTE=? AND CARGAS.FECHA=? AND CONTADO.FECHA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, fechaConsulta($fecha), fechaConsulta($fechaCorte), $pago));
    }
    elseif($cliente!=""&&$fecha!=""&&$fechaCorte!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLIENTE=? AND CARGAS.FECHA=? AND CONTADO.FECHA=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, fechaConsulta($fecha), fechaConsulta($fechaCorte), $folio));
    }
    elseif($cliente!=""&&$fecha!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLIENTE=? AND CARGAS.FECHA=? AND METODO=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, fechaConsulta($fecha), $pago, $folio));
    }
    elseif($cliente!=""&&$fechaCorte!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLIENTE=? AND CONTADO.FECHA=? AND METODO=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, fechaConsulta($fechaCorte), $pago, $folio));
    }
    elseif($fecha!=""&&$fechaCorte!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CARGAS.FECHA=? AND CONTADO.FECHA=? AND METODO=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array(fechaConsulta($fecha), fechaConsulta($fechaCorte), $pago, $folio));
    }
    //Grupos de 3
    elseif($factura!=""&&$cliente!=""&&$fecha!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CLIENTE=? AND CARGAS.FECHA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, fechaConsulta($fecha)));
    }
    elseif($factura!=""&&$cliente!=""&&$fechaCorte!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CLIENTE=? AND CONTADO.FECHA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, fechaConsulta($fechaCorte)));
    }
    elseif($factura!=""&&$cliente!=""&&$pago!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CLIENTE=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, $pago));
    }
    elseif($factura!=""&&$cliente!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CLIENTE=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente, $folio));
    }
    elseif($factura!=""&&$fecha!=""&&$fechaCorte!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CARGAS.FECHA=? AND CONTADO.FECHA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, fechaConsulta($fecha), fechaConsulta($fechaCorte)));
    }
    elseif($factura!=""&&$fecha!=""&&$pago!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CARGAS.FECHA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, fechaConsulta($fecha), $pago));
    }
    elseif($factura!=""&&$fecha!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CARGAS.FECHA=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, fechaConsulta($fecha), $folio));
    }
    elseif($factura!=""&&$fechaCorte!=""&&$pago!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CONTADO.FECHA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, fechaConsulta($fechaCorte), $pago));
    }
    elseif($factura!=""&&$fechaCorte!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CONTADO.FECHA=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, fechaConsulta($fechaCorte), $folio));
    }
    elseif($factura!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND METODO=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $pago, $folio));
    }
    elseif($cliente!=""&&$fecha!=""&&$fechaCorte!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLIENTE=? AND CARGAS.FECHA=? AND CONTADO.FECHA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, fechaConsulta($fecha), fechaConsulta($fechaCorte)));
    }
    elseif($cliente!=""&&$fecha!=""&&$pago!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLIENTE=? AND CARGAS.FECHA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, fechaConsulta($fecha), $pago));
    }
    elseif($cliente!=""&&$fecha!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLIENTE=? AND CARGAS.FECHA=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, fechaConsulta($fecha), $folio));
    }
    elseif($cliente!=""&&$fechaCorte!=""&&$pago!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLIENTE=? AND CONTADO.FECHA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, fechaConsulta($fechaCorte), $pago));
    }
    elseif($cliente!=""&&$fechaCorte!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLIENTE=? AND CONTADO.FECHA=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, fechaConsulta($fechaCorte), $folio));
    }
    elseif($cliente!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLIENTE=? AND METODO=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, $pago, $folio));
    }
    elseif($fecha!=""&&$fechaCorte!=""&&$pago!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CARGAS.FECHA=? AND CONTADO.FECHA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array(fechaConsulta($fecha), fechaConsulta($fechaCorte), $pago));
    }
    elseif($fecha!=""&&$fechaCorte!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CARGAS.FECHA=? AND CONTADO.FECHA=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array(fechaConsulta($fecha), fechaConsulta($fechaCorte), $folio));
    }
    elseif($fecha!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CARGAS.FECHA=? AND METODO=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array(fechaConsulta($fecha), $pago, $folio));
    }
    elseif($fechaCorte!=""&&$pago!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CONTADO.FECHA=? AND METODO=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array(fechaConsulta($fechaCorte), $pago, $folio));
    }
    //Grupos 2
    elseif($factura!=""&&$cliente!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CLIENTE=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $cliente));
    }
    elseif($factura!=""&&$fecha!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CARGAS.FECHA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, fechaConsulta($fecha)));
    }
    elseif($factura!=""&&$fechaCorte!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND CONTADO.FECHA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, fechaConsulta($fechaCorte)));
    }
    elseif($factura!=""&&$pago!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $pago));
    }
    elseif($factura!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura, $folio));
    }
    elseif($cliente!=""&&$fecha!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLIENTE=? AND CARGAS.FECHA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, fechaConsulta($fecha)));
    }
    elseif($cliente!=""&&$fechaCorte!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLIENTE=? AND CONTADO.FECHA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, fechaConsulta($fechaCorte)));
    }
    elseif($cliente!=""&&$pago!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLIENTE=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, $pago));
    }
    elseif($cliente!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLIENTE=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, $folio));
    }
    elseif($fecha!=""&&$fechaCorte!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CARGAS.FECHA=? AND CONTADO.FECHA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array(fechaConsulta($fecha), fechaConsulta($fechaCorte)));
    }
    elseif($fecha!=""&&$pago!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CARGAS.FECHA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array(fechaConsulta($fecha), $pago));
    }
    elseif($fecha!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CARGAS.FECHA=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array(fechaConsulta($fecha), $folio));
    }
    elseif($fechaCorte!=""&&$pago!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CONTADO.FECHA=? AND METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array(fechaConsulta($fechaCorte), $pago));
    }
    elseif($fechaCorte!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CONTADO.FECHA=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array(fechaConsulta($fechaCorte), $folio));
    }
    elseif($fechaCorte!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CONTADO.FECHA=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array(fechaConsulta($fechaCorte), $folio));
    }
    elseif($pago!=""&&$folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE METODO=? AND CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($pago, $folio));
    }
    //Grupos de 1
    elseif ($factura!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLAVE=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura));
    }
    elseif ($cliente!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CLIENTE=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente));
    }
    elseif ($fecha!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CARGAS.FECHA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array(fechaConsulta($fecha)));
    }
    elseif ($fechaCorte!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CONTADO.FECHA=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array(fechaConsulta($fechaCorte)));
    }
    elseif ($pago!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE METODO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($pago));
    }
    elseif ($folio!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, CONTADO.FECHA, CONTADO.FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CONTADO.FOLIO=? ORDER BY CLAVE";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($folio));
    }

  while ($registro = $resultado->fetch(PDO::FETCH_NUM)){
    $facturas[$contador] = $registro[0];
    $clientes[$contador] = $registro[1];
    $nombre[$contador] = $registro[2];
    $estatus[$contador] = $registro[3];
    $fechas[$contador] = fechaStandar($registro[4]);
    $importe[$contador] = $registro[5];
    $vendedor[$contador] = $registro[6];
    $descuento[$contador] = $registro[7];
    if($registro[8]!=""){
      $fechasCorte[$contador] = fechaStandar($registro[8]);
    }
    else{
      $fechasCorte[$contador] = $registro[8];
    }
    $entrada[$contador] = $registro[9];
    $contador++;
  }
  $resultado->closeCursor();
  //Vaciamos la tabla de exportacion excel
  $consulta = "DELETE FROM EXPORTAR_FACTURAS";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array());
  $resultado->closeCursor();
  //Llenamos la tabla de exportacion excel
  for ($i=0; $i < $contador ; $i++) {
    if(($estatus[$i]=="Emitida" || $estatus[$i]=="Original")&& $entrada[$i]==""){
      $consulta = "INSERT INTO EXPORTAR_FACTURAS (CLAVE, CLIENTE, NOMBRE, ESTATUS, FECHA, DESCUENTO, IMPORTE, VENDEDOR) VALUES(?,?,?,?,?,?,?,?)";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($facturas[$i], $clientes[$i], $nombre[$i], $estatus[$i], $fechas[$i], $descuento[$i], $importe[$i], $vendedor[$i]));
    }
  }
  $resultado->closeCursor();
  $arreglo["contador"] = $contador;
  $arreglo["factura"] = $facturas;
  $arreglo["cliente"] = $clientes;
  $arreglo["nombre"] = $nombre;
  $arreglo["estatus"] = $estatus;
  $arreglo["fecha"] = $fechas;
  $arreglo["importe"] = $importe;
  $arreglo["vendedor"] = $vendedor;
  $arreglo["descuento"] = $descuento;
  $arreglo["entrada"] = $entrada;
  $arreglo["tipo"] = $tipo;
  $arreglo["fechaCorte"] = $fechasCorte;
  //$arreglo = [$contador, $facturas, $clientes, $nombre, $estatus, $fechas, $descuento, $importe, $vendedor];
  echo json_encode($arreglo);
?>
