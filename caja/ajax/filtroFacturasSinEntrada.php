<?php
  require_once("../../funciones.php");
  $factura = $_POST['factura'];
  $cliente = $_POST['cliente'];
  $fecha = $_POST['fecha'];
  $fechaFin = $_POST['fechaFin'];
  $arreglo = array();
  $contador = 0;
  $base = conexion_local();


    if(($factura!=""&&($cliente==""||$fecha==""||$fechaFin=="")) || ($factura!=""&&($cliente!=""||$fecha!=""||$fechaFin!=""))){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.IDCONTADO=CONTADO.IDCONTADO WHERE CLAVE=? AND ENTRADA=? AND ESTATUS!=?";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($factura,"", "Cancelada"));
    }
    elseif($cliente!=""&&$fecha!=""&&$fechaFin!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.IDCONTADO=CONTADO.IDCONTADO WHERE CLIENTE=? FECHA BETWEEN ? AND ? AND ENTRADA=? AND ESTATUS!=? ORDER BY CLAVE ASC ";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, fechaConsulta($fecha),fechaConsulta($fechaFin), "", "Cancelada"));
    }
    elseif($cliente!=""&&$fecha!=""){
      $consulta = "SELECT FECHA FROM CARGAS ORDER BY CARGAS.FECHA DESC LIMIT 1";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array());
      $registro = $resultado->fetch(PDO::FETCH_ASSOC);
      $fechaFin = $registro["FECHA"];
      $resultado->closeCursor();
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.IDCONTADO=CONTADO.IDCONTADO WHERE CLIENTE=? FECHA BETWEEN ? AND ? AND ENTRADA=? AND ESTATUS!=? ORDER BY CLAVE ASC ";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, fechaConsulta($fecha),$fechaFin, "", "Cancelada"));
    }
    elseif($cliente!=""&&$fechaFin!=""){
      $consulta = "SELECT FECHA FROM CAJA ORDER BY FECHA ASC LIMIT 1";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array());
      $registro = $resultado->fetch(PDO::FETCH_ASSOC);
      $fecha = $registro["FECHA"];
      $resultado->closeCursor();
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.IDCONTADO=CONTADO.IDCONTADO WHERE CLIENTE=? FECHA BETWEEN ? AND ? AND ENTRADA=? AND ESTATUS!=? ORDER BY CLAVE ASC ";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, $fecha,fechaConsulta($fechaFin), "", "Cancelada"));
    }
    elseif($fecha!=""&&$fechaFin!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, FOLIO  FROM CARGAS LEFT JOIN CONTADO ON CARGAS.IDCONTADO=CONTADO.IDCONTADO  WHERE CARGAS.FECHA BETWEEN ? AND ? AND ENTRADA=? AND ESTATUS!=? ORDER BY CLAVE ASC";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array(fechaConsulta($fecha),fechaConsulta($fechaFin),"", "Cancelada"));
    }
    elseif($cliente!=""){
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.IDCONTADO=CONTADO.IDCONTADO WHERE CLIENTE=? AND ENTRADA=? AND ESTATUS!=?";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($cliente, "", "Cancelada"));
    }
    elseif($fecha!=""){
      $consulta = "SELECT FECHA FROM CARGAS ORDER BY CARGAS.FECHA DESC LIMIT 1";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array());
      $registro = $resultado->fetch(PDO::FETCH_ASSOC);
      $fechaFin = $registro["FECHA"];
      $resultado->closeCursor();
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.IDCONTADO=CONTADO.IDCONTADO WHERE CARGAS.FECHA BETWEEN ? AND ? AND ENTRADA=? AND ESTATUS!=? ORDER BY CLAVE ASC ";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array(fechaConsulta($fecha),$fechaFin, "", "Cancelada"));
    }
    elseif($fechaFin!=""){
      $consulta = "SELECT FECHA FROM CAJA ORDER BY FECHA ASC LIMIT 1";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array());
      $registro = $resultado->fetch(PDO::FETCH_ASSOC);
      $fecha = $registro["FECHA"];
      $resultado->closeCursor();
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, ESTATUS, CARGAS.FECHA, IMPORTE, VENDEDOR, DESCUENTO, FOLIO FROM CARGAS LEFT JOIN CONTADO ON CARGAS.IDCONTADO=CONTADO.IDCONTADO WHERE CARGAS.FECHA BETWEEN ? AND ? AND ENTRADA=? AND ESTATUS!=? ORDER BY CLAVE ASC ";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($fecha,fechaConsulta($fechaFin), "", "Cancelada"));
    }



  $arreglo[$contador]["clave"] = "";
  $arreglo[$contador]["cliente"] = "";
  $arreglo[$contador]["nombre"] = "";
  $arreglo[$contador]["estatus"] = "";
  $arreglo[$contador]["fecha"] = "";
  $arreglo[$contador]["importe"] = "";
  $arreglo[$contador]["vendedor"] = "";
  $arreglo[$contador]["descuento"] = "";
  $arreglo[$contador]["folioContado"] = "";

  while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $arreglo[$contador]["clave"] = $registro["CLAVE"];
    $arreglo[$contador]["cliente"] = $registro["CLIENTE"];
    $arreglo[$contador]["nombre"] = $registro["NOMBRE"];
    $arreglo[$contador]["estatus"] = $registro["ESTATUS"];
    $arreglo[$contador]["fecha"] = fechaStandar($registro["FECHA"]);
    $arreglo[$contador]["importe"] = $registro["IMPORTE"];
    $arreglo[$contador]["vendedor"] = $registro["VENDEDOR"];
    $arreglo[$contador]["descuento"] = $registro["DESCUENTO"];
    $arreglo[$contador]["folioContado"] = $registro["FOLIO"];
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
    if(($arreglo[$i]["estatus"]=="Emitida" || $arreglo[$i]["estatus"]=="Original")){
      $consulta = "INSERT INTO EXPORTAR_FACTURAS (CLAVE, CLIENTE, NOMBRE, ESTATUS, FECHA, DESCUENTO, IMPORTE, VENDEDOR, FOLIO_CONTADO) VALUES(?,?,?,?,?,?,?,?,?)";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($arreglo[$i]["clave"], $arreglo[$i]["cliente"], $arreglo[$i]["nombre"], $arreglo[$i]["estatus"],
                                $arreglo[$i]["fecha"],$arreglo[$i]["descuento"],$arreglo[$i]["importe"],$arreglo[$i]["vendedor"],
                                $arreglo[$i]["folioContado"]));
    }
  }
  $base = null;


  echo json_encode($arreglo);

?>
