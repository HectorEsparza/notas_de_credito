<!DOCTYPE html>
<html>
<head>
	<title>Visualización</title>
	<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
  <script type="text/javascript" src="ajax/js/jquery-ui.js"></script>
	<script type="text/javascript" src="ajax/eventos/guardaFacturas.js"></script>
</head>
<body>
  <?php
    include 'simplexlsx.class.php';
    require_once("../funciones.php");
    $archivo = $_FILES['archivo']['name'];
    $ruta = $_FILES['archivo']['tmp_name'];
    $destino = "cargas\\".$archivo;
    move_uploaded_file($ruta, $destino);
    $archivo = "cargas\\".$archivo;
    $xlsx = new SimpleXLSX( '' . $archivo . '' );
    $factura = array();
    $cliente = array();
    $nombre = array();
    $estatus = array();
    $fecha = array();
    $descuento = array();
    $importe = array();
    $vendedor = array();
    $contador = 0;

    //echo $archivo;
    foreach ($xlsx->rows() as $fields){
  	   $factura[$contador] = $fields[0];
  	   $cliente[$contador] = $fields[1];
  	   $nombre[$contador] = $fields[2];
  	   $estatus[$contador] = $fields[3];
       $fecha[$contador] = $fields[4];
       $importe[$contador] = $fields[5];
       $vendedor[$contador] = $fields[6];
       $descuento[$contador] = $fields[7];
       $contador++;
       // echo $fields[0] . " ";
  	   // echo $fields[1] . " ";
  	   // echo $fields[2] . " ";
  	   // echo $fields[3] . " ";
       // echo $fields[4] . " ";
       // echo $fields[5] . " ";
       // echo $fields[6] . " ";
       // echo $fields[7] . " " . "<br />";
	  }
  ?>
  <div class="row">
    <div class="container col-md-4" style="margin-left: 500px">
      <h1>Carga Facturas</h1>
    </div>
    <div class="container col-md-2">
      <input style="margin-top: 25px" type="button" class="btn btn-primary" value="Regresar" onclick="visualizar()" />
    </div>
    <div class="container col-md-2">
      <form action='../cierre.php'>
        <input style="margin-top: 25px" class="btn btn-danger" type='submit' value='Cierra Sesión' />
      </form>
    </div>
  </div>
  <br /><br />
  <div class="row">
    <div class="container col-md-12" style="margin-left: 400px">
      <table border="1" width="950px">
        <thead>
          <tr style="font-weight: bold; text-align: center">
            <td>Clave</td>
            <td>Cliente</td>
            <td>Nombre</td>
            <td>Estatus</td>
            <td>Fecha de elaboracion</td>
            <td>Importe total</td>
            <td>Nombre del vendedor</td>
            <td>Porcentaje de descuento</td>
          </tr>
        </thead>
        <tbody>
          <? if($factura[0]=="Clave "&&$cliente[0]=="Cliente "&&$nombre[0]=="Nombre "&&$estatus[0]=="Estatus "&&$fecha[0]=="Fecha de elaboracion "&&$descuento[0]=="Porcentaje de descuento "&&$importe[0]=="Importe total "&&$vendedor[0]=="Nombre del vendedor ") :?>
            <? for($i=1;$i<$contador;$i++): ?>
              <tr style="text-align: center;">
                <td id="factura<?= $i?>"><?= $factura[$i]?></td>
                <td id="cliente<?= $i?>"><?= $cliente[$i]?></td>
                <td id="nombre<?= $i?>"><?= $nombre[$i]?></td>
                <td id="estatus<?= $i?>"><?= $estatus[$i]?></td>
                <td id="fecha<?= $i?>"><?= $fecha[$i]?></td>
								<td id="importe<?= $i?>"><?= $importe[$i]?></td>
								<td id="vendedor<?= $i?>"><?= $vendedor[$i]?></td>
                <td id="descuento<?= $i?>"><?= $descuento[$i]?></td>
              </tr>
            <? endfor ?>
          <? else: ?>
            <tr style="text-align: center;">
              <td colspan="8">El archivo introducido no coinside con el formato establecido, por favor de revisar</td>
            </tr>
          <? endif ?>
        </tbody>
        <tfoot>
          <tr style="font-weight: bold; text-align: center">
            <td colspan="8"><input type="button" id="guardar" value="Guardar" class="btn btn-primary btn-sm"/></td>
          </tr>
        </tfoot>
				<input type="hidden" id="contador" value="<?= $contador?>" />
      </table>
    </div>
  </div>
  <script>
    function visualizar(){
        setTimeout("location.href='visualizacion.php'",500);
    }

  </script>
</body>
</html>
