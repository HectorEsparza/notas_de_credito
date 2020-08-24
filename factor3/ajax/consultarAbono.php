<?php
    require_once("../../funciones.php");
    $remision = $_POST["remision"];
    $datos = array();
    $abono = array();
    $fecha = array();
    $usuario = array();
    $observaciones = array();
    $contador = 0;

    $base = conexion_local();

    //obtener el historial de pagos
    $consultaHistorial = "SELECT Abono, SALDO.Fecha, USUARIO.Nombre, USUARIO.Apellido, Observacion FROM SALDO INNER JOIN CARGAS 
                            ON SALDO.idFacturaRemision=CARGAS.idFacturaRemision INNER JOIN USUARIO 
                            ON SALDO.idUsuario=USUARIO.idUsuario WHERE CARGAS.CLAVE=? ORDER BY SALDO.Fecha DESC";

    $resultadoHistorial = $base->prepare($consultaHistorial);
    $resultadoHistorial->execute(array($remision));
    while ($registroHistorial = $resultadoHistorial->fetch(PDO::FETCH_ASSOC)){
        $abono[$contador] = $registroHistorial["Abono"];
        $fecha[$contador] = fechaStandar($registroHistorial["Fecha"]);
        $usuario[$contador] = $registroHistorial["Nombre"] . " " . $registroHistorial["Apellido"];
        $observaciones[$contador] = $registroHistorial["Observacion"];
        $contador++;
    }
    $resultadoHistorial->closeCursor();
    $base = null;

    $datos["abono"] = $abono;
    $datos["fecha"] = $fecha;
    $datos["usuario"] = $usuario;
    $datos["observaciones"] = $observaciones;

    echo json_encode($datos);

?>