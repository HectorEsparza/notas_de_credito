<?php
require_once("../funciones.php");
$color = $_GET['q'];
$datos = array();
$contador = 0;
$base = conexion_local();
$consulta = "SELECT * FROM CLIENTE WHERE NOMBRE LIKE ?";
//$consulta = "SELECT FECHA FROM NOTAS_VIS WHERE FECHA LIKE ?";
$resultado = $base->prepare($consulta);
$resultado->execute(array('%' . $color . '%'));

while ($registro = $resultado->fetch(PDO::FETCH_NUM)) {
      array_push($datos, $registro[1]);
      $contador++;
      if($contador>10){
        break;
      }
}

echo json_encode($datos);



?>
