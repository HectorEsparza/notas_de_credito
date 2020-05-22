<!DOCTYPE html>
<html>
<head>
	<title>Nueva Cobranza</title>
	<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
  <script type="text/javascript" src="ajax/js/jquery-ui.js"></script>
  <script type="text/javascript" src="ajax/eventos/fechas.js"></script>
	<script type="text/javascript" src="ajax/eventos/llamarFacturas.js"></script>
	<script type="text/javascript" src="ajax/eventos/agregaFila.js"></script>
	<script type="text/javascript" src="ajax/eventos/guardar.js"></script>
	<script type="text/javascript" src="../js/verificarSesion.js"></script>
	<script type="text/javascript" src="../js/cierreSesion.js"></script>
	<script type="text/javascript" src="../js/cierreInactividad.js"></script>
  <script type="text/javascript" src="../js/visualizacion.js"></script>
  
</head>
<body>
  <div class="row">
    <input type="hidden" id="tipo" value="remisiones" />
    <div class="container col-md-4" style="margin-left: 500px">
      <h1>Captura Nuevo Contado</h1>
    </div>
    <div class="container col-md-2">
      <input style="margin-top: 25px" type="button" class="btn btn-primary" value="Contado Anterior" id="visualizacion" />
    </div>
    <div class="container col-md-2">
      <input  style="margin-top: 25px" class="btn btn-danger" type='button' id="cierreSesion" value='Cierra Sesión' />
    </div>
  </div>
  <br /><br />
  <div class="row">
    <div class="container col-md-12" style="margin-left: 500px">
      <h4>Selecciona una Fecha</h4>
      <input type="text" id="fecha" style="float: left"/>
      <input style="margin-left: 25px" class="btn btn-warning" type="button" value="Borrar" id="borraFecha"/>
    </div>
  </div>
  <br /><br />
  <div class="row d-flex justify-content-center">
    <div class="container">
      <div class="col-md-12">
        <h3>Remisiones</h3>
        <p><strong id="fechaDeCargas"></strong></p>
        <table class="table table-hover table-sm table-responsive text-center">
            <thead>
              <tr>
                <th>Remisión</th>
                <th>Cliente</th>
                <th>Nombre</th>
                <th>Importe</th>
                <th>Caja/Bolsas</th>
                <th>Peso(Kg)</th>
                <th>Recibe</th>
                <th>Observaciones</th>
              </tr>
            </thead>
            <tbody id="cuerpo">
            <?php for($i=1;$i<=100;$i++):?>
              <?php if($i<=15): ?>
                <tr>
                  <td><input type='text' class="factura" id="factura<?= $i?>" style="width: 100px; height: 20px;" readonly/></td>
                  <td id="cliente<?= $i?>"></td>
                  <td id="nombre<?= $i?>"></td>
                  <td id="importe<?= $i?>"></td>
                  <td><input type='number' id="cajas<?= $i?>"  style="width: 100px; height: 20px;" readonly/></td>
                  <td><input type='number' id="peso<?= $i?>" style="width: 100px; height: 20px;" step="any" readonly/></td>
                  <td><input type='text' id="recibe<?= $i?>" style="width: 100px; height: 20px;" readonly/></td>
                  <td><input type='text' id="observaciones<?= $i?>" style="width: 100px; height: 20px;" readonly/></td>
                </tr>
              <?php else: ?>
                <tr id="fila<?= $i?>" class="fila">
                  <td><input type='text' class="factura" id="factura<?= $i?>" style="width: 100px; height: 20px;" readonly/></td>
                  <td id="cliente<?= $i?>"></td>
                  <td id="nombre<?= $i?>"></td>
                  <td id="importe<?= $i?>"></td>
                  <td><input type='number' id="cajas<?= $i?>"  style="width: 100px; height: 20px;" readonly/></td>
                  <td><input type='number' id="peso<?= $i?>" style="width: 100px; height: 20px;" step="any" readonly/></td>
                  <td><input type='text' id="recibe<?= $i?>" style="width: 100px; height: 20px;" readonly/></td>
                  <td><input type='text' id="observaciones<?= $i?>" style="width: 100px; height: 20px;" readonly/></td>
                </tr>
              <?php endif ?>
            <?php endfor ?>
            </tbody>
          <tfoot>
            <tr>
              <td colspan="2"><input type="button" value="Agregar" id="agregarFila" class="btn btn-info btn-sm" /></<td>
              <td><strong>Total</strong></td>
              <td id="total">$0</td>
              <td><input type="button" value="Guardar" id="guardar" class="btn btn-success btn-sm" disabled/></td>
              <input type="hidden" id="indice" value="" />
              <input type="hidden" id="factura" value="" />
              <input type="hidden" id="filas" value="15" />
              <input type="hidden" id="folio" value="" />
              <input type="hidden" id="fechaCaptura" value="" />
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
