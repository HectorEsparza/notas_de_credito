<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="" content="" />
    <meta name="" content="" />
    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Impresión</title>
    <style>


      a{
            color: #FFFFFF;
      }
      td{
        height: 15px;
      }



    </style>
  </head>
  <body>
      <?php session_start();
         $usuario = $_SESSION['user'];

        require_once("../funciones.php");
        $base = conexion_local();
        $consulta="SELECT DEPARTAMENTO, USUARIO, PERMISO FROM USUARIOS WHERE USUARIO=?";
        $resultado = $base->prepare($consulta);
        $resultado-> execute(array($usuario));
        $registro = $resultado->fetch(PDO::FETCH_NUM);
        $departamento = $registro[0];
        $user = $registro[2];
        $gerente = $registro[1];



        if(!isset($usuario))
        {
          header("location:../index.html");
        }

        elseif($departamento!="VENTAS")
        {
          header("location:../home.php");
        }

      $folio = $_GET['folio'];

      $cantidad = array();
      $clave = array();
      $costo = array();
      $importe = array();
      $subtotales = array();
      $lista = array();
      $descripcion = array();
      $x = 1;
      // $subtotal1 = 0; //Este es la suma de todos los importes
      // $subtotal2 = 0; //Resta del subtotal1 y el descuento
      // $ivaCarta = 0; //IVA aplicado al subtotal2
      $total = 0; //Suma del subtotal2 y el iva
      // $descuentodeCarta = 0;

      try
      {
        $base = conexion_local();
        //Para las CARTAS sin número SAE
        $consulta = "SELECT * FROM PEDIDOS WHERE FOLIOINTERNO=?";
        $resultado = $base->prepare($consulta);
        $resultado -> execute(array($folio));


          while ($registro = $resultado->fetch(PDO::FETCH_NUM))
          {
              $fecha = $registro[0];
              $folio = $registro[1];
              $cliente = $registro[2];
              $nombre = $registro[3];
              $clave[$x] = $registro[4];
              $cantidad[$x] = $registro[5];
              $monto = $registro[6];
              $lista[$x] = $registro[8];
              $user = $registro[9];
              $descuentodeCliente = $registro[11];
              $x++;

          }
          $resultado->closeCursor();

          for($i=1;$i<=count($lista);$i++){
              $consulta = 'SELECT PRECIO, DESCRIPCIÓN FROM ' . $lista[$i] . ' WHERE CLAVEDEARTÍCULO=?';
              $resultado = $base->prepare($consulta);
              $resultado->execute(array($clave[$i]));
              $registro = $resultado->fetch(PDO::FETCH_NUM);
              $costo[$i] = $registro[0];
              $descripcion[$i] = $registro[1];
          }




          $resultado->closeCursor();
          $cont=count($cantidad);

            for ($i=1; $i <=$cont ; $i++)
            {
              $importe[$i] = imp($cantidad[$i], $costo[$i]);

            }
            // $subtotal1 = subtotal($importe);
            // $descuentodeCarta = sub($descuentodeCliente, $subtotal1);
            // $subtotal2 = $subtotal1-$descuentodeCarta;
            // $ivaCarta = iva($subtotal2);
            // $total = subtotal($importe)*1.16;
            $total = subtotal($importe);
            $total = sub($descuentodeCliente, $total);
            $total = $total + iva($total);
            $letra = num2letras($total, $fem = false, $dec = true);

            $consulta = "SELECT NOMBRE, RFC, CALLE, COLONIA, CP, TELEFONO FROM CLIENTES WHERE CLAVE=?";
            $resultado = $base->prepare($consulta);
            $resultado->execute(array($cliente));
            $registro = $resultado->fetch(PDO::FETCH_NUM);
            $nombre = $registro[0];
            $rfc = $registro[1];
            $calle = $registro[2];
            $colonia = $registro[3];
            $cp = $registro[4];
            $telefono = $registro[5];
            $resultado->closeCursor();
          ?>

          <input type="hidden" id="status" value="<?= $status?>" />
          <?php if($usuario=="olcruz") :?>
            <header>
              <button class="btn btn-primary" onclick="print();">Imprimir</button>
              <button class="btn btn-primary" id="carta">Nuevo Pedido</button>
              <button class="btn btn-primary" id="visualizar">Visualizar Pedidos</button>
              <button class="btn btn-primary" id="cancela">Cancela Pedido</button>
              <button class="btn btn-primary" id="cierra">Cierra Sesión</button>
            </header>

          <? else :?>
          <header>
            <button class="btn btn-primary" onclick="print();">Imprimir</button>
            <button class="btn btn-primary" id="carta">Nuevo Pedido</button>
            <button class="btn btn-primary" id="visualizar">Visualizar Pedidos</button>
            <button class="btn btn-primary" id="cierra">Cierra Sesión</button>
          </header>
          <?endif ?>

          <section>
              <br /><br />
              <table border="1" align='center' width="100%">
                <tr>
                  <td colspan="5" rowspan="4" align='center'>
                    <b>JOSE LUIS GARCIA RESENDIZ</b>
                  </td>
                </tr>
                <tr>
                    <td colspan="3" align='center' style="height: 60px"><img src='imagenes/apa.jpg' height=50px></td>
                </tr>
                <tr>
                  <td colspan="3" align='center'><b>PEDIDO</b></td>
                </tr>
                <tr>
                  <td colspan="2" align='center'><b>FOLIO</b></td>
                  <td align='center'><?= $folio?></td>
                </tr>
                <tr>
                  <td align='center'><?= $cliente?></td>
                  <td align='center'><b>CLIENTE</b>:</td>
                  <td colspan="4" align='center'><?= $nombre?></td>
                  <td align='center'><b>FECHA:</b></td>
                  <td align='center'><?= fechaStandar($fecha)?></td>
                </tr>
                <tr>
                  <td colspan="6" rowspan="3" align='center'>
                    <b>Calle: </b><?= $calle?>
                    <b>Col: </b><?= $colonia?>
                    <b>CP: </b><?= $cp ?>
                    <b>RFC: </b><?= $rfc ?>
                    <b>Teléfono: </b><?= $telefono ?>
                  </td>
                  <td colspan="2" align='center'><b>DOCUMENTADOR</b></td>
                </tr>
                <tr>
                  <td colspan="2" rowspan="2" align='center'><?= usuario($usuario) ?></td>
                </tr>
                <tr>
                </tr>
                <tr>
                  <td align='center'><b>CANTIDAD</b></td>
                  <td align='center'><b>CLAVE</b></td>
                  <td align='center'colspan=5><b>DESCRIPCIÓN</b></td>
                  <td align='center'><b>PRECIO TOTAL</b></td>
                </tr>
                <? for($i=1;$i<=25;$i++) :?>
                  <? if($i<=$cont) :?>
                    <tr>
                      <td align='center'><?= $cantidad[$i] ?></td>
                      <td align='center'><?= $clave[$i] ?></td>
                      <td align='center' colspan="5"><?= $descripcion[$i] ?></td>
                      <td align='center'><?= "$" . number_format($importe[$i], 2, ".", ",") ?></td>
                    </tr>
                  <? else :?>
                    <tr>
                      <td align='center'>&nbsp;</td>
                      <td align='center'>&nbsp;</td>
                      <td align='center' colspan="5">&nbsp;</td>
                      <td align='center'>&nbsp;</td>
                    </tr>
                  <? endif ?>
                <? endfor ?>
                <tr>
                  <td align='center' colspan="6"><b><?= $letra ?></b></td>
                  <td align='center'><b>TOTAL</b></td>
                  <td align='center'><?= "$" . number_format($total, 2, ".", ",") ?></td>
                </tr>
                <tr>
                  <td colspan="8" align='center'><b>OBSERVACIONES</b></td>
                </tr>
                <tr>
                  <td colspan="8"><textarea rows=8 cols=100 readonly></textarea></td>
                </tr>
              </table>
          </section>
          <?php



          }
          catch (Exception $e)
          {
            $mensaje = $e->GetMessage();
            $linea = $e->getline();
            echo "<h1>Error: " . $mensaje . "</h1><br />";
            echo "<h1>Linea del Error: " . $linea . "</h1><br />";

            // die($e->GetMessage());
            // die($e->getline());
            // die("<h1>ERROR: " . $e->GetMessage());
            // echo "<br /><h3>" . $e->getline() . "</h3>";
          }
          finally
          {
          $base = null;
          }


          ?>

          <script src="ajax/eventos/cierreInactividad.js"></script>
          <script>
              $(document).ready(function(){

                if($("#status").val()=="CANCELADO"){
                  $("#cancela").hide();
                }
                else{
                  $("#cancela").show();
                }


                $("#carta").click(function(){
                    setTimeout("location.href='pedido.php'",500);
                });

                $("#visualizar").click(function(){
                  setTimeout("location.href='visualizarPedidos.php'",500);
                });

                $("#cierra").click(function(){
                  setTimeout("location.href='../cierre.php'",500);
                });

                $("#cancela").click(function(){
                  var consecutivo = document.getElementsByTagName('td')[4].innerText;
                  setTimeout("location.href='pedidoCancelado.php?folio="+consecutivo+"'");
                });
              });
          </script>
          </body>
          </html>
