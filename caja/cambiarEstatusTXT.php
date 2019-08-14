<?php
  require_once("../funciones.php");
  $archivo = $_FILES['archivo']['name'];
  $ruta = $_FILES['archivo']['tmp_name'];
  $destino = "cargas\\" . $archivo;
  move_uploaded_file($ruta, $destino);
  $archivo = "cargas/".$archivo;
  $factura = array();
  $cliente = array();
  $nombre = array();
  $estatus = array();
  $fecha = array();
  $descuento = array();
  $importe = array();
  $vendedor = array();
  $contador = 0;
  $nombreArchivo = fopen($archivo, "r") or die("Problemas al abrir el archivo");

  while (!feof($nombreArchivo)){
    $linea = fgets($nombreArchivo);
    $linea = utf8_decode($linea);
    $linea = str_replace("?", "Ñ", $linea);
    $linea = str_replace("\"", "", $linea);
    //Medimos el tamaño de cada linea porque en la última linea nos dara 0 y dará un error al tratar de separar la cadena
    if(strlen($linea)>0){
      $linea = explode(",", $linea);
      $factura[$contador] = $linea[0];
      $cliente[$contador] = $linea[1];
      $nombre[$contador] = $linea[2];
      $estatus[$contador] = $linea[3];
      $fecha[$contador] = $linea[4];
      $importe[$contador] = $linea[5];
      $vendedor[$contador] = $linea[6];
      $descuento[$contador] = $linea[7];
      $contador++;
    }

  }
  fclose($nombreArchivo);

  // for ($i=0; $i < $contador; $i++) {
  //   echo $factura[$i] . " " . $estatus[$i] . "<br />";
  // }
  $base = conexion_local();
  if($factura[0]=="Clave"&&$cliente[0]=="Cliente"&&$nombre[0]=="Nombre"&&$estatus[0]=="Estatus"&&$fecha[0]=="Fecha de elaboracion"&&
     $importe[0]=="Importe total"&&$vendedor[0]=="Nombre del vendedor"&&strlen($descuento[0])==25){

       for ($i=1; $i < $contador ; $i++) {
         //echo $factura[$i] . " " . $estatus[$i] . "<br />";
         $consulta = "UPDATE CARGAS SET ESTATUS=? WHERE CLAVE=?";
         $resultado = $base->prepare($consulta);
         $resultado->execute(array($estatus[$i], $factura[$i]));
       }
       $resultado->closeCursor();
       $base = null;
       header("location:facturasSinEntrada.php");

  }
  else{
    echo "El archivo no cumple con la estructura, por favor revisalo";
  }

?>
