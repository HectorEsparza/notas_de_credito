<?php
  require_once("../../funciones.php");
  $empleado = $_GET['empleado'];
  $nombre = $_GET['nombre'];
  $flag = 0;
  $contador = 1;

  //echo "Empleado " . $empleado . " y Nombre " . $nombre;
  $base = conexion_local();

  if($empleado!=""&&$nombre!=""){
    //consulta and de los 2
    $consulta = "SELECT ID, EMPLEADO, NOMBRE, CURP, RFC, SEGURO, SALARIO, SEMANAL,
    																DEPARTAMENTO, PUESTO, FECHA_ALTA, BANCOMER, SIVALE, CALLE, COLONIA, CP, POBLACION, NACIMIENTO,
    																TELEFONO, EMERGENCIA, PERSONA, CORREO, EDO_CIVIL, SEXO,
    															  STATUS FROM SOLICITUD WHERE EMPLEADO=? AND NOMBRE LIKE ? ORDER BY ID DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($empleado, '%' . $nombre . '%'));
  }
  elseif ($empleado!=""){
    //consulta individual
    $consulta = "SELECT ID, EMPLEADO, NOMBRE, CURP, RFC, SEGURO, SALARIO, SEMANAL,
    																DEPARTAMENTO, PUESTO, FECHA_ALTA, BANCOMER, SIVALE, CALLE, COLONIA, CP, POBLACION, NACIMIENTO,
    																TELEFONO, EMERGENCIA, PERSONA, CORREO, EDO_CIVIL, SEXO,
    															  STATUS FROM SOLICITUD WHERE EMPLEADO=? ORDER BY ID DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($empleado));
  }
  elseif ($nombre!=""){
    //consulta individual
    $consulta = "SELECT ID, EMPLEADO, NOMBRE, CURP, RFC, SEGURO, SALARIO, SEMANAL,
    																DEPARTAMENTO, PUESTO, FECHA_ALTA, BANCOMER, SIVALE, CALLE, COLONIA, CP, POBLACION, NACIMIENTO,
    																TELEFONO, EMERGENCIA, PERSONA, CORREO, EDO_CIVIL, SEXO,
    															  STATUS FROM SOLICITUD WHERE NOMBRE LIKE ? ORDER BY ID DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array('%' . $nombre . '%'));
  }
  else{
    echo "No introdujo ningun campo!!!";
    $flag = 1; //Está bandera me indica que no entro a ninguna consulta de la base de datos
  }
   // if($flag==0){
   //
   //   echo "<tr><td>Capturando</td></tr>
   //         <tr><td>Revision</td></tr>";
   // }
