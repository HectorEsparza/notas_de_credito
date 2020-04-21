<!DOCTYPE html>
<html>
<body>
<?php

  $penalizacion = $_GET['penalizacion'];
  $porcentaje = $_GET['porcentaje'];
  $porciento = $porcentaje;
  $total = explode("$", $_GET['total']);
  $total[1] = str_replace(",", "", $total[1]);
  $porcentaje = $porcentaje/100;
  $descuento = $total[1];
  $descuento = $total[1]*$porcentaje;
  $descuento = round($descuento * 100) / 100;

?>

  <table width="50%" border=1>
    <tr>
      <td>Cantidad</td>
      <td>Clave</td>
      <td style="color: red;">Cargo Total</td>
    </tr>
    <tr>
      <td>1</td>
      <td><?= "CARG " . $porciento?></td>
      <td style="color: red;"id="costoPenalizacion"><?= "-$" . number_format($penalizacion, 2, ".", ",")?></td>
    </tr>
  </table>
</body>
</html>
