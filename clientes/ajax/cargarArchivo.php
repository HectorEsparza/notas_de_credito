<?php

    $opcion = $_POST["opcionDeCarga"];
    $archivo = $_FILES['archivoDeCarga']['name'];
    $ruta = $_FILES['archivoDeCarga']['tmp_name'];

    $datos = array();
    $datos["flag"] = 0;
    $destino = "..\\cargas\\".$archivo;
    move_uploaded_file($ruta, $destino);

    
    $nombreArchivo = fopen($destino, "r") or die("Problemas al abrir el archivo");

      $linea = fgets($nombreArchivo);
      $linea = utf8_decode($linea);
      $linea = trim($linea);
     
    fclose($nombreArchivo);
    $linea = explode(",", $linea);
    $numeroColumnas = count($linea);

    if($numeroColumnas==10){
        if($linea[0]=="Numero Cliente" && $linea[1]=="Nombre" && $linea[2]=="Descuento" && $linea[3]=="RFC" &&
           $linea[4]=="Calle" && $linea[5]=="Colonia" && $linea[6]=="CP" && $linea[7]=="Telefono" && 
           $linea[8]=="Estatus" && $linea[9]=="Vendedor"){
               $datos["flag"] = 1;
        }
        else{
            $datos["flag"]= 0;
        }
    }
    elseif($numeroColumnas==3){
        if($linea[0]=="Numero Vendedor" && $linea[1]=="Clave" && $linea[2]=="Nombre"){
            $datos["flag"] = 1;
        }
        else{
            $datos["flag"]= 0;
        }
    }

    $datos["opcionDeCarga"] = $opcion;
    $datos["nombreArchivo"] = $archivo;
    $datos["nombreColumnas"] = $linea;
    $datos["numeroColumnas"] = $numeroColumnas;
    
    echo json_encode($datos);
?>