<?php
  session_start();
  require_once("../funciones.php");
  $datos = array();
  $modulos = array();
  $identificador = array();
  $contador = 0;
  $usuario = $_SESSION["user"];
  
  $base = conexion_local();
  $consultaObtenerModulos = "SELECT MODULO.Nombre, MODULO.Identificador FROM MODULO 
                            INNER JOIN USUARIO_MODULO ON MODULO.idModulo=USUARIO_MODULO.idModulo
                            INNER JOIN USUARIO ON USUARIO_MODULO.idUsuario=USUARIO.idUsuario
                            WHERE USUARIO.Usuario=?";
  $resultadoObtenerModulos = $base->prepare($consultaObtenerModulos);
  $resultadoObtenerModulos->execute(array($usuario));

  while ($registro = $resultadoObtenerModulos->fetch(PDO::FETCH_ASSOC)){
      $modulos[$contador] = $registro["Nombre"];
      $identificador[$contador] = $registro["Identificador"];
      $contador++;
  }

  $resultadoObtenerModulos->closeCursor();
  $base = null;

  $datos["modulos"] = $modulos;
  $datos["identificador"] = $identificador;
  
  echo json_encode($datos);

?>