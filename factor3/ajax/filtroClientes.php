<?php

    require_once("../../funciones.php");
    $idCliente = $_POST['idCliente'];
    $nombre = $_POST['nombre'];
    $estatus = $_POST['estatus'];
    $descuento = $_POST['descuento'];
    $vendedor = $_POST['vendedor'];
    $datos = array();
    $numeroCliente = array();
    $nombreCliente = array();
    $estatusCliente = array();
    $descuentoCliente = array();
    $vendedorCliente = array();
    $rfcCliente = array();
    $contador = 0;
    $base = conexion_local();

    if($idCliente!=""){
        $consulta = "SELECT CLIENTE.IDCLIENTE AS idCliente, CLIENTE.NOMBRE AS Cliente, Porcentaje, RFC, 
                     CLIENTE.ESTATUS AS Estatus, VENDEDOR.NOMBRE AS Vendedor FROM CLIENTE
                     INNER JOIN DESCUENTO ON CLIENTE.IDDESCUENTO=DESCUENTO.IDDESCUENTO
                     INNER JOIN VENDEDOR_CLIENTE ON CLIENTE.IDCLIENTE=VENDEDOR_CLIENTE.IDCLIENTE
                     INNER JOIN VENDEDOR ON VENDEDOR.IDVENDEDOR=VENDEDOR_CLIENTE.IDVENDEDOR 
                     WHERE VENDEDOR_CLIENTE.ESTATUS=? AND CLIENTE.IDCLIENTE=? ORDER BY idCliente DESC";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array('Activo', $idCliente));
    }
    elseif($nombre!=""){
        $consulta = "SELECT CLIENTE.IDCLIENTE AS idCliente, CLIENTE.NOMBRE AS Cliente, Porcentaje, RFC, 
                     CLIENTE.ESTATUS AS Estatus, VENDEDOR.NOMBRE AS Vendedor FROM CLIENTE
                     INNER JOIN DESCUENTO ON CLIENTE.IDDESCUENTO=DESCUENTO.IDDESCUENTO
                     INNER JOIN VENDEDOR_CLIENTE ON CLIENTE.IDCLIENTE=VENDEDOR_CLIENTE.IDCLIENTE
                     INNER JOIN VENDEDOR ON VENDEDOR.IDVENDEDOR=VENDEDOR_CLIENTE.IDVENDEDOR 
                     WHERE VENDEDOR_CLIENTE.ESTATUS=? AND CLIENTE.NOMBRE=? ORDER BY idCliente DESC";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array('Activo', $nombre));
    }
    elseif($estatus!="" && $descuento!="" && $vendedor!=""){
        $consulta = "SELECT CLIENTE.IDCLIENTE AS idCliente, CLIENTE.NOMBRE AS Cliente, Porcentaje, RFC, 
                     CLIENTE.ESTATUS AS Estatus, VENDEDOR.NOMBRE AS Vendedor FROM CLIENTE
                     INNER JOIN DESCUENTO ON CLIENTE.IDDESCUENTO=DESCUENTO.IDDESCUENTO
                     INNER JOIN VENDEDOR_CLIENTE ON CLIENTE.IDCLIENTE=VENDEDOR_CLIENTE.IDCLIENTE
                     INNER JOIN VENDEDOR ON VENDEDOR.IDVENDEDOR=VENDEDOR_CLIENTE.IDVENDEDOR 
                     WHERE VENDEDOR_CLIENTE.ESTATUS=? AND CLIENTE.ESTATUS=? AND Porcentaje=? 
                     AND VENDEDOR.NOMBRE=? ORDER BY idCliente DESC";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array('Activo', $estatus, $descuento, $vendedor));
    }
    elseif($estatus!="" && $descuento!=""){
        $consulta = "SELECT CLIENTE.IDCLIENTE AS idCliente, CLIENTE.NOMBRE AS Cliente, Porcentaje, RFC, 
                     CLIENTE.ESTATUS AS Estatus, VENDEDOR.NOMBRE AS Vendedor FROM CLIENTE
                     INNER JOIN DESCUENTO ON CLIENTE.IDDESCUENTO=DESCUENTO.IDDESCUENTO
                     INNER JOIN VENDEDOR_CLIENTE ON CLIENTE.IDCLIENTE=VENDEDOR_CLIENTE.IDCLIENTE
                     INNER JOIN VENDEDOR ON VENDEDOR.IDVENDEDOR=VENDEDOR_CLIENTE.IDVENDEDOR 
                     WHERE VENDEDOR_CLIENTE.ESTATUS=? AND CLIENTE.ESTATUS=? AND Porcentaje=? 
                     ORDER BY idCliente DESC";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array('Activo', $estatus, $descuento));
    }
    elseif($estatus!="" && $vendedor!=""){
        $consulta = "SELECT CLIENTE.IDCLIENTE AS idCliente, CLIENTE.NOMBRE AS Cliente, Porcentaje, RFC, 
                     CLIENTE.ESTATUS AS Estatus, VENDEDOR.NOMBRE AS Vendedor FROM CLIENTE
                     INNER JOIN DESCUENTO ON CLIENTE.IDDESCUENTO=DESCUENTO.IDDESCUENTO
                     INNER JOIN VENDEDOR_CLIENTE ON CLIENTE.IDCLIENTE=VENDEDOR_CLIENTE.IDCLIENTE
                     INNER JOIN VENDEDOR ON VENDEDOR.IDVENDEDOR=VENDEDOR_CLIENTE.IDVENDEDOR 
                     WHERE VENDEDOR_CLIENTE.ESTATUS=? AND CLIENTE.ESTATUS=? 
                     AND VENDEDOR.NOMBRE=? ORDER BY idCliente DESC";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array('Activo', $estatus, $vendedor));
    }
    elseif($descuento!="" && $vendedor!=""){
        $consulta = "SELECT CLIENTE.IDCLIENTE AS idCliente, CLIENTE.NOMBRE AS Cliente, Porcentaje, RFC, 
                     CLIENTE.ESTATUS AS Estatus, VENDEDOR.NOMBRE AS Vendedor FROM CLIENTE
                     INNER JOIN DESCUENTO ON CLIENTE.IDDESCUENTO=DESCUENTO.IDDESCUENTO
                     INNER JOIN VENDEDOR_CLIENTE ON CLIENTE.IDCLIENTE=VENDEDOR_CLIENTE.IDCLIENTE
                     INNER JOIN VENDEDOR ON VENDEDOR.IDVENDEDOR=VENDEDOR_CLIENTE.IDVENDEDOR 
                     WHERE VENDEDOR_CLIENTE.ESTATUS=? AND Porcentaje=? 
                     AND VENDEDOR.NOMBRE=? ORDER BY idCliente DESC";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array('Activo', $descuento, $vendedor));
    }
    elseif($estatus!=""){
        $consulta = "SELECT CLIENTE.IDCLIENTE AS idCliente, CLIENTE.NOMBRE AS Cliente, Porcentaje, RFC, 
                     CLIENTE.ESTATUS AS Estatus, VENDEDOR.NOMBRE AS Vendedor FROM CLIENTE
                     INNER JOIN DESCUENTO ON CLIENTE.IDDESCUENTO=DESCUENTO.IDDESCUENTO
                     INNER JOIN VENDEDOR_CLIENTE ON CLIENTE.IDCLIENTE=VENDEDOR_CLIENTE.IDCLIENTE
                     INNER JOIN VENDEDOR ON VENDEDOR.IDVENDEDOR=VENDEDOR_CLIENTE.IDVENDEDOR 
                     WHERE VENDEDOR_CLIENTE.ESTATUS=? AND CLIENTE.ESTATUS=? 
                     ORDER BY idCliente DESC";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array('Activo', $estatus));
    }
    elseif($descuento!=""){
        $consulta = "SELECT CLIENTE.IDCLIENTE AS idCliente, CLIENTE.NOMBRE AS Cliente, Porcentaje, RFC, 
                     CLIENTE.ESTATUS AS Estatus, VENDEDOR.NOMBRE AS Vendedor FROM CLIENTE
                     INNER JOIN DESCUENTO ON CLIENTE.IDDESCUENTO=DESCUENTO.IDDESCUENTO
                     INNER JOIN VENDEDOR_CLIENTE ON CLIENTE.IDCLIENTE=VENDEDOR_CLIENTE.IDCLIENTE
                     INNER JOIN VENDEDOR ON VENDEDOR.IDVENDEDOR=VENDEDOR_CLIENTE.IDVENDEDOR 
                     WHERE VENDEDOR_CLIENTE.ESTATUS=? AND Porcentaje=? 
                     ORDER BY idCliente DESC";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array('Activo', $descuento));
    }
    elseif($vendedor!=""){
        $consulta = "SELECT CLIENTE.IDCLIENTE AS idCliente, CLIENTE.NOMBRE AS Cliente, Porcentaje, RFC, 
                     CLIENTE.ESTATUS AS Estatus, VENDEDOR.NOMBRE AS Vendedor FROM CLIENTE
                     INNER JOIN DESCUENTO ON CLIENTE.IDDESCUENTO=DESCUENTO.IDDESCUENTO
                     INNER JOIN VENDEDOR_CLIENTE ON CLIENTE.IDCLIENTE=VENDEDOR_CLIENTE.IDCLIENTE
                     INNER JOIN VENDEDOR ON VENDEDOR.IDVENDEDOR=VENDEDOR_CLIENTE.IDVENDEDOR 
                     WHERE VENDEDOR_CLIENTE.ESTATUS=? AND VENDEDOR.NOMBRE=? 
                     ORDER BY idCliente DESC";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array('Activo', $vendedor));
    }
    
    while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)){
        $numeroCliente[$contador] = $registro["idCliente"];
        $nombreCliente[$contador] = $registro["Cliente"];
        $estatusCliente[$contador] = $registro["Estatus"];
        $descuentoCliente[$contador] = $registro["Porcentaje"];
        $vendedorCliente[$contador] = $registro["Vendedor"];
        $rfcCliente[$contador] = $registro["RFC"];
        $contador++;
    }

    $datos["numeroCliente"]= $numeroCliente;
    $datos["nombreCliente"]= $nombreCliente;
    $datos["estatusCliente"]= $estatusCliente;
    $datos["descuentoCliente"]= $descuentoCliente;
    $datos["vendedorCliente"]= $vendedorCliente;
    $datos["rfcCliente"]= $rfcCliente;

    echo json_encode($datos);
?>