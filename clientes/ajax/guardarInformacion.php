<?php
require_once("../../funciones.php");
$opcionDeCarga = $_POST['opcionDeCarga'];
$archivoDeCarga = $_POST['archivoDeCarga'];

// $opcionDeCarga = "Nuevos Vendedores";
// $archivoDeCarga = "Estructura Vendedor.csv";

$datos = array();
$datos["respuesta"] = 0;
$destino = "..\\cargas\\" . $archivoDeCarga;

$base = conexion_local();

$nombreArchivo = fopen($destino, "r") or die("Problemas al abrir el archivo");

if ($opcionDeCarga == "Nuevos Clientes" || $opcionDeCarga == "Actualizar Clientes") {
    $idCliente = array();
    $nombreCliente = array();
    $descuentoCliente = array();
    $rfcCliente = array();
    $calleCliente = array();
    $coloniaCliente = array();
    $cpCliente = array();
    $telefonoCliente = array();
    $estatusCliente = array();
    $vendedorCliente = array();
    $contador = 0;

    while (!feof($nombreArchivo)) {
        $linea = fgets($nombreArchivo);
        //$linea = utf8_decode($linea);
        //$linea = str_replace("Ñ", "?", $linea);
        $linea = trim($linea);

        //Medimos el tamaño de cada linea porque en la última linea nos dara 0 y dará un error al tratar de separar la cadena
        if (strlen($linea) > 0) {
            $linea = explode(",", $linea);
            $idCliente[$contador] = $linea[0];
            $nombreCliente[$contador] = $linea[1];
            $descuentoCliente[$contador] = $linea[2];
            $rfcCliente[$contador] = $linea[3];
            $calleCliente[$contador] = $linea[4];
            $coloniaCliente[$contador] = $linea[5];
            $cpCliente[$contador] = $linea[6];
            $telefonoCliente[$contador] = $linea[7];
            $estatusCliente[$contador] = $linea[8];
            $vendedorCliente[$contador] = $linea[9];
            //echo $nombreCliente[$contador] . "<br />";
            $contador++;
        }
    }
    fclose($nombreArchivo);

    $consultaCliente = "SELECT idCliente FROM CLIENTE WHERE idCliente=?";
    $consultaDescuento = "SELECT idDescuento FROM DESCUENTO WHERE Porcentaje=?";
    $consutaVendedor = "SELECT idVendedor FROM VENDEDOR WHERE idVendedor=?";

    for ($i=1; $i < $contador; $i++) {
        //Verificar si el idCliente ya esta asociado a otro cliente
        $resultadoCliente = $base->prepare($consultaCliente);
        $resultadoCliente->execute(array($idCliente[$i]));
        if($resultadoCliente->rowCount()==1 && $opcionDeCarga=="Nuevos Clientes"){
            $datos["respuesta"] = 1;
            $datos["idCliente"] = $idCliente[$i];
        }
        //Verificar que el descuento sea válido
        $resultadoDescuento = $base->prepare($consultaDescuento);
        $resultadoDescuento->execute(array($descuentoCliente[$i]));
        if($resultadoDescuento->rowCount()==0){
            $datos["respuesta"] = 2;
            $datos["idCliente"] = $idCliente[$i];
            $datos["descuentoCliente"] = $descuentoCliente[$i];
        }
        //Verificar que el vendedor sea válido
        $resultadoVendedor = $base->prepare($consutaVendedor);
        $resultadoVendedor->execute(array($vendedorCliente[$i]));
        if($resultadoVendedor->rowCount()==0){
            $datos["respuesta"] = 3;
            $datos["idCliente"] = $idCliente[$i];
            $datos["vendedorCliente"] = $vendedorCliente[$i];
        }
    }
    $resultadoCliente->closeCursor();
    $resultadoDescuento->closeCursor();
    $resultadoVendedor->closeCursor();

    //En caso de que hayan pasado las 3 verificaciones anteriores pasamos a insertar o actualizar según sea el caso
    if($datos["respuesta"]==0){
        switch ($opcionDeCarga) {
            case 'Nuevos Clientes':

                for ($i=1; $i < $contador; $i++) {
                    //Consulta para obtener el idDescuento
                    $obtenerIdDescuento = "SELECT idDescuento FROM DESCUENTO WHERE PORCENTAJE=?";
                    $resultadoObtenerIdDescuento = $base->prepare($obtenerIdDescuento);
                    $resultadoObtenerIdDescuento->execute(array($descuentoCliente[$i]));
                    $registro = $resultadoObtenerIdDescuento->fetch(PDO::FETCH_ASSOC);
                    $idDescuento = $registro["idDescuento"];
                    //Consulta para insertar los nuevos clientes
                    $insertarClientes = "INSERT INTO CLIENTE VALUES(?,?,?,?,?,?,?,?,?)";
                    $resultadoInsertarClientes = $base->prepare($insertarClientes);
                    $resultadoInsertarClientes->execute(
                        array($idCliente[$i], $nombreCliente[$i], $idDescuento, $rfcCliente[$i], $calleCliente[$i],
                            $coloniaCliente[$i], $cpCliente[$i], $telefonoCliente[$i], $estatusCliente[$i]));
                    //Antes de insertar la información en la tabla puente obtener el idVendedorCliente 
                    //mediante el auto_increment, si se deja como null lo contabiliza de 2 en 2
                    // $obtenerIdVendedorCliente = "SELECT AUTO_INCREMENT FROM  INFORMATION_SCHEMA.TABLES
                    //                              WHERE TABLE_SCHEMA = ? AND   
                    //                              TABLE_NAME=?";
                    // $resultadoObtenerIdVendedorCliente = $base->prepare($obtenerIdVendedorCliente);
                    // $resultadoObtenerIdVendedorCliente->execute(array('APLICACION', 'VENDEDOR_CLIENTE'));
                    // $registro = $resultadoObtenerIdVendedorCliente->fetch(PDO::FETCH_ASSOC);
                    // $idVendedorCliente = $registro["AUTO_INCREMENT"];
                    //Consulta para insertar las relaciones entre vendedor_cliente
                    $insertarVendedorClientes = "INSERT INTO VENDEDOR_CLIENTE VALUES(?,?,?,?,curdate(),?)";
                    $resultadoInsertarVendedorClientes = $base->prepare($insertarVendedorClientes);
                    $resultadoInsertarVendedorClientes->execute(
                        array(NULL, $vendedorCliente[$i], $idCliente[$i], 'Activo', '0000-00-00'));
                }
                $resultadoObtenerIdDescuento->closeCursor();
                $resultadoInsertarClientes->closeCursor();
                //$resultadoObtenerIdVendedorCliente->closeCursor();
                $resultadoInsertarVendedorClientes->closeCursor();
                break;
            
            case 'Actualizar Clientes':
                
                for ($i=1; $i < $contador; $i++) {
                    //Consulta para obtener el idDescuento
                    $obtenerIdDescuento = "SELECT idDescuento FROM DESCUENTO WHERE PORCENTAJE=?";
                    $resultadoObtenerIdDescuento = $base->prepare($obtenerIdDescuento);
                    $resultadoObtenerIdDescuento->execute(array($descuentoCliente[$i]));
                    $registro = $resultadoObtenerIdDescuento->fetch(PDO::FETCH_ASSOC);
                    $idDescuento = $registro["idDescuento"];
                    //Consuta para actualizar la tabla cliente
                    $actualizarClientes = "UPDATE CLIENTE SET Nombre=?, idDescuento=?, RFC=?, 
                                           Calle=?, Colonia=?, CP=?, Telefono=?, Estatus=?
                                           WHERE idCliente=?";
                    $resultadoActualizarClientes = $base->prepare($actualizarClientes);
                    $resultadoActualizarClientes->execute(
                        array($nombreCliente[$i], $idDescuento, $rfcCliente[$i], $calleCliente[$i],
                              $coloniaCliente[$i], $cpCliente[$i], $telefonoCliente[$i], $estatusCliente[$i],
                              $idCliente[$i]));
                    //Consulta para recuperar el idVendedorCliente
                    $obtenerIdVendedorCliente = "SELECT idVendedorCliente FROM  VENDEDOR_CLIENTE
                                                 WHERE idVendedor=? AND idCliente=? AND Estatus=?";
                    $resultadoObtenerIdVendedorCliente = $base->prepare($obtenerIdVendedorCliente);
                    $resultadoObtenerIdVendedorCliente->execute(array($vendedorCliente[$i], $idCliente[$i], 'Activo'));
                    $registro = $resultadoObtenerIdVendedorCliente->fetch(PDO::FETCH_ASSOC);
                    $idVendedorCliente = $registro["idVendedorCliente"];
                    //Si el idVendedor es diferente al que se leyo del archivo entonces
                    //habrá que cambiar el estatus de Activo a Inactivo de la tabla vendedor_cliente
                    //y posteriormente realizar la inserción del nuevo registro en la tabla vendedor_cliente
                    if($idVendedorCliente==""){
                        $actualizarVendedorCliente = "UPDATE VENDEDOR_CLIENTE SET Estatus=?, FechaFin=curdate()
                                                             WHERE idCliente=? AND Estatus=?";
                        $resultadoActualizarVendedorCliente = $base->prepare($actualizarVendedorCliente);
                        $resultadoActualizarVendedorCliente->execute(array('Inactivo', $idCliente[$i], 'Activo'));
                        //Consulta para insertar las relaciones entre vendedor_cliente
                        $insertarVendedorClientes = "INSERT INTO VENDEDOR_CLIENTE VALUES(?,?,?,?,curdate(),?)";
                        $resultadoInsertarVendedorClientes = $base->prepare($insertarVendedorClientes);
                        $resultadoInsertarVendedorClientes->execute(
                            array(NULL, $vendedorCliente[$i], $idCliente[$i], 'Activo', '0000-00-00'));
                        $resultadoActualizarVendedorCliente->closeCursor();
                        $resultadoInsertarVendedorClientes->closeCursor();
                    }
                }
                $resultadoObtenerIdDescuento->closeCursor();
                $resultadoActualizarClientes->closeCursor();
                $resultadoObtenerIdVendedorCliente->closeCursor();
                
                break;
        }
    }

} else if ($opcionDeCarga == "Nuevos Vendedores" || $opcionDeCarga == "Actualizar Vendedores") {
    $idVendedor = array();
    $claveVendedor = array();
    $nombreVendedor = array();
    $contador = 0;

    while (!feof($nombreArchivo)) {
        $linea = fgets($nombreArchivo);
        //$linea = utf8_decode($linea);
        $linea = trim($linea);

        //Medimos el tamaño de cada linea porque en la última linea nos dara 0 y dará un error al tratar de separar la cadena
        if (strlen($linea) > 0) {
            $linea = explode(",", $linea);
            $idVendedor[$contador] = $linea[0];
            $claveVendedor[$contador] = $linea[1];
            $nombreVendedor[$contador] = $linea[2];
            $contador++;
        }
    }
    fclose($nombreArchivo);

    $consultaVendedor = "SELECT idVendedor FROM VENDEDOR WHERE idVendedor=?";
    $consultaClave = "SELECT idVendedor FROM VENDEDOR WHERE Clave=?";
    $consutaNombre = "SELECT idVendedor FROM VENDEDOR WHERE Nombre=?";

    for ($i=1; $i < $contador; $i++) {
        //Verificar si el idVendedor ya esta asociado a otro vendedor
        $resultadoVendedor = $base->prepare($consultaVendedor);
        $resultadoVendedor->execute(array($idVendedor[$i]));
        if($resultadoVendedor->rowCount()==1 && $opcionDeCarga=="Nuevos Vendedores"){
            $datos["respuesta"] = 4;
            $datos["idVendedor"] = $idVendedor[$i];
        }
        //Verificar si la clave ya esta asociada a otro vendedor
        $resultadoClave = $base->prepare($consultaClave);
        $resultadoClave->execute(array($claveVendedor[$i]));
        if($resultadoClave->rowCount()==1){
            $datos["respuesta"] = 5;
            $datos["idVendedor"] = $idVendedor[$i];
            $datos["claveVendedor"] = $claveVendedor[$i];
        }
        //Verificar si el nombre ya esta asociado a otro vendedor
        $resultadoNombre = $base->prepare($consutaNombre);
        $resultadoNombre->execute(array($nombreVendedor[$i]));
        if($resultadoNombre->rowCount()==1){
            $datos["respuesta"] = 6;
            $datos["idVendedor"] = $idVendedor[$i];
            $datos["nombreVendedor"] = $nombreVendedor[$i];
        }
    }
    $resultadoVendedor->closeCursor();
    $resultadoClave->closeCursor();
    $resultadoNombre->closeCursor();

    //En caso de que hayan pasado las 3 verificaciones anteriores pasamos a insertar o actualizar según sea el caso
    if($datos["respuesta"]==0){
        switch ($opcionDeCarga) {
            case 'Nuevos Vendedores':
                for ($i=1; $i < $contador; $i++) {
                    //Consulta para insertar los nuevos vendedores
                    $indertarVendedores = "INSERT INTO VENDEDOR VALUES(?,?,?,?)";
                    $resultadoInsertarVendedores = $base->prepare($indertarVendedores);
                    $resultadoInsertarVendedores->execute(
                        array($idVendedor[$i], $claveVendedor[$i], $nombreVendedor[$i], NULL));
                }
                $resultadoInsertarVendedores->closeCursor();
                break;
            
            case 'Actualizar Vendedores':
                
                for ($i=1; $i < $contador; $i++) {
                    //Consuta para actualizar la tabla vendedor
                    $actualizarVendedores = "UPDATE VENDEDOR SET Clave=?, Nombre=? WHERE idVendedor=?";
                    $resultadoActualizarVendedores = $base->prepare($actualizarVendedores);
                    $resultadoActualizarVendedores->execute(
                        array($claveVendedor[$i], $nombreVendedor[$i], $idVendedor[$i]));
                }
                $resultadoActualizarVendedores->closeCursor();
                
                break;
        }
    }

}

$base = null;

echo json_encode($datos);
