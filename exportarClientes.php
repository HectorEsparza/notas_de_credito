<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <?php
      header("Content-Type:application/xls");
      header("Content-Disposition: attachment; filename=Clientes.xls");
      require_once("funciones.php");
      //echo "Bienvenidos a la exportacion de excel!!!"

      $base = conexion_local();
      $consulta = "SELECT CLAVE, NOMBRE FROM CLIENTES WHERE NOMBRE LIKE '%,%'";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array());

    ?>
    <table border="1">
      <tr>
        <th>Clave</th>
        <th>Nombre</th>
       </tr>
       <? while($registro = $resultado->fetch(PDO::FETCH_NUM)) :?>

                      <tr>
                              <td><?= $registro[0]?></td>
                              <td><?= $registro[1]?></td>
                      </tr>

       <? endwhile?>

    </table>
    <? $resultado->closeCursor(); ?>
  </body>
</html>
