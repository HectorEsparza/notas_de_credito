<?php

    require_once("../../funciones.php");
    $puesto = $_GET['puesto'];

    $base = conexion_local();
    $consulta = "SELECT SALARIO_D FROM PUESTOS WHERE PUESTO=?";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($puesto));
    $registro = $resultado->fetch(PDO::FETCH_NUM);

    echo $registro[0];


?>
