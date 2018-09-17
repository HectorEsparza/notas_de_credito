<!DOCTYPE html>
<html>
<body>
<?php

  $cantidad = $_GET['cantidad'];


?>

  <table width="50%" border=1>
    <tr>
      <td>Cantidad</td>
      <td>Clave</td>
      <td>Cargo</td>
    </tr>
    <tr>
      <td>1</td>
      <td>Flete</td>
      <td><?= "$" . number_format($cantidad, 2, ".", ",") ?></td>
    </tr>
  </table>
</body>
</html>
