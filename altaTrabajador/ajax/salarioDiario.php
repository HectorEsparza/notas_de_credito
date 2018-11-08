<?php

    require_once("../../funciones.php");
    $puesto = $_GET['puesto'];
    $departamento = $_GET['departamento'];

    $base = conexion_local();
    $consulta = "SELECT SALARIO_D FROM PUESTOS WHERE PUESTO=? AND DEPARTAMENTO=?";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($puesto, $departamento));
    $registro = $resultado->fetch(PDO::FETCH_NUM);

    echo $registro[0];


?>
