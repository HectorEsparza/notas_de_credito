<?php
    require_once("../../funciones.php");
    $cliente = $_POST["cliente"];
    $nombre = "";
    $contador = 0;
    $clave = array();
    $fecha = array();
    $importe = array();
    $saldo = array();
    $datos = array();

    $base = conexion_local();
    $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, FECHA, IMPORTE FROM CARGAS WHERE CLIENTE=?  AND CLAVE LIKE ? AND ESTATUS=? ORDER BY FECHA DESC";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($cliente, 'RR%', 'Emitida'));
    
    while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)){
        $nombre = $registro["NOMBRE"];
        $clave[$contador] = $registro["CLAVE"];
        $fecha[$contador] = fechaStandar($registro["FECHA"]);
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
    $datos["fecha"] = $fecha;
    $datos["importe"] = $importe;
    $datos["saldo"] = $saldo;

    echo json_encode($datos);
?>