<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <?php
      header("Content-Type:application/xls");
      header("Content-Disposition: attachment; filename=Facturas.xls");
      require_once("../funciones.php");
      //echo "Bienvenidos a la exportacion de excel!!!"

      $base = conexion_local();
      $consulta = "SELECT * FROM EXPORTAR_FACTURAS";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array());

    ?>
    <table border="1">
      <tr>
        <th>Clave</th>
        <th>Cliente</th>
        <th>Nombre</th>
        <th>Estatus</th>
        <th>Fecha de Elaboracion</th>
        <th>Importe Total</th>
        <th>Nombre del Vendedor</th>
        <th>Porcentaje de Descuento</th>
       </tr>
       <? while($registro = $resultado->fetch(PDO::FETCH_NUM)) :?>

                      <tr>
                              <td><?= $registro[0]?></td>
                              <td><?= $registro[1]?></td>
                              <td><?= $registro[2]?></td>
                              <td><?= $registro[3]?></td>
                              <td><?= $registro[4]?></td>
                              <td><?= $registro[6]?></td>
                              <td><?= $registro[7]?></td>
                              <td><?= $registro[5]?></td>
                      </tr>

       <? endwhile?>

    </table>
    <? $resultado->closeCursor(); ?>
  </body>
</html>
