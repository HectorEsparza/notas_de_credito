<?php
 require_once("../../funciones.php");
 
 $datos = array();
 $folioInterno = array();
 $numeroCliente = array();
 $nombreCliente = array();
 $total = array();
 $fecha = array();
 $estatus = array();
 $contador = 0;

 $base = conexion_local();
 $consulta = "SELECT FOLIOINTERNO, NOCLIENTE, CLIENTE, TOTAL, FECHA, STATUS FROM NOTAS_VIS WHERE NOTASAE=? ORDER BY FECHA DESC";
 $resultado = $base->prepare($consulta);
 $resultado->execute(array(''));

 while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)){
    $folioInterno[$contador]= $registro["FOLIOINTERNO"];
    $numeroCliente[$contador] = $registro["NOCLIENTE"];
    $nombreCliente[$contador] = $registro["CLIENTE"];
    $total[$contador] = $registro["TOTAL"];
    $fecha[$contador] = fechaStandar($registro["FECHA"]);
    $estatus[$contador] = $registro["STATUS"];
    $contador++;
 }

 $datos["folioInterno"] = $folioInterno;
 $datos["numeroCliente"] = $numeroCliente;
 $datos["nombreCliente"] = $nombreCliente;
 $datos["total"] = $total;
 $datos["fecha"] = $fecha;
 $datos["estatus"] = $estatus;

 echo json_encode($datos);
 //print_r($datos);

