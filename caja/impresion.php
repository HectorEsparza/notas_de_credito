<!DOCTYPE html>
<html>
  <head>
  	<title>Impresión</title>
    <meta charset="utf-8" />
  	<link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
  	<link href="css/bootstrap.min.css" rel="stylesheet">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
    <script type="text/javascript" src="ajax/js/jquery-ui.js"></script>
    <script type="text/javascript" src="ajax/eventos/agregaFila.js"></script>
  </head>
  <body>
    <?php
      session_start();
      $usuario = $_SESSION['user'];
      require_once("../funciones.php");
      $folio = $_GET['folio'];
      $facturas = array();
      $cliente = array();
      $nombre = array();
      $descuento = array();
      $importe = array();
      $metodos = array();
      $observaciones = array();
      $total = 0;
      $contador = 0;
      $base = conexion_local();
      $consulta = "SELECT FECHA FROM CAJA WHERE CLAVE=?";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($folio));
      $registro = $resultado->fetch(PDO::FETCH_NUM);
      $fecha = fechaStandar($registro[0]);
      $resultado->closeCursor();
      $consulta = "SELECT CLAVE, CLIENTE, NOMBRE, DESCUENTO, IMPORTE, METODO, OBSERVACIONES FROM CARGAS WHERE ENTRADA=? ORDER BY NUMERO_ENTRADA ASC";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($folio));
      while ($registro = $resultado->fetch(PDO::FETCH_NUM)){
        $facturas[$contador] = $registro[0];
        $cliente[$contador] = $registro[1];
        $nombre[$contador] = $registro[2];
        $descuento[$contador] = $registro[3];
        $importe[$contador] = $registro[4];
        //$importe[$contador] = sub($descuento[$contador], $importe[$contador]);
        $total += $importe[$contador];
        $metodos[$contador] = $registro[5];
        $observaciones[$contador] = $registro[6];
        $contador++;
      }
      $resultado->closeCursor();

      $consulta = "SELECT DEPARTAMENTO FROM USUARIOS WHERE USUARIO=?";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($usuario));
      $departamento = $resultado->fetch(PDO::FETCH_NUM);
      $departamento = $departamento[0];
      $resultado->closeCursor();
      $base = null;
    ?>
        <div class="col-md-8">
          <p style="font-weight: bold;"><img src="imagenes/apa.jpg" />
            <?php echo saber_dia($fecha)." ".$folio?>
            <input type="hidden" id="folio" value="<?= $folio?>" />
            <input type="hidden" id="departamento" value="<?= $departamento?>" />
            <input type="button" class="btn btn-primary btn-sm" value="Imprimir" id="impresion" style="margin-left: 30px;"/>
            <input type="button" class="btn btn-info btn-sm" value="Regresar" id="regresar" style="margin-left: 30px;"/>
            <!-- <input type="button" class="btn btn-success btn-sm" value="Editar" id="editar" style="margin-left: 30px;"/> -->
      			<input class="btn btn-danger btn-sm" type='button' value='Cierra Sesión' id="cierra" style="margin-left: 30px;"/>
          </p>
          <p style="font-weight: bold;">
            HAGO CONSTAR QUE RECIBO LAS FACTURAS DESCRITAS EN ESTE DOCUMENTO, PARA SU COBRO, YA SEA EN
            CHEQUE O EFECTIVO, PAGOS QUE DEPOSITARE EN LAS CUENTAS BANCARIAS DE JOSE LUIS GARCIA RESENDIZ
          </p>
          <br />
          <div style="text-align: right;">
            <p>_____________________________</p>
            <p style="font-weight: bold;">
              RECIBIÓ, INÉS ISLAS LECHUGA
            </p>
          </div>

          <input type="button" class="btn btn-success btn-sm" value="Agregar Factura/Remisión" id="agregarFactura" style="margin-bottom: 30px;"/>
          <table width='850px' border="1" style="text-align: center;">
            <tr>
              <td colspan="5" style="background-color: gray; font-weight:bold;">ABASTECEDORA DE PRODUCTOS AUTOMOTRICES</td>
            </tr>
            <tr style="font-weight: bold;">
              <td>FACTURA</td>
              <td>CLIENTE</td>
              <td>MONTO</td>
              <td>PAGO</td>
              <td>OBSERVACIONES</td>
            </tr>
            <?for($i=0;$i<$contador;$i++):?>
                <tr>
                  <td><?= $facturas[$i] ?> &nbsp;&nbsp;&nbsp;</td>
                  <td align="left"><?= $cliente[$i] . " " . $nombre[$i] ?></td>
                  <td><?= "$".number_format($importe[$i], 2, ".", ",") ?></td>
                  <td><?= $metodos[$i] ?></td>
                  <td><?= $observaciones[$i] ?></td>
                </tr>
            <?endfor?>
          </table>
          <br />
          <table width='550px' border="1" style="text-align: center;">
            <tr>
              <td colspan="2" style="font-weight: bold">TOTAL FACTURAS</td>
              <td><?= "$".number_format($total, 2, ".", ",") ?></td>
            </tr>
          </table>
          <br />
        </div>
    <script type="text/javascript">
      $(document).ready(function(){

        $("#agregarFactura").hide();
        var departamento = $("#departamento").val();

        if(departamento=="COBRANZA"){
          $("#agregarFactura").show();
        }

        $("#agregarFactura").click(function(){
          setTimeout("location.href='agregarFacturaRemision.php?folio="+$('#folio').val()+"'",500);
        });
        $("#impresion").click(function(){

          $("#impresion").hide();
          $("#regresar").hide();
          $("#cierra").hide();
          $("#editar").hide();
          $("#agregarFactura").hide();
          print();
          $("#impresion").show();
          $("#regresar").show();
          $("#cierra").show();
          $("#editar").show();
          if(departamento=="COBRANZA"){
            $("#agregarFactura").show();
          }
        });
        $("#regresar").click(function(){
          setTimeout("location.href='visualizacion.php'",500);
        });
        $("#editar").click(function(){
          var folio = $("#folio").val();
          setTimeout("location.href='editar.php?folio="+folio+"'",500);
        });
        $("#cierra").click(function(){
          setTimeout("location.href='../cierre.php'",500);
        });
      });
    </script>
  </body>
</html>
