<?php

$clave = $_POST['clave'];
$i = $_POST['indice'];
$usuario = $_POST['usuario'];
require_once("../../funciones.php");

/*
echo $clave . "<br />";
echo $indice . "<br />";
echo "Hola " . $usuario . "<br />";
*/
try
{
  $base = conexion_local();
  $consulta1 = "SELECT PRECIO FROM PRODUCTOS1 WHERE CLAVEDEARTÍCULO=?";
  $resultado1 = $base->prepare($consulta1);
  $resultado1->execute(array($clave));
  $registro1 = $resultado1->fetch(PDO::FETCH_NUM);
  $consulta2 = "SELECT PRECIO FROM PRODUCTOS2 WHERE CLAVEDEARTÍCULO=?";
  $resultado2 = $base->prepare($consulta2);
  $resultado2->execute(array($clave));
  $registro2 = $resultado2->fetch(PDO::FETCH_NUM);
  $consulta3 = "SELECT PRECIO FROM PRODUCTOS3 WHERE CLAVEDEARTÍCULO=?";
  $resultado3 = $base->prepare($consulta3);
  $resultado3->execute(array($clave));
  $registro3 = $resultado3->fetch(PDO::FETCH_NUM);
  $consulta4 = "SELECT PRECIO FROM PRODUCTOS4 WHERE CLAVEDEARTÍCULO=?";
  $resultado4 = $base->prepare($consulta4);
  $resultado4->execute(array($clave));
  $registro4 = $resultado4->fetch(PDO::FETCH_NUM);
  if($registro1[0]==null)
  {
    $registro1[0]=0;
  }
  if($registro2[0]==null)
  {
    $registro2[0]=0;
  }
  if ($registro3[0]==null)
  {
    $registro3[0]=0;
  }
  if ($registro4[0]==null)
  {
    $registro4[0]=0;
  }

  ?>
  <input type="hidden" id='user' value=<?= $user?> />
  <!--Formato HTML-->

  <table  border=1 width="90%">
           <tr>
             <th colspan=3>Producto: <?= $clave?></th>
           </tr>
           <tr>
             <td>Lista de Precios</td>
             <td>Precio</td>
             <td>Seleccionar</td>
           </tr>
           <tr>
             <td>Actual</td>
             <td id='1'><?= "$" . $registro1[0]?></td>
             <td>
               <button class='boton' onclick="nvo_costo(document.getElementById('1').innerText,
               document.getElementById('indice').value, document.getElementById('lista1').value, document.getElementById('user').value);
               nvo_importe(document.getElementById('1').innerText, document.querySelector('.cantidad<?= $i?>').value, <?= $i?>);
               nvo_subtotal(document.getElementById('1').innerText, document.getElementById('descuento').innerText, document.querySelector('.cantidad<?= $i?>').value, <?= $i?>);
               limpiar();">OK</button>
             <input id='indice' type="hidden"  value="<?= $i?>" />
             <input id='lista1' type="hidden" value="PRODUCTOS1" />
             </td>
           </tr>
           <tr>
             <td>Lista ante al 18/03/18</td>
             <td id='2'><?= "$" . $registro2[0]?></td>
             <td><button class='boton' onclick="nvo_costo(document.getElementById('2').innerText,
             document.getElementById('indice').value, document.getElementById('lista2').value, document.getElementById('user').value);
             nvo_importe(document.getElementById('2').innerText, document.querySelector('.cantidad<?= $i?>').value, <?= $i?>);
             nvo_subtotal(document.getElementById('2').innerText, document.getElementById('descuento').innerText, document.querySelector('.cantidad<?= $i?>').value, <?= $i?>);
             limpiar();">OK</button>
             <input id='indice' type="hidden"  value="<?= $i?>" />
             <input id='lista2' type="hidden" value="PRODUCTOS2" />
             </td>
           </tr>
           <tr>
             <td>Lista ante al 01/01/17</td>
             <td id='3'><?= "$" . $registro3[0]?></td>
             <td><button class='boton' onclick="nvo_costo(document.getElementById('3').innerText,
             document.getElementById('indice').value, document.getElementById('lista3').value, document.getElementById('user').value);
             nvo_importe(document.getElementById('3').innerText, document.querySelector('.cantidad<?= $i?>').value, <?= $i?>);
             nvo_subtotal(document.getElementById('3').innerText, document.getElementById('descuento').innerText, document.querySelector('.cantidad<?= $i?>').value, <?= $i?>);
             limpiar();">OK</button>
             <input id='indice' type="hidden"  value="<?= $i?>" />
             <input id='lista3' type="hidden" value="PRODUCTOS3" />
             </td>
           </tr>
           <tr>
             <td>Lista ante al 14/09/16</td>
             <td id='4'><?= "$" . $registro4[0]?></td>
             <td><button class='boton' onclick="nvo_costo(document.getElementById('4').innerText,
             document.getElementById('indice').value, document.getElementById('lista4').value, document.getElementById('user').value);
             nvo_importe(document.getElementById('4').innerText, document.querySelector('.cantidad<?= $i?>').value, <?= $i?>);
             nvo_subtotal(document.getElementById('4').innerText, document.getElementById('descuento').innerText, document.querySelector('.cantidad<?= $i?>').value, <?= $i?>);
             limpiar();">OK</button>
             <input id='indice' type="hidden"  value="<?= $i?>" />
             <input id='lista4' type="hidden" value="PRODUCTOS4" />
             </td>
           </tr>
        </table>





<?php
//echo "<br />" . $i;
}
catch (Exception $e)
{
  die("<h1>ERROR: " . $e->GetMessage() . "</h1>");
}
finally
{
  $base = null;
}
?>
