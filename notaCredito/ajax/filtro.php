<?php
require_once("../../funciones.php");
//echo "Oraleee Muchachon!!!";
/*<tr>
  <td><?= $registro[0]?></td>
  <td><?= $registro[1]?></td>
  <td><?= $registro[2]?></td>
  <td><?= $registro[3]?></td>
  <td><?= $registro[4]?></td>
</tr>*/
$nocliente = $_GET['nocliente'];
$cliente = $_GET['cliente'];
$fecha = $_GET['fecha'];
$folio = $_GET['folio'];
$sae = $_GET['sae'];
$contador = 1;
$flag = 0;

// echo "cliente= " . $cliente . "<br />";
// echo "fecha= " . $fecha . "<br />";
// echo "folio= " . $folio . "<br />";
// echo "sae= " . $sae . "<br />";

/*function fechaConsulta($fecha){

  $particion = explode("/", $fecha);
  $nueva = $particion[2] . "-" . $particion[0] . "-" . $particion[1];
  return $nueva;

}

function fechaJquery($fecha){
           //echo $fecha;
           $nueva = explode("-", $fecha);
           echo $nueva[1] . "/" . $nueva[2] . "/" . $nueva[0];

}*/

    $base = conexion_local();

    if($nocliente!=""&&$cliente!=""&&$fecha!=""&&$folio!=""&&$sae!=""){
      // echo "Consulta AND de los 5";
      $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE LIKE ? AND FECHA=? AND FOLIOINTERNO=? AND NOTASAE=? ORDER BY REGISTRO DESC LIMIT 20";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($nocliente, '%' . $cliente . '%', fechaConsulta($fecha), $folio,  $sae));
    }
    elseif($nocliente!=""&&$cliente!=""&&$fecha!=""&&$folio!=""){
      // echo "Consulta AND de los 4; nocliente, cliente, fecha, folio";
      $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE LIKE ? AND FECHA=? AND FOLIOINTERNO=? ORDER BY REGISTRO DESC LIMIT 20";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($nocliente, '%' . $cliente . '%', fechaConsulta($fecha), $folio));
    }
    elseif($nocliente!=""&&$fecha!=""&&$folio!=""&&$sae!=""){
      // echo "Consulta AND de los 4; nocliente, cliente, fecha, sae";
      $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND FECHA=? AND FOLIOINTERNO=? AND NOTASAE=? ORDER BY REGISTRO DESC LIMIT 20";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($nocliente, fechaConsulta($fecha), $folio, $sae));
    }
    elseif ($cliente!=""&&$fecha!=""&&$folio!=""&&$sae!="") {
      // echo "Consulta AND de los 4; cliente, fecha, folio, sae";
      $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE LIKE ? AND FECHA=? AND FOLIOINTERNO=? AND NOTASAE=? ORDER BY REGISTRO DESC LIMIT 20";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array('%' . $cliente . '%', fechaConsulta($fecha), $folio,  $sae));
    }
    elseif ($nocliente!=""&&$cliente!=""&&$fecha!=""&&$sae!="") {
        // echo "Consulta AND de los 4; nocliente, cliente, fecha, sae";
        $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE LIKE ? AND FECHA=? AND NOTASAE=? ORDER BY REGISTRO DESC LIMIT 20";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($nocliente, '%' . $cliente . '%', fechaConsulta($fecha), $sae));
    }
    elseif ($nocliente!=""&&$cliente!=""&&$fecha!="") {
        // echo "Consulta AND de los 3; nocliente, cliente, fecha";
        $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE LIKE ? AND FECHA=? ORDER BY REGISTRO DESC LIMIT 20";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($nocliente, '%' . $cliente . '%', fechaConsulta($fecha)));
    }
    elseif ($nocliente!=""&&$fecha!=""&&$folio!="") {
        // echo "Consulta AND de los 3; nocliente, fecha, folio";
        $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND FECHA=? AND FOLIOINTERNO=? ORDER BY REGISTRO DESC LIMIT 20";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($nocliente, fechaConsulta($fecha), $folio));
    }
    elseif ($nocliente!=""&&$folio!=""&&$sae!="") {
        // echo "Consulta AND de los 3; nocliente, folio, sae";
        $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND FOLIOINTERNO=? AND NOTASAE=? ORDER BY REGISTRO DESC LIMIT 20";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($nocliente, $folio, $sae));
    }
    elseif ($cliente!=""&&$fecha!=""&&$folio!="") {
        // echo "Consulta AND de los 3; cliente, fecha, folio";
        $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND FECHA=? AND FOLIOINTERNO=? ORDER BY REGISTRO DESC LIMIT 20";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($nocliente, fechaConsulta($fecha), $folio));
    }
    elseif ($cliente!=""&&$folio!=""&&$sae!="") {
        // echo "Consulta AND de los 3; cliente, folio, sae";
        $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE LIKE ? AND FOLIOINTERNO=? AND NOTASAE=? ORDER BY REGISTRO DESC LIMIT 20";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array('%' . $cliente . '%', $folio, $sae));
    }
    elseif ($fecha!=""&&$folio!=""&&$sae!="") {
        // echo "Consulta AND de los 3; fecha, folio, sae";
        $consulta = "SELECT * FROM NOTAS_VIS WHERE FECHA=? AND FOLIOINTERNO=? AND NOTASAE=?ORDER BY REGISTRO DESC LIMIT 20";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array(fechaConsulta($fecha), $folio, $sae));
    }
    elseif ($folio!=""&&$nocliente!=""&&$cliente!="") {
        // echo "Consulta AND de los 3; folio, nocliente, cliente";
        $consulta = "SELECT * FROM NOTAS_VIS WHERE FOLIOINTERNO=? AND NOCLIENTE=? AND CLIENTE=? ORDER BY REGISTRO DESC LIMIT 20";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($folio, $nocliente, '%' . $cliente . '%'));
    }
    elseif ($nocliente!=""&&$cliente!=""&&$sae!="") {
        // echo "Consulta AND de los 3; nocliente, cliente, sae";
        $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE=? AND NOTASAE=?ORDER BY REGISTRO DESC LIMIT 20";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($nocliente, '%' . $cliente . '%', $sae));
    }
    elseif ($cliente!=""&&$fecha!=""&&$sae!="") {
        // echo "Consulta AND de los 3; cliente, fecha, sae";
        $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE=? AND FECHA=? AND NOTASAE=? ORDER BY REGISTRO DESC LIMIT 20";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($folio, $nocliente, $sae));
    }
    elseif ($nocliente!=""&&$cliente!="") {
        // echo "Consulta AND de los 2; nocliente y cliente";
        $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE LIKE ? AND NOCLIENTE=? ORDER BY REGISTRO DESC LIMIT 20";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array('%' . $cliente . '%', $nocliente));
    }
    elseif ($nocliente!=""&&$fecha!="") {
        // echo "Consulta AND de los 2; nocliente y fecha";
        $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND FECHA=? ORDER BY REGISTRO DESC LIMIT 20";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($nocliente, $fecha));
    }
    elseif ($nocliente!=""&&$folio!="") {
        // echo "Consulta AND de los 2; nocliente y folio";
        $consulta = "SELECT * FROM NOTAS_VIS WHERE FOLIOINTERNO=? AND NOCLIENTE=? ORDER BY REGISTRO DESC LIMIT 20";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($folio, $nocliente));
    }
    elseif ($nocliente!=""&&$sae!="") {
        // echo "Consulta AND de los 2; nocliente y sae";
        $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND NOTASAE=? ORDER BY REGISTRO DESC LIMIT 20";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($nocliente, $sae));
    }
    elseif ($cliente!=""&&$fecha!="") {
        // echo "Consulta AND de los 2; cliente y fecha";
        $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE LIKE ? AND FECHA=? ORDER BY REGISTRO DESC LIMIT 20";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array('%' . $cliente . '%', fechaConsulta($fecha)));
    }
    elseif ($cliente!=""&&$folio!="") {
        // echo "Consulta AND de los 2; cliente y folio";
        $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE LIKE ? AND FOLIOINTERNO=? ORDER BY REGISTRO DESC LIMIT 20";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array('%' . $cliente . '%', $folio));
    }
    elseif ($cliente!=""&&$sae!="") {
        // echo "Consulta AND de los 2; cliente y sae";
        $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE LIKE ? AND NOTASAE=? ORDER BY REGISTRO DESC LIMIT 20";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array('%' . $cliente . '%', $sae));
    }
    elseif ($fecha!=""&&$folio!="") {
        // echo "Consulta AND de los 2; fecha y folio";
        $consulta = "SELECT * FROM NOTAS_VIS WHERE FECHA=? AND FOLIOINTERNO=? ORDER BY REGISTRO DESC LIMIT 20";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array(fechaConsulta($fecha), $folio));
    }
    elseif ($fecha!=""&&$sae!="") {
        // echo "Consulta AND de los 2; fecha y sae";
        $consulta = "SELECT * FROM NOTAS_VIS WHERE FECHA=? AND NOTASAE=? ORDER BY REGISTRO DESC LIMIT 20";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array(fechaConsulta($fecha), $sae));
    }
    elseif ($sae!=""&&$folio!="") {
        // echo "Consulta AND de los 2; sae y folio";
        $consulta = "SELECT * FROM NOTAS_VIS WHERE NOTASAE=? AND FOLIOINTERNO=? ORDER BY REGISTRO DESC LIMIT 20";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($sae, $folio));
    }
    elseif ($nocliente!="") {
      // echo "Consulta individual nocliente";
      $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE= ?  ORDER BY REGISTRO DESC LIMIT 20";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($nocliente));
    }
    elseif ($cliente!="") {
      // echo "Consulta individual cliente";
      $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE LIKE ?  ORDER BY REGISTRO DESC LIMIT 20";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array('%' . $cliente . '%'));
    }
    elseif ($fecha!="") {
      // echo "Consulta individual fecha";
      $consulta = "SELECT * FROM NOTAS_VIS WHERE FECHA= ?  ORDER BY REGISTRO DESC LIMIT 20";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array(fechaConsulta($fecha)));
    }
    elseif ($folio!="") {
      // echo "Consulta individual folio";
      $consulta = "SELECT * FROM NOTAS_VIS WHERE FOLIOINTERNO= ?  ORDER BY REGISTRO DESC LIMIT 20";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($folio));
    }
    elseif ($sae!="") {
      // echo "Consulta individual sae";
      $consulta = "SELECT * FROM NOTAS_VIS WHERE NOTASAE= ?  ORDER BY REGISTRO DESC LIMIT 20";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($sae));
    }
    else{
      echo "No introdujo ningun campo!!!";
      $flag = 1; //Está bandera me indica que no entro a ninguna consulta de la base de datos
    }


