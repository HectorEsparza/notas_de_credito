<!DOCTYPE html>
<html>
<head>
	<title>Editar Cobranza</title>
	<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
  <script type="text/javascript" src="ajax/js/jquery-ui.js"></script>
	<script type="text/javascript" src="ajax/eventos/filtro.js"></script>
  <script type="text/javascript" src="ajax/eventos/fechas.js"></script>
	<script type="text/javascript" src="ajax/eventos/llamarFacturas.js"></script>
	<script type="text/javascript" src="ajax/eventos/agregaFila.js"></script>
	<script type="text/javascript" src="ajax/eventos/guardar.js"></script>
  <script type="text/javascript" src="ajax/eventos/eliminarFactura.js"></script>
	<!-- <script type="text/javascript" src="ajax/js/limpiaFiltro.js"></script> -->
</head>
<body>
	<?php
		session_start();
    require_once("../funciones.php");
		$usuario = $_SESSION['user'];
    $folio = $_GET['folio'];
    $factura = array();
    $metodo = array();
    $cliente = array();
    $nombre = array();
    $importe = array();
    $observacion = array();
    $eliminados = array();
    $eliminados[0] = "Hola";
    $eliminados[1] = "Amigos";
    $contador = 1;
    $total = 0;
    $base = conexion_local();
    $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, DESCUENTO, IMPORTE, METODO, OBSERVACIONES FROM CARGAS WHERE ENTRADA=?";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($folio));
    while($registro = $resultado->fetch(PDO::FETCH_NUM)){
      $factura[$contador] = $registro[0];
      $cliente[$contador] = $registro[1];
      $nombre[$contador] = $registro[2];
      $importe[$contador] = round((sub($registro[3], $registro[4]))*100)/100;
      $total += $importe[$contador];
      $metodo[$contador] = $registro[5];
      $observacion[$contador] = $registro[6];
      $contador++;
    }

	?>
  <div class="row">
    <div class="container col-md-4" style="margin-left: 500px">
      <h1>Editar Cobranza <?= $folio?></h1>
    </div>
    <div class="container col-md-2">
      <input style="margin-top: 25px" type="button" class="btn btn-primary" value="Cobranza Anterior" onclick="visualizar()" />
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
      <p><strong id="fechaDeCargas"></strong></p>
      <table border="1" width="800px" style="text-align: center">
        <tr>
          <td><strong>Factura</strong></td>
          <td><strong>Método</strong></td>
          <td><strong>Cliente</strong></td>
          <td><strong>Nombre</strong></td>
          <td><strong>Importe</strong></td>
          <td><strong>Observaciones</strong></td>
          <td><strong>Info</strong></td>
        </tr>
				<tbody id="cuerpo">
					<?php for($i=1;$i<=30;$i++):?>
						<?php if($i<$contador): ?>
						<tr id="fila<?= $i?>">
							<td id="factura<?= $i?>"><?= $factura[$i] ?></td>
							<td><?= $metodo[$i] ?></td>
							<td><?= $cliente[$i]?></td>
							<td><?= $nombre[$i]?></td>
							<td id="importe<?= $i?>"><?= "$" . $importe[$i]?></td>
							<td><?= $observacion[$i]?></td>
              <td><input type="button" class="btn btn-warning btn-sm" value="Eliminar" id="eliminar<?= $i?>" /></td>
						</tr>
					<?php else: ?>
						<tr id="fila<?= $i?>" hidden>
							<td><input type='text' id="factura<?= $i?>" style="width: 100px; height: 20px;" /></td>
							<td>
								<select id="metodo<?= $i?>" >
									<option value=""></option>
									<option value="Firma">Firma</option>
									<option value="Contado">Contado</option>
									<option value="Transferencia">Transferencia</option>
									<option value="Guía">Guía</option>
								</select>
							</td>
							<td id="cliente<?= $i?>"></td>
							<td id="nombre<?= $i?>"></td>
							<td id="importe<?= $i?>"></td>
							<td><input type='text' id="observaciones<?= $i?>" style="width: 100px; height: 20px;" /></td>
              <td><input type="button" class="btn btn-warning btn-sm" value="Eliminar" id="eliminar<?= $i?>" /></td>
						</tr>
					<?php endif ?>
					<?php endfor ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="3"><input type="button" value="Agregar" id="agregarFila" class="btn btn-info btn-sm" /></<td>
						<td><strong>Total</strong></td>
						<td id="total">$<?= $total?></td>
						<td colspan="2"><input type="button" value="Guardar" id="guardar" class="btn btn-success btn-sm" disabled/></td>
						<input type="hidden" id="indice" value="" />
						<input type="hidden" id="factura" value="" />
						<input type="hidden" id="filas" value="15" />
						<input type="hidden" id="folio" value="" />
						<input type="hidden" id="fechaCaptura" value="" />
						<input type="hidden" id="usuario" value="<?= $usuario?>" />
            <input type="hidden" id="eliminados" value="<? $eliminados?>" />
					</tr>
				</tfoot>
      </table>
    </div>
  </div>
  <script src="ajax/js/bootstrap.min.js"></script>
  <script src="ajax/js/paginator.min.js"></script>
  <script>
    function visualizar(){
        setTimeout("location.href='visualizacion.php'",500);
    }

  </script>
</body>
</html>
