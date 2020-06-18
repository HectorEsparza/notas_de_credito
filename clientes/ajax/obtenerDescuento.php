<?php
 
    require_once("../../funciones.php");
    $datos = array();
    $contador = 0;
    $base = conexion_local();
    $consulta = "SELECT Porcentaje FROM DESCUENTO";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array());

    while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)){
        $datos["Descuento"][$contador] = $registro["Porcentaje"];
        $contador++;
    }

    $resultado->closeCursor();
    $base = null;

    echo json_encode($datos);
?>