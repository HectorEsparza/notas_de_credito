<?php

    require_once("../../funciones.php");
    session_start();
    $usuario = $_SESSION["user"];  
    $nuevoAbono = $_POST["nuevoAbono"];
    $anteriorAbono = $_POST["anteriorAbono"];
    $fechaAbono = $_POST["fechaAbono"];
    $remision = $_POST["remision"];
    $importeRemision = $_POST["importeRemision"];
    $datos = array();

    $base = conexion_local();

    //Obtener la fecha de hoy
    $fecha = fecha();
    //Verificar si el usuario que desea editar el abono es el mismo que la capturo
    $consultaUsuario = "SELECT SALDO.idFacturaRemision, SALDO.idUsuario FROM SALDO INNER JOIN 
                        CARGAS ON SALDO.idFacturaRemision=CARGAS.idFacturaRemision INNER JOIN
                        USUARIO ON SALDO.idUsuario=USUARIO.idUsuario WHERE CARGAS.CLAVE=? AND SALDO.Abono=?
                        AND SALDO.Fecha=? AND Usuario.Usuario=?";
    $resultadoUsuario = $base->prepare($consultaUsuario);
    $resultadoUsuario->execute(array($remision, $anteriorAbono, fechaConsulta($fechaAbono), $usuario));
    $datos["usuarioCapturador"] = $resultadoUsuario->rowCount();
    $datos["fecha"] = fechaConsulta($fechaAbono);
    //Si esl resultado de la consulta es 1 se puede continuar con la edición del abono
    if($resultadoUsuario->rowCount()==1){
        $datos["usuarioCapturador"] = 1;
        //Si el nuevo abono es menor al anterior abono aplicar la actualización
        if($nuevoAbono<$anteriorAbono){
            $registroUsuario = $resultadoUsuario->fetch(PDO::FETCH_ASSOC);
            $consultaActualizaAbono = "UPDATE SALDO SET Abono=?, Fecha=? WHERE 
                                        idFacturaRemision=? AND Abono=? AND Fecha=? AND idUsuario=?";
            $resultadoActualizaAbono = $base->prepare($consultaActualizaAbono);
            $resultadoActualizaAbono->execute(array($nuevoAbono, $fecha, $registroUsuario["idFacturaRemision"], 
                                                    $anteriorAbono, fechaConsulta($fechaAbono), $registroUsuario["idUsuario"]));
            $datos["abonoActualizado"] = $resultadoActualizaAbono->rowCount();
            $resultadoActualizaAbono->closeCursor();
        }
        //Si el nuevo abono es mayor al anterior abono comprobar que con el nuevo importe no deje negativo el saldo
        else{
            //Obtener el saldo de la remisión
            $consultaSaldo = "SELECT SUM(Abono) AS total FROM SALDO INNER JOIN CARGAS 
                                ON SALDO.idFacturaRemision=CARGAS.idFacturaRemision WHERE CARGAS.CLAVE=?";
            $resultadoSaldo = $base->prepare($consultaSaldo);
            $resultadoSaldo->execute(array($remision));
            $registroSaldo = $resultadoSaldo->fetch(PDO::FETCH_ASSOC);
            $saldoRemision = $registroSaldo["total"];
            $resultadoSaldo->closeCursor();
            //Si al sumar el saldo de la remisión con la diferencia del nuevo abono y el anterior abono nos da un 
            //valor menor al importe de la remisión, podemos editar el abono
            if($importeRemision>=($saldoRemision+($nuevoAbono-$anteriorAbono))){
                $registroUsuario = $resultadoUsuario->fetch(PDO::FETCH_ASSOC);
                $consultaActualizaAbono = "UPDATE SALDO SET Abono=?, Fecha=? WHERE 
                                            idFacturaRemision=? AND Abono=? AND Fecha=? AND idUsuario=?";
                $resultadoActualizaAbono = $base->prepare($consultaActualizaAbono);
                $resultadoActualizaAbono->execute(array($nuevoAbono, $fecha, $registroUsuario["idFacturaRemision"], 
                                                        $anteriorAbono, fechaConsulta($fechaAbono), $registroUsuario["idUsuario"]));
                $datos["abonoActualizado"] = $resultadoActualizaAbono->rowCount();
                $resultadoActualizaAbono->closeCursor();
            }
            else{
                $datos["abonoActualizado"] = 0;
            }
        }
    }
    //Si el resultado de la consulta es 0 no se puede continuar con la edición del abono
    else{
        $datos["usuarioCapturador"] = 0;
    }
    $resultadoUsuario->closeCursor();
    $base = null;
    echo json_encode($datos);
?>