?>
<? if($flag==0) :?>

        <? while($registro = $resultado->fetch(PDO::FETCH_NUM)) :?>
            <?= $registro[24] ?>
            <? if($registro[24]=="Faltan Datos"): ?>
              <!-- <tr><td>Faltan Datos</td></tr> -->
              <tr class="faltanDatos">
                <td id="folio<?= $contador?>"><?= $registro[0]?></td>
                <td><?= $registro[1] ?></td>
                <td><?= $registro[2] ?></td>
                <td><?= $registro[3] ?></td>
                <td><?= $registro[4] ?></td>
                <td><?= $registro[5] ?></td>
                <td><?= $registro[6] ?></td>
                <td><?= $registro[7] ?></td>
                <td><?= $registro[8] ?></td>
                <td><?= $registro[9] ?></td>
                <td><?= $registro[10] ?></td>
                <td><?= $registro[11] ?></td>
                <td><?= $registro[12] ?></td>
                <td><?= $registro[13] ?></td>
                <td><?= $registro[14] ?></td>
                <td><?= $registro[15] ?></td>
                <td><?= $registro[16] ?></td>
                <td><?= $registro[17] ?></td>
                <td><?= $registro[18] ?></td>
                <td><?= $registro[19] ?></td>
                <td><?= $registro[20] ?></td>
                <td><?= $registro[21] ?></td>
                <td><?= $registro[22] ?></td>
                <td><?= $registro[23] ?></td>
                <td><?= $registro[24] ?></td>
                <td><input type="button" value="Ver" class="ver" id="botonPrueba<?= $contador?>" onclick="saludo(document.getElementById('folio<?= $contador?>').innerText)"></td>
              </tr>
            <? elseif ($registro[24]=="Revision"): ?>
              <!-- <tr><td>Revision</td></tr> -->
              <tr class="revision">
                <td id="folio<?= $contador?>"><?= $registro[0]?></td>
                <td><?= $registro[1] ?></td>
                <td><?= $registro[2] ?></td>
                <td><?= $registro[3] ?></td>
                <td><?= $registro[4] ?></td>
                <td><?= $registro[5] ?></td>
                <td><?= $registro[6] ?></td>
                <td><?= $registro[7] ?></td>
                <td><?= $registro[8] ?></td>
                <td><?= $registro[9] ?></td>
                <td><?= $registro[10] ?></td>
                <td><?= $registro[11] ?></td>
                <td><?= $registro[12] ?></td>
                <td><?= $registro[13] ?></td>
                <td><?= $registro[14] ?></td>
                <td><?= $registro[15] ?></td>
                <td><?= $registro[16] ?></td>
                <td><?= $registro[17] ?></td>
                <td><?= $registro[18] ?></td>
                <td><?= $registro[19] ?></td>
                <td><?= $registro[20] ?></td>
                <td><?= $registro[21] ?></td>
                <td><?= $registro[22] ?></td>
                <td><?= $registro[23] ?></td>
                <td><?= $registro[24] ?></td>
                <td><input type="button" value="Ver" class="ver" id="botonPrueba<?= $contador?>" onclick="saludo(document.getElementById('folio<?= $contador?>').innerText)"></td>
              </tr>
            <? elseif($registro[24]=="Contratado"): ?>
              <!-- <tr><td>Contratado</td></tr> -->
              <tr class="contratado">
                <td id="folio<?= $contador?>"><?= $registro[0]?></td>
                <td><?= $registro[1] ?></td>
                <td><?= $registro[2] ?></td>
                <td><?= $registro[3] ?></td>
                <td><?= $registro[4] ?></td>
                <td><?= $registro[5] ?></td>
                <td><?= $registro[6] ?></td>
                <td><?= $registro[7] ?></td>
                <td><?= $registro[8] ?></td>
                <td><?= $registro[9] ?></td>
                <td><?= $registro[10] ?></td>
                <td><?= $registro[11] ?></td>
                <td><?= $registro[12] ?></td>
                <td><?= $registro[13] ?></td>
                <td><?= $registro[14] ?></td>
                <td><?= $registro[15] ?></td>
                <td><?= $registro[16] ?></td>
                <td><?= $registro[17] ?></td>
                <td><?= $registro[18] ?></td>
                <td><?= $registro[19] ?></td>
                <td><?= $registro[20] ?></td>
                <td><?= $registro[21] ?></td>
                <td><?= $registro[22] ?></td>
                <td><?= $registro[23] ?></td>
                <td><?= $registro[24] ?></td>
                <td><input type="button" value="Ver" class="ver" id="botonPrueba<?= $contador?>" onclick="saludo(document.getElementById('folio<?= $contador?>').innerText)"></td>
              </tr>
            <? elseif($registro[24]=="Aceptado"): ?>
              <!-- <tr><td>Aceptado</td></tr> -->
              <tr class="aceptado">
                <td id="folio<?= $contador?>"><?= $registro[0]?></td>
                <td><?= $registro[1] ?></td>
                <td><?= $registro[2] ?></td>
                <td><?= $registro[3] ?></td>
                <td><?= $registro[4] ?></td>
                <td><?= $registro[5] ?></td>
                <td><?= $registro[6] ?></td>
                <td><?= $registro[7] ?></td>
                <td><?= $registro[8] ?></td>
                <td><?= $registro[9] ?></td>
                <td><?= $registro[10] ?></td>
                <td><?= $registro[11] ?></td>
                <td><?= $registro[12] ?></td>
                <td><?= $registro[13] ?></td>
                <td><?= $registro[14] ?></td>
                <td><?= $registro[15] ?></td>
                <td><?= $registro[16] ?></td>
                <td><?= $registro[17] ?></td>
                <td><?= $registro[18] ?></td>
                <td><?= $registro[19] ?></td>
                <td><?= $registro[20] ?></td>
                <td><?= $registro[21] ?></td>
                <td><?= $registro[22] ?></td>
                <td><?= $registro[23] ?></td>
                <td><?= $registro[24] ?></td>
                <td><input type="button" value="Ver" class="ver" id="botonPrueba<?= $contador?>" onclick="saludo(document.getElementById('folio<?= $contador?>').innerText)"></td>
              </tr>
            <? elseif($registro[24]=="Rechazado"): ?>
              <!-- <tr><td>Rechazado</td></tr> -->
              <tr class="rechazado">
                <td id="folio<?= $contador?>"><?= $registro[0]?></td>
                <td><?= $registro[1] ?></td>
                <td><?= $registro[2] ?></td>
                <td><?= $registro[3] ?></td>
                <td><?= $registro[4] ?></td>
                <td><?= $registro[5] ?></td>
                <td><?= $registro[6] ?></td>
                <td><?= $registro[7] ?></td>
                <td><?= $registro[8] ?></td>
                <td><?= $registro[9] ?></td>
                <td><?= $registro[10] ?></td>
                <td><?= $registro[11] ?></td>
                <td><?= $registro[12] ?></td>
                <td><?= $registro[13] ?></td>
                <td><?= $registro[14] ?></td>
                <td><?= $registro[15] ?></td>
                <td><?= $registro[16] ?></td>
                <td><?= $registro[17] ?></td>
                <td><?= $registro[18] ?></td>
                <td><?= $registro[19] ?></td>
                <td><?= $registro[20] ?></td>
                <td><?= $registro[21] ?></td>
                <td><?= $registro[22] ?></td>
                <td><?= $registro[23] ?></td>
                <td><?= $registro[24] ?></td>
                <td><input type="button" value="Ver" class="ver" id="botonPrueba<?= $contador?>" onclick="saludo(document.getElementById('folio<?= $contador?>').innerText)"></td>
              </tr>
            <? elseif($registro[24]=="Faltan Documentos"): ?>
              <!-- <tr><td>Faltan Documentos</td></tr> -->
              <tr class="faltanDocumentos">
                <td id="folio<?= $contador?>"><?= $registro[0]?></td>
                <td><?= $registro[1] ?></td>
                <td><?= $registro[2] ?></td>
                <td><?= $registro[3] ?></td>
                <td><?= $registro[4] ?></td>
                <td><?= $registro[5] ?></td>
                <td><?= $registro[6] ?></td>
                <td><?= $registro[7] ?></td>
                <td><?= $registro[8] ?></td>
                <td><?= $registro[9] ?></td>
                <td><?= $registro[10] ?></td>
                <td><?= $registro[11] ?></td>
                <td><?= $registro[12] ?></td>
                <td><?= $registro[13] ?></td>
                <td><?= $registro[14] ?></td>
                <td><?= $registro[15] ?></td>
                <td><?= $registro[16] ?></td>
                <td><?= $registro[17] ?></td>
                <td><?= $registro[18] ?></td>
                <td><?= $registro[19] ?></td>
                <td><?= $registro[20] ?></td>
                <td><?= $registro[21] ?></td>
                <td><?= $registro[22] ?></td>
                <td><?= $registro[23] ?></td>
                <td><?= $registro[24] ?></td>
                <td><input type="button" value="Ver" class="ver" id="botonPrueba<?= $contador?>" onclick="saludo(document.getElementById('folio<?= $contador?>').innerText)"></td>
              </tr>
            <? else :?>
              <tr><td>No hay coincidencia</td></tr>
            <? endif ?>
            <? $contador++; ?>
        <? endwhile?>




<? endif?>
