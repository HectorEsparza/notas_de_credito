<!DOCTYPE html>
<html>
<head>
	<title>Nueva Cobranza</title>
	<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
  <script type="text/javascript" src="ajax/js/jquery-ui.js"></script>
	<script type="text/javascript" src="ajax/eventos/filtro.js"></script>
	<script type="text/javascript" src="ajax/eventos/llamarFacturas.js"></script>
	<script type="text/javascript" src="ajax/eventos/agregaFila.js"></script>
	<script type="text/javascript" src="ajax/eventos/agregarFacturaRemision.js"></script>
	<!-- <script type="text/javascript" src="ajax/js/limpiaFiltro.js"></script> -->
</head>
<body>
	<?php
		session_start();
		$usuario = $_SESSION['user'];
    if(!isset($usuario))
		{
			header("location:../index.html");
		}
		require_once("../funciones.php");
    $folio = $_GET['folio'];
		$base = conexion_local();
		$consulta="SELECT FECHA_ENTRADA FROM CARGAS WHERE ENTRADA=?";
		$resultado = $base->prepare($consulta);
		$resultado-> execute(array($folio));
		$registro = $resultado->fetch(PDO::FETCH_NUM);
		$fecha = $registro[0];
    $resultado->closeCursor();

    $consulta="SELECT DEPARTAMENTO FROM USUARIOS WHERE USUARIO=?";
    $resultado = $base->prepare($consulta);
    $resultado-> execute(array($usuario));
    $registro = $resultado->fetch(PDO::FETCH_NUM);
    $departamento = $registro[0];
    $resultado->closeCursor();

    $base = null;
    if($folio[0]=="F"){
      $tipo = "facturas";
    }
    else{
      $tipo = "remisiones";
    }
	?>
  <div class="row">
    <input type="hidden" id="folio" value="<?= $folio?>">
		<input type="hidden" id="fecha" value="<?= $fecha?>">
		<input type="hidden" id="tipo" value="<?= $tipo ?>" />
    <input type="hidden" id="departamento" value="<?= $departamento?>">
    <div class="container col-md-4" style="margin-left: 500px">
      <h1>Agrega Facturas/Remisiones a la Cobranza</h1>
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
			<h3>Facturas</h3>
      <p><strong id="fechaDeCargas"></strong></p>
      <table border="1" width="800px" style="text-align: center">
        <tr>
          <td><strong>Factura</strong></td>
          <td><strong>Método</strong></td>
          <td><strong>Cliente</strong></td>
          <td><strong>Nombre</strong></td>
          <td><strong>Importe</strong></td>
          <td><strong>Observaciones</strong></td>
        </tr>
				<tbody id="cuerpo">
					<?php for($i=1;$i<=100;$i++):?>
						<?php if($i<=15): ?>
						<tr>
							<td><input type='text' id="factura<?= $i?>" style="width: 100px; height: 20px;" readonly/></td>
							<td>
								<select id="metodo<?= $i?>" disabled>
									<option value=""></option>
									<option value="Firma">Firma</option>
									<option value="Ficha Deposito">Ficha Deposito</option>
									<option value="Transferencia">Transferencia</option>
									<option value="Guía">Guía</option>
									<option value="Contra Recibo">Contra Recibo</option>
									<option value="Cheque">Cheque</option>
									<option value="Sello y Firma">Sello y Firma</option>
								</select>
							</td>
							<td id="cliente<?= $i?>"></td>
							<td id="nombre<?= $i?>"></td>
							<td id="importe<?= $i?>"></td>
							<td><input type='text' id="observaciones<?= $i?>" style="width: 100px; height: 20px;" readonly/></td>
						</tr>
					<?php else: ?>
						<tr id="fila<?= $i?>" hidden>
							<td><input type='text' id="factura<?= $i?>" style="width: 100px; height: 20px;" readonly/></td>
							<td>
								<select id="metodo<?= $i?>" disabled>
									<option value=""></option>
									<option value="Firma">Firma</option>
									<option value="Contado">Contado</option>
									<option value="Transferencia">Transferencia</option>
									<option value="Guía">Guía</option>
									<option value="Contra Recibo">Contra Recibo</option>
									<option value="Cheque">Cheque</option>
									<option value="Sello y Firma">Sello y Firma</option>
								</select>
							</td>
							<td id="cliente<?= $i?>"></td>
							<td id="nombre<?= $i?>"></td>
							<td id="importe<?= $i?>"></td>
							<td><input type='text' id="observaciones<?= $i?>" style="width: 100px; height: 20px;" readonly/></td>
						</tr>
					<?php endif ?>
					<?php endfor ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="3"><input type="button" value="Agregar" id="agregarFila" class="btn btn-info btn-sm" /></<td>
						<td><strong>Total</strong></td>
						<td id="total">$0</td>
						<td><input type="button" value="Guardar" id="guardar" class="btn btn-success btn-sm" disabled/></td>
						<input type="hidden" id="indice" value="" />
						<input type="hidden" id="factura" value="" />
						<input type="hidden" id="filas" value="15" />
						<input type="hidden" id="folio" value="" />
						<input type="hidden" id="fechaCaptura" value="" />
						<input type="hidden" id="usuario" value="<?= $usuario?>" />
					</tr>
				</tfoot>
      </table>
    </div>
  </div>
  <script src="ajax/js/bootstrap.min.js"></script>
  <script src="ajax/js/paginator.min.js"></script>
  <script>
    function visualizar(){
        setTimeout("location.href='impresion.php?folio="+$('#folio').val()+"'",500);
    }

	var fecha = $("#fecha").val();
    fecha = fecha.split("-");
    function diaSemana(dia,mes,anio,mesEspanol){
        var dias=["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
        let meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        var dt = new Date(mes+' '+dia+', '+anio+' 12:00:00');
        document.getElementById('fechaDeCargas').innerHTML = "Reporte de Cobranza "+dias[dt.getUTCDay()]+" "+dia+" de "+meses[mesEspanol]+" "+anio+" "+$('#folio').val();
        //Guardamos la fecha de carga
        $("#fechaCaptura").val($("#fecha").val());
        //Guardamos el folio de carga
        //console.log(datos[0]);
    };

    let meses = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var dia = fecha[2];
    var mes = meses[parseInt(fecha[1])-1];
    var anio= fecha[0];
    var mesEspanol = parseInt(fecha[1])-1;
    diaSemana(dia, mes,anio,mesEspanol);

    $("#factura1").prop("readonly", false);
    $("#metodo1").prop("disabled", false);
    $("#observaciones1").prop("readonly", false);

  </script>
</body>
</html>
