<?php
    require_once("../../funciones.php");
    $color = $_GET['q'];
    $datos = array();
    $contador = 0;
    $base = conexion_local();
    $consulta = "SELECT NOMBRE FROM CLIENTE WHERE NOMBRE LIKE ? AND Remision=?";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array('%' . $color . '%', 'Activo'));

    while ($registro = $resultado->fetch(PDO::FETCH_NUM)) {
        array_push($datos, $registro[0]);
        $contador++;
        if($contador>10){
            break;
        }
    }

    echo json_encode($datos);
?>