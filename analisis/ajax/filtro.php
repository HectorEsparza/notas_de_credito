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
$idApa = $_GET['idApa'];
$idVazlo = $_GET['idVazlo'];
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

    if($idApa!=""&&$idVazlo!=""){
      // echo "Consulta AND de los 2";
      $consulta = "SELECT CLAVEDEARTÍCULO, PRECIO, ID_VAZLO, PRECIO_VAZLO FROM PRODUCTOS1 WHERE CLAVEDEARTÍCULO=? AND ID_VAZLO=? LIMIT 20";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($idApa, $idVazlo));
    }
    elseif($idApa!=""){
      // echo "Consulta idApa";
      $consulta = "SELECT CLAVEDEARTÍCULO, PRECIO, ID_VAZLO, PRECIO_VAZLO FROM PRODUCTOS1 WHERE CLAVEDEARTÍCULO=? LIMIT 20";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($idApa));
    }
    elseif($idVazlo!=""){
      // echo "Consulta idVazlo";
      $consulta = "SELECT CLAVEDEARTÍCULO, PRECIO, ID_VAZLO, PRECIO_VAZLO FROM PRODUCTOS1 WHERE ID_VAZLO=? LIMIT 20";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($idVazlo));
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

                          <?php
                              if($registro[2]==""){
                                 $registro[2]="NA";
                              }
                              if($registro[3]==""){
                                $registro[3]="NA";
                              }
                          ?>
                          <tr>
                                  <!-- <td><input type='text' class='folio value='' readonly /></td> -->
                                  <td id="folio<?= $contador?>"><?= $registro[0]?></td>
                                  <td><?= $registro[1]?></td>
                                  <td><?= $registro[2]?></td>
                                  <td><?= $registro[3]?></td>
                                  <td><input type="button" class="btn btn-info" value="Ver" onclick="ver(document.getElementById('folio<?= $contador?>').innerText)" /></td>
                          </tr>


              <? $contador++;?>
           <? endwhile?>


        </tbody>
    </table>

<? endif?>
