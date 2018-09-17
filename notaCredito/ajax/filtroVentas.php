<?php
require_once("../../funciones.php");

$nocliente = $_GET['nocliente'];
$cliente = $_GET['cliente'];
$fecha = $_GET['fecha'];
$folio = $_GET['folio'];
$recepcion = $_GET['recepcion'];
$contador = 1;
$flag = 0;




$base = conexion_local();

if($nocliente!=""&&$cliente!=""&&$fecha!=""&&$folio!=""&&$recepcion!=""){
  // echo "Consulta AND de los 5";
  $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE LIKE ? AND FECHA=? AND FOLIOINTERNO=? AND RECEPCION=? ORDER BY FECHA DESC LIMIT 20";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($nocliente, '%' . $cliente . '%', fechaConsulta($fecha), $folio,  $recepcion));
}
elseif($nocliente!=""&&$cliente!=""&&$fecha!=""&&$folio!=""){
  // echo "Consulta AND de los 4; nocliente, cliente, fecha, folio";
  $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE LIKE ? AND FECHA=? AND FOLIOINTERNO=? ORDER BY FECHA DESC LIMIT 20";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($nocliente, '%' . $cliente . '%', fechaConsulta($fecha), $folio));
}
elseif($nocliente!=""&&$fecha!=""&&$folio!=""&&$recepcion!=""){
  // echo "Consulta AND de los 4; nocliente, cliente, fecha, folioRecepcion";
  $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND FECHA=? AND FOLIOINTERNO=? AND RECEPCION=? ORDER BY FECHA DESC LIMIT 20";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($nocliente, fechaConsulta($fecha), $folio, $recepcion));
}
elseif ($cliente!=""&&$fecha!=""&&$folio!=""&&$recepcion!="") {
  // echo "Consulta AND de los 4; cliente, fecha, folio, folioRecepcion";
  $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE LIKE ? AND FECHA=? AND FOLIOINTERNO=? AND RECEPCION=? ORDER BY FECHA DESC LIMIT 20";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array('%' . $cliente . '%', fechaConsulta($fecha), $folio,  $recepcion));
}
elseif ($nocliente!=""&&$cliente!=""&&$fecha!=""&&$recepcion!="") {
    // echo "Consulta AND de los 4; nocliente, cliente, fecha, folioRecepcion";
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE LIKE ? AND FECHA=? AND RECEPCION=? ORDER BY FECHA DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, '%' . $cliente . '%', fechaConsulta($fecha), $recepcion));
}
elseif ($nocliente!=""&&$cliente!=""&&$fecha!="") {
    // echo "Consulta AND de los 3; nocliente, cliente, fecha";
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE LIKE ? AND FECHA=? ORDER BY FECHA DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, '%' . $cliente . '%', fechaConsulta($fecha)));
}
elseif ($nocliente!=""&&$fecha!=""&&$folio!="") {
    // echo "Consulta AND de los 3; nocliente, fecha, folio";
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND FECHA=? AND FOLIOINTERNO=? ORDER BY FECHA DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, fechaConsulta($fecha), $folio));
}
elseif ($nocliente!=""&&$folio!=""&&$recepcion!="") {
    // echo "Consulta AND de los 3; nocliente, folio, folioRecepcion";
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND FOLIOINTERNO=? AND RECEPCION=? ORDER BY FECHA DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $folio, $recepcion));
}
elseif ($cliente!=""&&$fecha!=""&&$folio!="") {
    // echo "Consulta AND de los 3; cliente, fecha, folio";
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND FECHA=? AND FOLIOINTERNO=? ORDER BY FECHA DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, fechaConsulta($fecha), $folio));
}
elseif ($cliente!=""&&$folio!=""&&$recepcion!="") {
    // echo "Consulta AND de los 3; cliente, folio, folioRecepcion";
    $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE LIKE ? AND FOLIOINTERNO=? AND RECEPCION=? ORDER BY FECHA DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array('%' . $cliente . '%', $folio, $recepcion));
}
elseif ($fecha!=""&&$folio!=""&&$recepcion!="") {
    // echo "Consulta AND de los 3; fecha, folio, folioRecepcion";
    $consulta = "SELECT * FROM NOTAS_VIS WHERE FECHA=? AND FOLIOINTERNO=? AND RECEPCION=?ORDER BY FECHA DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array(fechaConsulta($fecha), $folio, $recepcion));
}
elseif ($folio!=""&&$nocliente!=""&&$cliente!="") {
    // echo "Consulta AND de los 3; folio, nocliente, cliente";
    $consulta = "SELECT * FROM NOTAS_VIS WHERE FOLIOINTERNO=? AND NOCLIENTE=? AND CLIENTE=? ORDER BY FECHA DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($folio, $nocliente, '%' . $cliente . '%'));
}
elseif ($nocliente!=""&&$cliente!=""&&$recepcion!="") {
    // echo "Consulta AND de los 3; nocliente, cliente, folioRecepcion";
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND CLIENTE=? AND RECEPCION=? ORDER BY FECHA DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, '%' . $cliente . '%', $recepcion));
}
elseif ($cliente!=""&&$fecha!=""&&$recepcion!="") {
    // echo "Consulta AND de los 3; cliente, fecha, folioRecepcion";
    $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE=? AND FECHA=? AND RECEPCION=? ORDER BY FECHA DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($folio, $nocliente, $recepcion));
}
elseif ($nocliente!=""&&$cliente!="") {
    // echo "Consulta AND de los 2; nocliente y cliente";
    $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE LIKE ? AND NOCLIENTE=? ORDER BY FECHA DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array('%' . $cliente . '%', $nocliente));
}
elseif ($nocliente!=""&&$fecha!="") {
    // echo "Consulta AND de los 2; nocliente y fecha";
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND FECHA=? ORDER BY FECHA DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $fecha));
}
elseif ($nocliente!=""&&$folio!="") {
    // echo "Consulta AND de los 2; nocliente y folio";
    $consulta = "SELECT * FROM NOTAS_VIS WHERE FOLIOINTERNO=? AND NOCLIENTE=? ORDER BY FECHA DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($folio, $nocliente));
}
elseif ($nocliente!=""&&$recepcion!="") {
    // echo "Consulta AND de los 2; nocliente y folioRecepcion";
    $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE=? AND RECEPCION=? ORDER BY FECHA DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $recepcion));
}
elseif ($cliente!=""&&$fecha!="") {
    // echo "Consulta AND de los 2; cliente y fecha";
    $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE LIKE ? AND FECHA=? ORDER BY FECHA DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array('%' . $cliente . '%', fechaConsulta($fecha)));
}
elseif ($cliente!=""&&$folio!="") {
    // echo "Consulta AND de los 2; cliente y folio";
    $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE LIKE ? AND FOLIOINTERNO=? ORDER BY FECHA DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array('%' . $cliente . '%', $folio));
}
elseif ($cliente!=""&&$recepcion!="") {
    // echo "Consulta AND de los 2; cliente y folioRecepcion";
    $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE LIKE ? AND RECEPCION=? ORDER BY FECHA DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array('%' . $cliente . '%', $recepcion));
}
elseif ($fecha!=""&&$folio!="") {
    // echo "Consulta AND de los 2; fecha y folio";
    $consulta = "SELECT * FROM NOTAS_VIS WHERE FECHA=? AND FOLIOINTERNO=? ORDER BY FECHA DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array(fechaConsulta($fecha), $folio));
}
elseif ($fecha!=""&&$recepcion!="") {
    // echo "Consulta AND de los 2; fecha y folioRecepcion";
    $consulta = "SELECT * FROM NOTAS_VIS WHERE FECHA=? AND RECEPCION=? ORDER BY FECHA DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array(fechaConsulta($fecha), $recepcion));
}
elseif ($$recepcion!=""&&$folio!="") {
    // echo "Consulta AND de los 2; folioRecepcion y folio";
    $consulta = "SELECT * FROM NOTAS_VIS WHERE RECEPCION=? AND FOLIOINTERNO=? ORDER BY FECHA DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($recepcion, $folio));
}
elseif ($nocliente!="") {
  // echo "Consulta individual nocliente";
  $consulta = "SELECT * FROM NOTAS_VIS WHERE NOCLIENTE= ?  ORDER BY FECHA DESC LIMIT 20";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($nocliente));
}
elseif ($cliente!="") {
  // echo "Consulta individual cliente";
  $consulta = "SELECT * FROM NOTAS_VIS WHERE CLIENTE LIKE ?  ORDER BY FECHA DESC LIMIT 20";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array('%' . $cliente . '%'));
}
elseif ($fecha!="") {
  // echo "Consulta individual fecha";
  $consulta = "SELECT * FROM NOTAS_VIS WHERE FECHA= ?  ORDER BY FECHA DESC LIMIT 20";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array(fechaConsulta($fecha)));
}
elseif ($folio!="") {
  // echo "Consulta individual folio";
  $consulta = "SELECT * FROM NOTAS_VIS WHERE FOLIOINTERNO= ?  ORDER BY FECHA DESC LIMIT 20";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($folio));
}
elseif ($recepcion!="") {
  // echo "Consulta individual folioRecepcion";
  $consulta = "SELECT * FROM NOTAS_VIS WHERE RECEPCION= ?  ORDER BY FECHA DESC LIMIT 20";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($recepcion));
}
else{
  echo "No introdujo ningun campo!!!";
  $flag = 1; //Está bandera me indica que no entro a ninguna consulta de la base de datos
}
?>
<? if($flag==0) :?>
    <table  border=1 align='center'>
        <thead>
            <tr>
              <th>Folio Interno</th>
              <th>Folio Rec</th>
              <th>NO Cliente</th>
              <th>Cliente</th>
              <th>NO SAE</th>
              <th>Total Nota</th>
              <th>Fecha</th>
              <th>Status</th>
              <th>Info</th>
            </tr>
        </thead>
        <tbody id="table">
           <? while($registro = $resultado->fetch(PDO::FETCH_NUM)) :?>
                  <? if($registro[6]=="ACTIVA") :?>
                      <tr>
                              <td class='principal'><input type='text' class='folio<?= $contador?>' value='<?= $registro[0]?>' readonly /></td>
                              <td class='principal'><?= $registro[9]?></td>
                              <td class='principal'><?= $registro[7]?></td>
                              <td class='principal'><?= $registro[1]?></td>
                              <td class='principal'><?= $registro[2]?></td>
                              <td class='principal'><?= "$" . number_format($registro[3], 2, ".", ",")?></td>
                              <td class='principal'><?= fechaJquery($registro[4])?></td>
                              <td class='principal'><?= $registro[6]?></td>
                              <td><button class='ver' onclick="saludo(document.querySelector('.folio<?= $contador?>').value)">Ver</button></td>
                      </tr>
                  <? else :?>
                     <tr>
                              <td class='cancelada'><input type='text' class='folio<?= $contador?>' value='<?= $registro[0]?>' readonly /></td>
                              <td class='cancelada'><?= $registro[9]?></td>
                              <td class='cancelada'><?= $registro[7]?></td>
                              <td class='cancelada'><?= $registro[1]?></td>
                              <td class='cancelada'><?= $registro[1]?></td>
                              <td class='cancelada'><?= "$" . number_format($registro[3], 2, ".", ",")?></td>
                              <td class='cancelada'><?= fechaJquery($registro[4])?></td>
                              <td class='cancelada'><?= $registro[6]?></td>
                              <td><button class='ver' onclick="saludo(document.querySelector('.folio<?= $contador?>').value)">Ver</button></td>
                     </tr>
                  <? endif?>

              <? $contador++;?>
           <? endwhile?>


        </tbody>
    </table>

<? endif?>
