<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <?php
      header("Content-Type:application/xls");
      header("Content-Disposition: attachment; filename=FacturasSinEntrada.xls");
      require_once("../funciones.php");
      //echo "Bienvenidos a la exportacion de excel!!!"

      $base = conexion_local();
      $consulta = "SELECT * FROM CARGAS WHERE (ESTATUS=? OR ESTATUS=?) AND ENTRADA=?";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array('Emitida', 'Original', ''));

    ?>
    <table border="1">
      <tr>
        <th>Clave</th>
        <th>Cliente</th>
        <th>Nombre</th>
        <th>Estatus</th>
        <th>Fecha de Elaboracion</th>
        <th>Descuento</th>
        <th>Importe Total</th>
        <th>Nombre del Vendedor</th>
        <th>Metodo</th>
        <th>Observacion</th>
        <th>Entrada</th>
        <th>Fecha de Entrada</th>
        <th>Numero de Entrada</th>
       </tr>
       <? while($registro = $resultado->fetch(PDO::FETCH_ASSOC)) :?>

                      <tr>
                              <td><?= $registro["CLAVE"]?></td>
                              <td><?= $registro["CLIENTE"]?></td>
                              <td><?= $registro["NOMBRE"]?></td>
                              <td><?= $registro["ESTATUS"]?></td>
                              <td><?= $registro["FECHA"]?></td>
                              <td><?= $registro["DESCUENTO"]?></td>
                              <td><?= $registro["IMPORTE"]?></td>
                              <td><?= $registro["VENDEDOR"]?></td>
                              <td><?= $registro["METODO"]?></td>
                              <td><?= $registro["OBSERVACIONES"]?></td>
                              <td><?= $registro["ENTRADA"]?></td>
                              <td><?= $registro["FECHA_ENTRADA"]?></td>
                              <td><?= $registro["NUMERO_ENTRADA"]?></td>
                      </tr>

       <? endwhile?>

    </table>
    <? $resultado->closeCursor(); ?>
  </body>
</html>
