<?php

    require_once("../../funciones.php");
    $datos = array();
    $contador = 0;
    $base = conexion_local();
    $consulta = "SELECT Estatus FROM CLIENTE GROUP BY Estatus";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array());

    while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)){
        $datos["Estatus"][$contador] = $registro["Estatus"];
        $contador++;
    }

    $resultado->closeCursor();
    $base = null;

    echo json_encode($datos);
?>