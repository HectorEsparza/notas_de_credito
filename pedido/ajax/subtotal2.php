<?php

require_once("../../funciones.php");
 $cantidad = $_GET['cantidad'];
 $clave = $_GET['clave'];
 $descuento = $_GET['descuento'];


 //$nombre = $_GET['lista'];
 $lista = "PRODUCTOS1";



 try
 {
   $base = conexion_local();
   $consulta = "SELECT PRECIO FROM " . $lista . " WHERE CLAVEDEARTÍCULO=?";
   $resultado = $base->prepare($consulta);
   $resultado->execute(array($clave));
   $registro = $resultado->fetch(PDO::FETCH_NUM);
   $precio = $registro[0];
   $resultado->closeCursor();
   $descuento = explode('%', $descuento);

   if($precio!=""&&$cantidad>0){
     echo "$" . number_format((sub($descuento[0], $precio))*$cantidad, 2, ".", ",");
   }
   else if($precio!=""&&$cantidad==""){
     echo "$" . number_format(sub($descuento[0], $precio), 2, ".", ",");
   }


 }
 catch (Exception $e)
 {
   die("<h1>ERROR: " . $e->GetMessage() . "</h1>");
 }
 finally
 {
   $base = null;
 }

?>
