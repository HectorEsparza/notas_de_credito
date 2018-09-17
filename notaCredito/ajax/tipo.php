<?php

 $tipo = $_GET['tipo'];
 require('../../funciones.php');


try
 {
   if($tipo!=""){
      echo folio($tipo);
   }


 }
 catch (Exception $e)
 {
   die("<h1>ERROR: " . $e->GetMessage());
 }
 finally
 {
   $base = null;
 }

?>
