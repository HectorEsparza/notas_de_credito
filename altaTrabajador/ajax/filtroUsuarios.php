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
    $consulta = "SELECT ID, FECHA_ALTA, DEPARTAMENTO, PUESTO, NOMBRE, STATUS FROM SOLICITUD WHERE EMPLEADO=? AND NOMBRE LIKE ? ORDER BY ID DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($empleado, '%' . $nombre . '%'));
  }
  elseif ($empleado!=""){
    //consulta individual
    $consulta = "SELECT ID, FECHA_ALTA, DEPARTAMENTO, PUESTO, NOMBRE, STATUS FROM SOLICITUD WHERE EMPLEADO=? ORDER BY ID DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($empleado));
  }
  elseif ($nombre!=""){
    //consulta individual
    $consulta = "SELECT ID, FECHA_ALTA, DEPARTAMENTO, PUESTO, NOMBRE, STATUS FROM SOLICITUD WHERE NOMBRE LIKE ? ORDER BY ID DESC LIMIT 20";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array('%' . $nombre . '%'));
  }
  else{
    echo "No introdujo ningun campo!!!";
    $flag = 1; //Está bandera me indica que no entro a ninguna consulta de la base de datos
  }
?>

<? if($flag==0) :?>

        <? while($registro = $resultado->fetch(PDO::FETCH_NUM)) :?>
            <?= $registro[5] ?>
            <? if($registro[5]=="Capturando"): ?>
              <!-- <tr><td>Capturando</td></tr> -->
              <tr class="capturando">
                <td id="folio<?= $contador?>"><?= $registro[0]?></td>
                <td><?= $registro[1] ?></td>
                <td><?= $registro[2] ?></td>
                <td><?= $registro[3] ?></td>
                <td><?= $registro[4] ?></td>
                <td><?= $registro[5] ?></td>
                <td><input type="button" value="Ver" class="ver" id="botonPrueba<?= $contador?>" onclick="saludo(document.getElementById('folio<?= $contador?>').innerText)"></td>
              </tr>
            <? elseif ($registro[5]=="Revision"): ?>
              <!-- <tr><td>Revision</td></tr> -->
              <tr class="revision">
                <td id="folio<?= $contador?>"><?= $registro[0]?></td>
                <td><?= $registro[1] ?></td>
                <td><?= $registro[2] ?></td>
                <td><?= $registro[3] ?></td>
                <td><?= $registro[4] ?></td>
                <td><?= $registro[5] ?></td>
                <td><input type="button" value="Ver" class="ver" id="botonPrueba<?= $contador?>" onclick="saludo(document.getElementById('folio<?= $contador?>').innerText)"></td>
              </tr>
            <? elseif($registro[5]=="Contratado"): ?>
              <!-- <tr><td>Contratado</td></tr> -->
              <tr class="contratado">
                <td id="folio<?= $contador?>"><?= $registro[0]?></td>
                <td><?= $registro[1] ?></td>
                <td><?= $registro[2] ?></td>
                <td><?= $registro[3] ?></td>
                <td><?= $registro[4] ?></td>
                <td><?= $registro[5] ?></td>
                <td><input type="button" value="Ver" class="ver" id="botonPrueba<?= $contador?>" onclick="saludo(document.getElementById('folio<?= $contador?>').innerText)"></td>
              </tr>
            <? elseif($registro[5]=="Aceptado"): ?>
              <!-- <tr><td>Aceptado</td></tr> -->
              <tr class="aceptado">
                <td id="folio<?= $contador?>"><?= $registro[0]?></td>
                <td><?= $registro[1] ?></td>
                <td><?= $registro[2] ?></td>
                <td><?= $registro[3] ?></td>
                <td><?= $registro[4] ?></td>
                <td><?= $registro[5] ?></td>
                <td><input type="button" value="Ver" class="ver" id="botonPrueba<?= $contador?>" onclick="saludo(document.getElementById('folio<?= $contador?>').innerText)"></td>
              </tr>
            <? elseif($registro[5]=="Rechazado"): ?>
              <!-- <tr><td>Rechazado</td></tr> -->
              <tr class="rechazado">
                <td id="folio<?= $contador?>"><?= $registro[0]?></td>
                <td><?= $registro[1] ?></td>
                <td><?= $registro[2] ?></td>
                <td><?= $registro[3] ?></td>
                <td><?= $registro[4] ?></td>
                <td><?= $registro[5] ?></td>
                <td><input type="button" value="Ver" class="ver" id="botonPrueba<?= $contador?>" onclick="saludo(document.getElementById('folio<?= $contador?>').innerText)"></td>
              </tr>
            <? elseif($registro[5]=="Faltan Documentos"): ?>
              <!-- <tr><td>Faltan Documentos</td></tr> -->
              <tr class="faltanDocumentos">
                <td id="folio<?= $contador?>"><?= $registro[0]?></td>
                <td><?= $registro[1] ?></td>
                <td><?= $registro[2] ?></td>
                <td><?= $registro[3] ?></td>
                <td><?= $registro[4] ?></td>
                <td><?= $registro[5] ?></td>
                <td><input type="button" value="Ver" class="ver" id="botonPrueba<?= $contador?>" onclick="saludo(document.getElementById('folio<?= $contador?>').innerText)"></td>
              </tr>
            <? else :?>
              <tr><td>No hay coincidencia</td></tr>
            <? endif ?>
            <? $contador++; ?>
        <? endwhile?>




<? endif?>
