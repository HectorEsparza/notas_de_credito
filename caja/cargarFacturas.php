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
    require_once("../funciones.php");
    $archivo = $_FILES['archivo']['name'];
    $ruta = $_FILES['archivo']['tmp_name'];
    $destino = "cargas\\" . $archivo;
    move_uploaded_file($ruta, $destino);
    $archivo = "cargas/".$archivo;
    $factura = array();
    $cliente = array();
    $nombre = array();
    $estatus = array();
    $fecha = array();
    $descuento = array();
    $importe = array();
    $vendedor = array();
    $contador = 0;
    require_once 'PHPExcel/Classes/PHPExcel.php';
    $inputFileType = PHPExcel_IOFactory::identify($archivo);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($archivo);
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    for ($row = 1; $row <= $highestRow; $row++){
        $factura[$contador] = $sheet->getCell("A".$row)->getValue();
        $cliente[$contador] = $sheet->getCell("B".$row)->getValue();
        $nombre[$contador] = $sheet->getCell("C".$row)->getValue();
        $estatus[$contador] = $sheet->getCell("D".$row)->getValue();
        $fecha[$contador] = $sheet->getCell("E".$row)->getValue();
        $descuento[$contador] = $sheet->getCell("F".$row)->getValue();
        $importe[$contador] = str_replace(',','',($sheet->getCell("G".$row)->getValue()));
        $vendedor[$contador] = $sheet->getCell("H".$row)->getValue();
        $contador++;
    		// echo $sheet->getCell("A".$row)->getValue()." - ";
    		// echo $sheet->getCell("B".$row)->getValue()." - ";
    		// echo $sheet->getCell("C".$row)->getValue()." - ";
        // echo $sheet->getCell("D".$row)->getValue()." - ";
        // echo $sheet->getCell("E".$row)->getValue()." - ";
        // echo $sheet->getCell("F".$row)->getValue()." - ";
        // echo $sheet->getCell("G".$row)->getValue()." - ";
        // echo $sheet->getCell("H".$row)->getValue();
    		// echo "<br>";
    }

    //echo $factura[0]." ".$cliente[0]." ".$nombre[0]." ".$estatus[0]." ".$fecha[0]." ".$descuento[0]." ".$importe[0]." ".$vendedor[0];
    //echo $archivo;
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
      <table border="1" width="900px">
        <thead>
          <tr style="font-weight: bold; text-align: center">
            <td>Clave</td>
            <td>Cliente</td>
            <td>Nombre</td>
            <td>Estatus</td>
            <td>Fecha</td>
            <td>Descuento</td>
            <td>Importe</td>
            <td>Vendedor</td>
          </tr>
        </thead>
        <tbody>
          <? if($factura[0]=="Clave"&&$cliente[0]=="Cliente"&&$nombre[0]=="Nombre"&&$estatus[0]=="Estatus"&&$fecha[0]=="Fecha"&&$descuento[0]=="Descuento"&&$importe[0]=="Importe"&&$vendedor[0]=="Vendedor") :?>
            <? for($i=1;$i<$contador;$i++): ?>
              <tr style="text-align: center;">
                <td id="factura<?= $i?>"><?= $factura[$i]?></td>
                <td id="cliente<?= $i?>"><?= $cliente[$i]?></td>
                <td id="nombre<?= $i?>"><?= $nombre[$i]?></td>
                <td id="estatus<?= $i?>"><?= $estatus[$i]?></td>
                <td id="fecha<?= $i?>"><?= $fecha[$i]?></td>
                <td id="descuento<?= $i?>"><?= $descuento[$i]?></td>
                <td id="importe<?= $i?>"><?= $importe[$i]?></td>
                <td id="vendedor<?= $i?>"><?= $vendedor[$i]?></td>
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
