<?php
  require_once("../../funciones.php");
  $factura = $_POST['factura'];
  $cliente = $_POST['cliente'];
  $nombre = $_POST['nombre'];
  $estatus = $_POST['estatus'];
  $fecha = $_POST['fecha'];
  $descuento = $_POST['descuento'];
  $importe = $_POST['importe'];
  $vendedor = $_POST['vendedor'];
  $contador = $_POST['contador'];
  $arreglo = array();
  $arreglo[0] = "Carga Exitosa";
  $base = conexion_local();
  for ($i=1; $i < $contador ; $i++){
    $consulta = "INSERT INTO CARGAS(CLAVE, CLIENTE, NOMBRE, ESTATUS, FECHA, DESCUENTO, IMPORTE, VENDEDOR)
                        VALUES(?,?,?,?,?,?,?,?)";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($factura[$i], $cliente[$i], $nombre[$i], $estatus[$i], fechaConsulta($fecha[$i]), $descuento[$i], $importe[$i], $vendedor[$i]));
  }
  $resultado->closeCursor();
  echo json_encode($arreglo);
?>
