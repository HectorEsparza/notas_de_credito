<?php
  session_start();
  $usuario = $_SESSION["user"];
  require_once("../../funciones.php");
  $indice = $_POST['indice'];
  $factura = $_POST['factura'];
  $total = $_POST['total'];
  $total = explode("$", $total);
  $total = $total[1];
  $arreglo = [];
  $base = conexion_local();
  //Obtenemos el departamento y permiso del usuario
  $consulta = "SELECT DEPARTAMENTO,PERMISO FROM USUARIOS WHERE USUARIO=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($usuario));
  $registro = $resultado->fetch(PDO::FETCH_ASSOC);
  $departamento = $registro["DEPARTAMENTO"];
  $permiso = $registro["PERMISO"];
  $resultado->closeCursor();
  //Obtenemos la información de la factura o remisión
  $consulta = "SELECT CLIENTE, NOMBRE, DESCUENTO, IMPORTE, Contado.Folio FROM
               CARGAS INNER JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado
               WHERE CLAVE=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($factura));
  $registro = $resultado->fetch(PDO::FETCH_ASSOC);
  $arreglo["cliente"] = $registro["CLIENTE"];
  $arreglo["nombre"] = $registro["NOMBRE"];
  //$arreglo[2] = round((sub($registro[2], $registro[3]))*100)/100;
  $arreglo["importe"] = $registro["IMPORTE"];
  $arreglo["indice"] = $indice;
  $arreglo["total"] = $total+$arreglo["importe"];
  $arreglo["folio"] = $registro["Folio"];
  $arreglo["factura"] = $factura;
  $arreglo["departamento"] = $departamento;
  $resultado->closeCursor();
  $base = null;
  echo json_encode($arreglo);
  // echo $total;
?>
