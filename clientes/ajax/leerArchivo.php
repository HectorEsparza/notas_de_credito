<?php
$opcionDeCarga = $_POST['opcionDeCarga'];
$archivoDeCarga = $_POST['archivoDeCarga'];

// $opcionDeCarga = "Nuevos Vendedores";
// $archivoDeCarga = "Estructura Clientes.csv";

$datos = array();
$datos["opcionDeCarga"] = $opcionDeCarga;
$datos["archivoDeCarga"] = $archivoDeCarga;
$destino = "..\\cargas\\" . $archivoDeCarga;


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
            if (count($linea) != 10) {
                break;
            }
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

    $datos["idCliente"] = $idCliente;
    $datos["nombreCliente"] = $nombreCliente;
    $datos["descuentoCliente"] = $descuentoCliente;
    $datos["rfcCliente"] = $rfcCliente;
    $datos["calleCliente"] = $calleCliente;
    $datos["coloniaCliente"] = $coloniaCliente;
    $datos["cpCliente"] = $cpCliente;
    $datos["telefonoCliente"] = $telefonoCliente;
    $datos["estatusCliente"] = $estatusCliente;
    $datos["vendedorCliente"] = $vendedorCliente;
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
            if (count($linea) != 3) {
                break;
            }
            $idVendedor[$contador] = $linea[0];
            $claveVendedor[$contador] = $linea[1];
            $nombreVendedor[$contador] = $linea[2];
            $contador++;
        }
    }
    fclose($nombreArchivo);

    $datos["idVendedor"] = $idVendedor;
    $datos["claveVendedor"] = $claveVendedor;
    $datos["nombreVendedor"] = $nombreVendedor;
}

echo json_encode($datos);
