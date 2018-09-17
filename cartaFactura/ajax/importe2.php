<?php
require_once("../../funciones.php");
 $cantidad = $_GET['cantidad'];
 $clave = $_GET['clave'];

 //$nombre = $_GET['lista'];
 $lista = "PRODUCTOS1";



 try
 {
   $base = conexion_local();
   $consulta = "SELECT PRECIO FROM " . $lista . " WHERE CLAVEDEARTÍCULO=?";
   $resultado = $base->prepare($consulta);
   $resultado->execute(array($clave));
   $registro = $resultado->fetch(PDO::FETCH_NUM);

   if($registro[0]!=""&&$cantidad>0){
     echo "$" . number_format(($registro[0]*$cantidad), 2, ".", ",");
   }
   else if($registro[0]!=""&&$cantidad==""){
     echo "$" . number_format($registro[0], 2, ".", ",");
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