?>


<? if($flag==0) :?>
    <table  border=1 align='center'>
        <!-- <thead>
            <tr>
              <th>Folio Interno</th>
              <th>Cliente</th>
              <th>Total Nota</th>
              <th>Fecha</th>
              <th>Info</th>
            </tr>
        </thead> -->
        <tbody id="table">
           <? while($registro = $resultado->fetch(PDO::FETCH_NUM)) :?>

              <? if($registro[7]=="ACTIVA") :?>
                    <? if($registro[2]!="") :?>

                          <tr>
                                  <td class='principal'><input type='text' class='folio<?= $contador?>' value='<?= $registro[0]?>' readonly /></td>
                                  <td class='principal'><?= $registro[8]?></td>
                                  <td class='principal'><?= $registro[1]?></td>
                                  <td class='principal'><?= $registro[2]?></td>
                                  <td class='principal'><?= "$" . number_format($registro[3], 2, ".", ",")?></td>
                                  <td class='principal'><?= fechaJquery($registro[4])?></td>
                                  <td class='principal'><?= $registro[7]?></td>
                                  <td><button class='ver' onclick="saludo(document.querySelector('.folio<?= $contador?>').value)">Ver</button></td>
                          </tr>
                    <? else :?>

                          <tr>
                                  <td class='nulo'><input type='text' class='folio<?= $contador?>' value='<?= $registro[0]?>' readonly /></td>
                                  <td class='nulo'><?= $registro[8]?></td>
                                  <td class='nulo'><?= $registro[1]?></td>
                                  <td class='nulo'>NULL</td>
                                  <td class='nulo'><?= "$" . number_format($registro[3], 2, ".", ",")?></td>
                                  <td class='nulo'><?= fechaJquery($registro[4])?></td>
                                  <td class='nulo'><?= $registro[7]?></td>
                                  <td><button class='modifica' onclick="saludo(document.querySelector('.folio<?= $contador?>').value)">!</button></td>
                          </tr>

                    <? endif ?>

              <? else :?>
                          <tr>
                                  <td class='cancelada'><input type='text' class='folio<?= $contador?>' value='<?= $registro[0]?>' readonly /></td>
                                  <td class='cancelada'><?= $registro[8]?></td>
                                  <td class='cancelada'><?= $registro[1]?></td>
                                  <td class='cancelada'><?= $registro[2]?></td>
                                  <td class='cancelada'><?= "$" . number_format($registro[3], 2, ".", ",")?></td>
                                  <td class='cancelada'><?= fechaJquery($registro[4])?></td>
                                  <td class='cancelada'><?= $registro[7]?></td>
                                  <td><button class='modifica' onclick="saludo(document.querySelector('.folio<?= $contador?>').value)">!</button></td>
                          </tr>
              <? endif ?>


              <? $contador++;?>
           <? endwhile?>


        </tbody>
    </table>

<? endif?>
