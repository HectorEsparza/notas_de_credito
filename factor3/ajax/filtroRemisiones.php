<?php
    require_once("../../funciones.php");

    $folio = $_POST["folio"];
    $fecha = $_POST["fecha"];
    $cliente = $_POST["cliente"];
    $datos = array();
    $contador = 0;
    $nombre = "";
    $clave = array();
    $fechas = array();
    $importe = array();
    $saldo = array();

    // $folio = "";
    // $fecha = "05/02/2020";
    // $cliente = 73;

    $base = conexion_local();

    if($folio!="" && $fecha!=""){
        $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, FECHA, IMPORTE FROM CARGAS WHERE CLIENTE=? AND CLAVE=? AND ESTATUS=? AND FECHA=? ORDER BY FECHA DESC";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($cliente, $folio, 'Emitida', fechaConsulta($fecha)));
    }
    elseif($folio!=""){
        $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, FECHA, IMPORTE FROM CARGAS WHERE CLIENTE=? AND CLAVE=? AND ESTATUS=? ORDER BY FECHA DESC";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($cliente, $folio, 'Emitida'));
    }
    elseif($fecha!=""){
        //echo "Con fecha " . $cliente . " " . fechaConsulta($fecha) . "<br />";
        $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, FECHA, IMPORTE FROM CARGAS WHERE CLIENTE=?  AND CLAVE LIKE ? AND ESTATUS=? AND FECHA=? ORDER BY FECHA DESC";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($cliente, 'RR%', 'Emitida', fechaConsulta($fecha)));
    }
    //echo $resultado->rowCount();
    while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)){
        $nombre = $registro["NOMBRE"];
        $clave[$contador] = $registro["CLAVE"];
        $fechas[$contador] = fechaStandar($registro["FECHA"]);
        $importe[$contador] = $registro["IMPORTE"];
        //Obteniendo el saldo para cada remisión
        $consultaSaldo = "SELECT SUM(Abono) AS total FROM SALDO INNER JOIN CARGAS 
                          ON SALDO.idFacturaRemision=CARGAS.idFacturaRemision WHERE CARGAS.CLAVE=?";
        $resultadoSaldo = $base->prepare($consultaSaldo);
        $resultadoSaldo->execute(array($registro["CLAVE"]));
        $registroSaldo = $resultadoSaldo->fetch(PDO::FETCH_ASSOC);
        if($registroSaldo["total"]==null){
            $saldo[$contador] = $registro["IMPORTE"];
        }
        else{
            $saldo[$contador] = round(($registro["IMPORTE"]-$registroSaldo["total"])*100)/100;
        }
        $contador++;
        $resultadoSaldo->closeCursor();
    }
    $resultado->closeCursor();
    $base = null;

    $datos["cliente"] = $cliente;
    $datos["nombre"] = $nombre;
    $datos["clave"] = $clave;
    $datos["fecha"] = $fechas;
    $datos["importe"] = $importe;
    $datos["saldo"] = $saldo;

    echo json_encode($datos);
?>