<?php
    require_once("../../funciones.php");
    session_start();
    $usuario = $_SESSION["user"];  
    $abono = $_POST["abono"];
    $cliente = $_POST["cliente"];
    $remision = $_POST["remision"];
    $observaciones = $_POST["observaciones"];
    $datos = array();
    $datos["estatus"] = 0;
    $datos["abono"] = $abono;
    $datos["cliente"] = $cliente;
    $datos["remision"] = $remision;

    $base = conexion_local();
    //Obtener la fecha de hoy
    $fecha = fecha();
    //Obtener el id de la remision
    $consultaId = "SELECT idFacturaRemision FROM CARGAS WHERE CLAVE=?";
    $resultadoId = $base->prepare($consultaId);
    $resultadoId->execute(array($remision));
    $registroId = $resultadoId->fetch(PDO::FETCH_ASSOC);
    $idFacturaRemision = $registroId["idFacturaRemision"];
    $resultadoId->closeCursor();
    //Obtener el id del usuario
    $consultaIdUsuario = "SELECT idUsuario FROM USUARIO WHERE Usuario=?";
    $resultadoIdUsuario = $base->prepare($consultaIdUsuario);
    $resultadoIdUsuario->execute(array($usuario));
    $registroIdUsuario = $resultadoIdUsuario->fetch(PDO::FETCH_ASSOC);
    $usuario = $registroIdUsuario["idUsuario"];
    $resultadoIdUsuario->closeCursor();
    //Insertar el abono para general el historial
    $consultaInsertarAbono = "INSERT INTO SALDO VALUES(?,?,?,?,?,?)";
    $resultadoInsertarAbono = $base->prepare($consultaInsertarAbono);
    $resultadoInsertarAbono->execute(array(NULL, $idFacturaRemision, $abono, $fecha, $observaciones, $usuario));
    if($resultadoInsertarAbono->rowCount()==1){
        $datos["estatus"] = 1;
    }
    $resultadoInsertarAbono->closeCursor();

    $base = null;

    echo json_encode($datos);
?>