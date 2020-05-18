<?php
  //Opción 0 Enviar a inciar sesión
  session_start();
  
  $_SESSION = array();
  
  // Finalmente, destruir la sesión.
  session_destroy();
  
  $resultados = array();

  $resultados["opcion"] = 0;

  echo json_encode($resultados);
?>
