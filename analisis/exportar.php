<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <?php
      header("Content-Type:application/xls");
      header("Content-Disposition: attachment; filename=Productos.xls");
      require_once("../funciones.php");
      //echo "Bienvenidos a la exportacion de excel!!!"

      $base = conexion_local();
      $consulta = "SELECT * FROM PRODUCTOS1";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array());

    ?>
    <table border="1">
      <tr>
        <th>ID_APA</th>
        <th>DESCRIPCION</th>
        <th>PRECIO</th>
        <th>LINEA</th>
        <th>SUBLINEA</th>
        <th>ID_VAZLO</th>
        <th>PRECIO_VAZLO</th>
       </tr>
       <? while($registro = $resultado->fetch(PDO::FETCH_NUM)) :?>

                      <tr>
                              <td><?= $registro[0]?></td>
                              <td><?= $registro[1]?></td>
                              <td><?= $registro[2]?></td>
                              <td><?= $registro[3]?></td>
                              <td><?= $registro[4]?></td>
                              <td><?= $registro[5]?></td>
                              <td><?= $registro[6]?></td>
                      </tr>

       <? endwhile?>

    </table>
    <? $resultado->closeCursor(); ?>

  </body>
</html>
