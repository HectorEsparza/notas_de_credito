<?php
  //Opción 0 Enviar a inciar sesión
  //Opción 1 Dejar en inicio.html
  session_start();
  if(!isset($_SESSION['user'])){
    $usuario = "";
  }
  else{
    $usuario = $_SESSION["user"];
  }

  require_once("../funciones.php");
  $resultados = array();


  $base = conexion_local();
  $consulta = "SELECT * FROM USUARIO WHERE USUARIO=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($usuario));

  $resultados["opcion"] = $resultado->rowCount();

  $resultado->closeCursor();
  $base = null;
  echo json_encode($resultados);
?>
