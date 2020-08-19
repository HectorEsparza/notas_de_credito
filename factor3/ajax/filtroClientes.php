<?php

    require_once("../../funciones.php");
    $idCliente = $_POST['idCliente'];
    $nombre = $_POST['nombre'];
    $datos = array();
    $datos["idCliente"] = "";
    $datos["nombreCliente"] = "";

    $base = conexion_local();

    if($idCliente!="" && $nombre!=""){
        $consulta = "SELECT idCliente, Nombre FROM CLIENTE WHERE idCliente=? AND Nombre=? AND Remision=?";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($idCliente, $nombre, 'Activo'));
    }
    elseif($idCliente!=""){
        $consulta = "SELECT idCliente, Nombre FROM CLIENTE WHERE idCliente=? AND Remision=?";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($idCliente, 'Activo'));
    }
    elseif($nombre!=""){
        $consulta = "SELECT idCliente, Nombre FROM CLIENTE WHERE Nombre=? AND Remision=?";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($nombre, 'Activo'));
    }
    
    
    while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)){
        $datos["idCliente"] = $registro["idCliente"];
        $datos["nombreCliente"] = $registro["Nombre"];
    }

    $resultado->closeCursor();
    $base = null;

    echo json_encode($datos);
?>