<?php
require_once("../../funciones.php");

$nocliente = $_GET['nocliente'];
$cliente = $_GET['cliente'];
$fecha = $_GET['fecha'];
$folio = $_GET['folio'];
$usuario = $_GET['usuario'];
$contador = 1;
$flag = 0;




$base = conexion_local();

if($nocliente!=""&&$cliente!=""&&$fecha!=""&&$folio!=""&&$usuario!=""){
  // echo "Consulta AND de los 5";
  $consulta = "SELECT * FROM PEDIDOS_VIS WHERE NOCLIENTE=? AND CLIENTE LIKE ? AND FECHA=? AND FOLIOINTERNO=? AND USUARIO=? ORDER BY REGISTRO DESC LIMIT 20";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($nocliente, '%' . $cliente . '%', fechaConsulta($fecha), $folio,  $usuario));
}
elseif($nocliente!=""&&$cliente!=""&&$fecha!=""&&$folio!=""){
  // echo "Consulta AND de los 4; nocliente, cliente, fecha, folio";
  $consulta = "SELECT * FROM PEDIDOS_VIS WHERE NOCLIENTE=? AND CLIENTE LIKE ? AND FECHA=? AND FOLIOINTERNO=? ORDER BY REGISTRO DESC LIMIT 20";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($nocliente, '%' . $cliente . '%', fechaConsulta($fecha), $folio));
}
elseif($nocliente!=""&&$fecha!=""&&$folio!=""&&$usuario!=""){
  // echo "Consulta AND de los 4; nocliente, cliente, fecha, folioUSUARIO";
  $consulta = "SELECT * FROM PEDIDOS_VIS WHERE NOCLIENTE=? AND FECHA=? AND FOLIOINTERNO=? AND USUARIO=? ORDER BY REGISTRO DESC LIMIT 20";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($nocliente, fechaConsulta($fecha), $folio, $usuario));
}
elseif ($cliente!=""&&$fecha!=""&&$folio!=""&&$usuario!="") {
  // echo "Consulta AND de los 4; cliente, fecha, folio, folioUSUARIO";
  $consulta = "SELECT * FROM PEDIDOS_VIS WHERE CLIENTE LIKE ? AND FECHA=? AND FOLIOINTERNO=? AND USUARIO=? ORDER BY REGISTRO DESC LIMIT 20";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array('%' . $cliente . '%', fechaConsulta($fecha), $folio,  $usuario));
}
elseif ($nocliente!=""&&$cliente!=""&&$fecha!=""&&$usuario!="") {
    // echo "Consulta AND de los 4; nocliente, cliente, fecha, folioUSUARIO";
    $consulta = "SELECT * FROM PEDIDOS_VIS WHERE NOCLIENTE=? AND CLIENTE LIKE ? AND FECHA=? AND USUARIO=? ORDER BY REGISTRO DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, '%' . $cliente . '%', fechaConsulta($fecha), $usuario));
}
elseif ($nocliente!=""&&$cliente!=""&&$fecha!="") {
    // echo "Consulta AND de los 3; nocliente, cliente, fecha";
    $consulta = "SELECT * FROM PEDIDOS_VIS WHERE NOCLIENTE=? AND CLIENTE LIKE ? AND FECHA=? ORDER BY REGISTRO DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, '%' . $cliente . '%', fechaConsulta($fecha)));
}
elseif ($nocliente!=""&&$fecha!=""&&$folio!="") {
    // echo "Consulta AND de los 3; nocliente, fecha, folio";
    $consulta = "SELECT * FROM PEDIDOS_VIS WHERE NOCLIENTE=? AND FECHA=? AND FOLIOINTERNO=? ORDER BY REGISTRO DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, fechaConsulta($fecha), $folio));
}
elseif ($nocliente!=""&&$folio!=""&&$usuario!="") {
    // echo "Consulta AND de los 3; nocliente, folio, folioUSUARIO";
    $consulta = "SELECT * FROM PEDIDOS_VIS WHERE NOCLIENTE=? AND FOLIOINTERNO=? AND USUARIO=? ORDER BY REGISTRO DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $folio, $usuario));
}
elseif ($cliente!=""&&$fecha!=""&&$folio!="") {
    // echo "Consulta AND de los 3; cliente, fecha, folio";
    $consulta = "SELECT * FROM PEDIDOS_VIS WHERE NOCLIENTE=? AND FECHA=? AND FOLIOINTERNO=? ORDER BY REGISTRO DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, fechaConsulta($fecha), $folio));
}
elseif ($cliente!=""&&$folio!=""&&$usuario!="") {
    // echo "Consulta AND de los 3; cliente, folio, folioUSUARIO";
    $consulta = "SELECT * FROM PEDIDOS_VIS WHERE CLIENTE LIKE ? AND FOLIOINTERNO=? AND USUARIO=? ORDER BY REGISTRO DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array('%' . $cliente . '%', $folio, $usuario));
}
elseif ($fecha!=""&&$folio!=""&&$usuario!="") {
    // echo "Consulta AND de los 3; fecha, folio, folioUSUARIO";
    $consulta = "SELECT * FROM PEDIDOS_VIS WHERE FECHA=? AND FOLIOINTERNO=? AND USUARIO=?ORDER BY REGISTRO DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array(fechaConsulta($fecha), $folio, $usuario));
}
elseif ($folio!=""&&$nocliente!=""&&$cliente!="") {
    // echo "Consulta AND de los 3; folio, nocliente, cliente";
    $consulta = "SELECT * FROM PEDIDOS_VIS WHERE FOLIOINTERNO=? AND NOCLIENTE=? AND CLIENTE=? ORDER BY REGISTRO DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($folio, $nocliente, '%' . $cliente . '%'));
}
elseif ($nocliente!=""&&$cliente!=""&&$usuario!="") {
    // echo "Consulta AND de los 3; nocliente, cliente, folioUSUARIO";
    $consulta = "SELECT * FROM PEDIDOS_VIS WHERE NOCLIENTE=? AND CLIENTE=? AND USUARIO=? ORDER BY REGISTRO DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, '%' . $cliente . '%', $usuario));
}
elseif ($cliente!=""&&$fecha!=""&&$usuario!="") {
    // echo "Consulta AND de los 3; cliente, fecha, folioUSUARIO";
    $consulta = "SELECT * FROM PEDIDOS_VIS WHERE CLIENTE=? AND FECHA=? AND USUARIO=? ORDER BY REGISTRO DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($folio, $nocliente, $usuario));
}
elseif ($nocliente!=""&&$cliente!="") {
    // echo "Consulta AND de los 2; nocliente y cliente";
    $consulta = "SELECT * FROM PEDIDOS_VIS WHERE CLIENTE LIKE ? AND NOCLIENTE=? ORDER BY REGISTRO DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array('%' . $cliente . '%', $nocliente));
}
elseif ($nocliente!=""&&$fecha!="") {
    // echo "Consulta AND de los 2; nocliente y fecha";
    $consulta = "SELECT * FROM PEDIDOS_VIS WHERE NOCLIENTE=? AND FECHA=? ORDER BY REGISTRO DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $fecha));
}
elseif ($nocliente!=""&&$folio!="") {
    // echo "Consulta AND de los 2; nocliente y folio";
    $consulta = "SELECT * FROM PEDIDOS_VIS WHERE FOLIOINTERNO=? AND NOCLIENTE=? ORDER BY REGISTRO DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($folio, $nocliente));
}
elseif ($nocliente!=""&&$usuario!="") {
    // echo "Consulta AND de los 2; nocliente y folioUSUARIO";
    $consulta = "SELECT * FROM PEDIDOS_VIS WHERE NOCLIENTE=? AND USUARIO=? ORDER BY REGISTRO DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($nocliente, $usuario));
}
elseif ($cliente!=""&&$fecha!="") {
    // echo "Consulta AND de los 2; cliente y fecha";
    $consulta = "SELECT * FROM PEDIDOS_VIS WHERE CLIENTE LIKE ? AND FECHA=? ORDER BY REGISTRO DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array('%' . $cliente . '%', fechaConsulta($fecha)));
}
elseif ($cliente!=""&&$folio!="") {
    // echo "Consulta AND de los 2; cliente y folio";
    $consulta = "SELECT * FROM PEDIDOS_VIS WHERE CLIENTE LIKE ? AND FOLIOINTERNO=? ORDER BY REGISTRO DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array('%' . $cliente . '%', $folio));
}
elseif ($cliente!=""&&$usuario!="") {
    // echo "Consulta AND de los 2; cliente y folioUSUARIO";
    $consulta = "SELECT * FROM PEDIDOS_VIS WHERE CLIENTE LIKE ? AND USUARIO=? ORDER BY REGISTRO DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array('%' . $cliente . '%', $usuario));
}
elseif ($fecha!=""&&$folio!="") {
    // echo "Consulta AND de los 2; fecha y folio";
    $consulta = "SELECT * FROM PEDIDOS_VIS WHERE FECHA=? AND FOLIOINTERNO=? ORDER BY REGISTRO DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array(fechaConsulta($fecha), $folio));
}
elseif ($fecha!=""&&$usuario!="") {
    // echo "Consulta AND de los 2; fecha y folioUSUARIO";
    $consulta = "SELECT * FROM PEDIDOS_VIS WHERE FECHA=? AND USUARIO=? ORDER BY REGISTRO DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array(fechaConsulta($fecha), $usuario));
}
elseif ($usuario!=""&&$folio!="") {
    // echo "Consulta AND de los 2; folioUSUARIO y folio";
    $consulta = "SELECT * FROM PEDIDOS_VIS WHERE USUARIO=? AND FOLIOINTERNO=? ORDER BY REGISTRO DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($usuario, $folio));
}
elseif ($nocliente!="") {
  // echo "Consulta individual nocliente";
  $consulta = "SELECT * FROM PEDIDOS_VIS WHERE NOCLIENTE= ?  ORDER BY REGISTRO DESC LIMIT 20";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($nocliente));
}
elseif ($cliente!="") {
  // echo "Consulta individual cliente";
  $consulta = "SELECT * FROM PEDIDOS_VIS WHERE CLIENTE LIKE ?  ORDER BY REGISTRO DESC LIMIT 20";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array('%' . $cliente . '%'));
}
elseif ($fecha!="") {
  // echo "Consulta individual fecha";
  $consulta = "SELECT * FROM PEDIDOS_VIS WHERE FECHA= ?  ORDER BY REGISTRO DESC LIMIT 20";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array(fechaConsulta($fecha)));
}
elseif ($folio!="") {
  // echo "Consulta individual folio";
  $consulta = "SELECT * FROM PEDIDOS_VIS WHERE FOLIOINTERNO= ?  ORDER BY REGISTRO DESC LIMIT 20";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($folio));
}
elseif ($usuario!="") {
  // echo "Consulta individual folioUSUARIO";
  $consulta = "SELECT * FROM PEDIDOS_VIS WHERE USUARIO= ?  ORDER BY REGISTRO DESC LIMIT 20";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($usuario));
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
              <th>NO Cliente</th>
              <th>Cliente</th>
              <th>Carta Factura</th>
              <th>Total Nota</th>
              <th>Fecha</th>
              <th>Status</th>
              <th>Documentador</th>
              <th colspan="2">Info</th>
            </tr>
        </thead>
        <tbody id="table">
           <? while($registro = $resultado->fetch(PDO::FETCH_NUM)) :?>
                  <? if($registro[5]=="ASOCIADO") :?>
                        <tr>
                                <td class='principal'><input type='text' class='folio<?= $contador?>' value='<?= $registro[0]?>' readonly /></td>
                                <td class='principal'><?= $registro[6]?></td>
                                <td class='principal'><?= $registro[1]?></td>
                                <td class='principal'><?= $registro[2]?></td>
                                <td class='principal'><?= "$" . number_format($registro[3], 2, ".", ",")?></td>
                                <td class='principal'><?= fechaJquery($registro[4])?></td>
                                <td class='principal'><?= $registro[5]?></td>
                                <td class='principal'><?= $registro[8]?></td>
                                <td class='principal' colspan="2"><button class='ver' onclick="saludo(document.querySelector('.folio<?= $contador?>').value)">Ver</button></td>
                        </tr>
                   <? elseif($registro[5]=="NO ASOCIADO") :?>
                        <tr>
                                <td class='nulo'><input type='text' class='folio<?= $contador?>' value='<?= $registro[0]?>' readonly /></td>
                                <td class='nulo'><?= $registro[6]?></td>
                                <td class='nulo'><?= $registro[1]?></td>
                                <td class='nulo'><?= $registro[2]?></td>
                                <td class='nulo'><?= "$" . number_format($registro[3], 2, ".", ",")?></td>
                                <td class='nulo'><?= fechaJquery($registro[4])?></td>
                                <td class='nulo'><?= $registro[5]?></td>
                                <td class='nulo'><?= $registro[8]?></td>
                                <td class='nulo'><button class='modifica' onclick="prueba(document.querySelector('.folio<?= $contador?>').value)">!</button></td>
                                <td class='nulo'><button class='ver' onclick="saludo(document.querySelector('.folio<?= $contador?>').value)">Ver</button></td>
                        </tr>


                    <? else :?>
                       <tr>
                                <td class='cancelada'><input type='text' class='folio<?= $contador?>' value='<?= $registro[0]?>' readonly /></td>
                                <td class='cancelada'><?= $registro[6]?></td>
                                <td class='cancelada'><?= $registro[1]?></td>
                                <td class='cancelada'><?= $registro[2]?></td>
                                <td class='cancelada'><?= "$" . number_format($registro[3], 2, ".", ",")?></td>
                                <td class='cancelada'><?= fechaJquery($registro[4])?></td>
                                <td class='cancelada'><?= $registro[5]?></td>
                                <td class='cancelada'><?= $registro[8]?></td>
                                <td class='cancelada' colspan="2"><button class='ver' onclick="saludo(document.querySelector('.folio<?= $contador?>').value)">Ver</button></td>
                       </tr>
                    <? endif?>

              <? $contador++;?>
           <? endwhile?>


        </tbody>
    </table>

<? endif?>
