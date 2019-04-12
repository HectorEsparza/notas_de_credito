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

      $folio = $_GET['folio'];

      $cantidad = array();
      $clave = array();
      $costo = array();
      $importe = array();
      $subtotales = array();
      $lista = array();
      $descripcion = array();
      $x = 1;
      $subtotal1 = 0; //Este es la suma de todos los importes
      $subtotal2 = 0; //Resta del subtotal1 y el descuento
      $ivaCarta = 0; //IVA aplicado al subtotal2
      $total = 0; //Suma del subtotal2 y el iva
      $descuentodeCarta = 0;
      $flag=0;
      $cont = 1;

      try
      {
        $base = conexion_local();
        //Para las CARTAS sin número SAE
        $consulta = "SELECT * FROM CARTAS WHERE FOLIOINTERNO=?";
        $resultado = $base->prepare($consulta);
        $resultado -> execute(array($folio));


          while ($registro = $resultado->fetch(PDO::FETCH_NUM))
          {
              $tipo = $registro[0];
              $fecha = $registro[1];
              $folio = $registro[2];
              $cliente = $registro[3];
              $nombre = $registro[4];
              $clave[$x] = $registro[5];
              $cantidad[$x] = $registro[6];
              $costo[$x] = $registro[7];
              $lista[$x] = $registro[9];
              $user = $registro[10];
              $descuentodeCliente = $registro[13];
              $x++;

          }
          $resultado->closeCursor();

          // for ($i=1; $i <=count($cantidad); $i++) {
          //   echo 'Cantidad: ' . $cantidad[$i] . ' Clave: ' . $clave[$i] . ' Costo: ' . $costo[$i] . '<br />';
          // }

          for($i=1;$i<=count($clave);$i++){
              if($clave[$i]!="FLETE"){
                $consulta = 'SELECT DESCRIPCIÓN FROM PRODUCTOS1 WHERE CLAVEDEARTÍCULO=?';
                $resultado = $base->prepare($consulta);
                $resultado->execute(array($clave[$i]));
                $registro = $resultado->fetch(PDO::FETCH_NUM);
                $descripcion[$i] = $registro[0];
                $importe[$i] = imp($cantidad[$i], $costo[$i]);
              }
              else{
                $flag=1;
              }
          }
          $resultado->closeCursor();

          // for ($i=1; $i <=count($cantidad); $i++) {
          //   echo 'Cantidad: ' . $cantidad[$i] . ' Clave: ' . $clave[$i] . ' Costo: ' . $costo[$i] . ' Descripcion: ' . $descripcion[$i] . ' Importe: ' . $importe[$i] . '<br />';
          // }
          //
          $subtotal1 = subtotal($importe);
          $descuentodeCarta = round((($descuentodeCliente/100)*$subtotal1)*100)/100;
          $subtotal2 = $subtotal1-$descuentodeCarta;
          if($flag==1){
            $subtotal2 = $subtotal2+$costo[count($cantidad)];
            $importe[count($cantidad)] = $costo[count($cantidad)];
            $descripcion[count($cantidad)] = "FLETE";
          }

          if($tipo=="1. Carta Factura"){
              $ivaCarta = iva($subtotal2);
              $total = $subtotal2+$ivaCarta;
          }
          else{
              $ivaCarta = 0;
              $total = $subtotal2+$ivaCarta;
          }

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

            $consulta = "SELECT PDF, STATUS FROM CARTAS WHERE FOLIOINTERNO=?";
            $resultado = $base->prepare($consulta);
            $resultado->execute(array($folio));
            $registro = $resultado->fetch(PDO::FETCH_NUM);
            $pdf = $registro[0];
            $status = $registro[1];
            $resultado->closeCursor();
          ?>
          <input type="hidden" id="valorPDF" value="<?= $pdf?>" />
          <input type="hidden" id="status" value="<?= $status?>" />
          <?php if($usuario=="olcruz") :?>
            <header>
              <button class="btn btn-primary" onclick="print();">Imprimir</button>
              <button class="btn btn-primary" id="visualizar">Visualizar Cartas</button>
              <button class="btn btn-primary" id="pdf"><a href="cartas_pdf/<?= $pdf?>" target="_blank">PDF</a></button>
              <button class="btn btn-primary" id="cancela">Cancela Carta</button>
              <button class="btn btn-primary" id="cierra">Cierra Sesión</button>
            </header>

          <? else :?>
          <header>
            <button class="btn btn-primary" onclick="print();">Imprimir</button>
            <button class="btn btn-primary" id="visualizar">Visualizar Cartas</button>
            <button class="btn btn-primary" id="pdf"><a href="cartas_pdf/<?= $pdf?>" target="_blank">PDF</a></button>
            <button class="btn btn-primary" id="cierra">Cierra Sesión</button>
          </header>
          <?endif ?>

          <section>
              <br /><br />
              <table border="1" align='center' width="100%">
                <tr>
                  <td colspan="5" rowspan="4" align='center'>
                    <b>ABASTECEDORA DE PRODUCTOS AUTOMOTRICES
                    Cda. Pozo Brasil no. 30 Col. Reynosa, México DF.
                    Tels: 0155-53943222, 53831895, 53838046, 53195803
                    www.hulesapa.com.mx / ventas@hulesapa.mx</b>
                  </td>
                </tr>
                <tr>
                    <td colspan="3" align='center' style="height: 60px"><img src='imagenes/apa.jpg' height=50px></td>
                </tr>
                <tr>
                  <td colspan="3" align='center'><b>CARTA FACTURA</b></td>
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
                  <td colspan="2" rowspan="2" align='center'><?= $user?></td>
                </tr>
                <tr>
                </tr>
                <tr>
                  <td align='center'><b>CANTIDAD</b></td>
                  <td align='center'><b>CLAVE</b></td>
                  <td align='center'colspan=3><b>DESCRIPCIÓN</b></td>
                  <td align='center'><b>%DESC</b></td>
                  <td align='center'><b>P/U</b></td>
                  <td align='center'><b>PRECIO TOTAL</b></td>
                </tr>
                <? for($i=1;$i<=25;$i++) :?>
                  <? if($i<=count($cantidad)) :?>
                    <tr>
                      <td align='center'><?= $cantidad[$i] ?></td>
                      <td align='center'><?= $clave[$i] ?></td>
                      <td align='center' colspan="3"><?= $descripcion[$i] ?></td>
                      <td align='center'><?= $descuentodeCliente . "%" ?></td>
                      <td align='center'><?= "$" . number_format($costo[$i], 2, ".", ",") ?></td>
                      <td align='center'><?= "$" . number_format($importe[$i], 2, ".", ",") ?></td>
                    </tr>
                  <? else :?>
                    <tr>
                      <td align='center'>&nbsp;</td>
                      <td align='center'>&nbsp;</td>
                      <td align='center' colspan="3">&nbsp;</td>
                      <td align='center'>&nbsp;</td>
                      <td align='center'>&nbsp;</td>
                      <td align='center'>&nbsp;</td>
                    </tr>
                  <? endif ?>
                <? endfor ?>
                <? if($tipo=="1. Carta Factura") :?>
                  <tr>
                    <td align='center' colspan="6" rowspan="5"><b><?= $letra ?></b></td>
                    <td align='center'><b>SUBTOTAL</b></td>
                    <td align='center'><?= "$" . number_format($subtotal1, 2, ".", ",") ?></td>
                  </tr>
                  <tr>
                    <td align='center'><b>DESCUENTO</b></td>
                    <td align='center'><?= "$" . number_format($descuentodeCarta, 2, ".", ",") ?></td>
                  </tr>
                  <tr>
                    <td align='center'><b>SUBTOTAL</b></td>
                    <td align='center'><?= "$" . number_format($subtotal2, 2, ".", ",") ?></td>
                  </tr>
                  <tr>
                    <td align='center'><b>IVA</b></td>
                    <td align='center'><?= "$" . number_format($ivaCarta, 2, ".", ",") ?></td>
                  </tr>
                  <tr>
                    <td align='center'><b>TOTAL</b></td>
                    <td align='center'><?= "$" . number_format($total, 2, ".", ",") ?></td>
                  </tr>
                <? else : ?>
                  <tr>
                    <td align='center' colspan="6" rowspan="4"><b><?= $letra ?></b></td>
                    <td align='center'><b>SUBTOTAL</b></td>
                    <td align='center'><?= "$" . number_format($subtotal1, 2, ".", ",") ?></td>
                  </tr>
                  <tr>
                    <td align='center'><b>DESCUENTO</b></td>
                    <td align='center'><?= "$" . number_format($descuentodeCarta, 2, ".", ",") ?></td>
                  </tr>
                  <tr>
                    <td align='center'><b>SUBTOTAL</b></td>
                    <td align='center'><?= "$" . number_format($subtotal2, 2, ".", ",") ?></td>
                  </tr>
                  <tr>
                    <td align='center'><b>TOTAL</b></td>
                    <td align='center'><?= "$" . number_format($total, 2, ".", ",") ?></td>
                  </tr>
                <? endif ?>
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
                // alert("hola");
                // alert(($("#valorPDF").val().length));

                if(($("#valorPDF").val()).length==0){
                  $("#pdf").hide();
                }
                else{
                  $("#pdf").show();
                }
                if($("#status").val()=="CANCELADA"){
                  $("#cancela").hide();
                }
                else{
                  $("#cancela").show();
                }


                $("#carta").click(function(){
                    setTimeout("location.href='carta.php'",500);
                });

                $("#visualizar").click(function(){
                  setTimeout("location.href='visualizarCartas.php'",500);
                });

                $("#cierra").click(function(){
                  setTimeout("location.href='cierre.php'",500);
                });

                $("#cancela").click(function(){
                  var consecutivo = document.getElementsByTagName('td')[4].innerText;
                  setTimeout("location.href='cartaCancelada.php?folio="+consecutivo+"'");
                });
              });
          </script>
          </body>
          </html>
