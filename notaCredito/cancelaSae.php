<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="" content="" />
    <meta name="" content="" />
    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Captura SAE</title>
    <style>


      a{
            color: #FFFFFF;
      }

    </style>
  </head>
  <body>
      <?php session_start();
      $usuario = $_SESSION['user'];
      require_once("../funciones.php");
      $base = conexion_local();
      $consulta="SELECT DEPARTAMENTO FROM USUARIOS WHERE USUARIO=?";
      $resultado = $base->prepare($consulta);
      $resultado-> execute(array($usuario));
      $registro = $resultado->fetch(PDO::FETCH_NUM);
      $departamento = $registro[0];


      if(!isset($usuario))
      {
        header("location:../index.html");
      }
      $resultado->closeCursor();
      $folio = $_GET['folio'];
      $cantidad = array();
      $clave = array();
      $costo = array();
      $importe = array();
      $sub = array();
      $lista = array();
      $x = 1;
      $sub = 0;
      $flag = 0;


      try
      {
        $base = conexion_local();
        //Para las notas sin número SAE
        $consulta = "SELECT * FROM NOTAS WHERE FOLIOINTERNO=?";
        $resultado = $base->prepare($consulta);
        $resultado -> execute(array($folio));
        //Para el pdf
        $consulta2 = "SELECT PDF FROM NOTAS_VIS WHERE FOLIOINTERNO=?";
        $resultado2 = $base->prepare($consulta);
        $resultado2 -> execute(array($folio));
        $registro2 = $resultado2->fetch(PDO::FETCH_ASSOC);
        $pdf = "P2.pdf";






        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC))
        {

            $tipo = $registro["TIPO"];
            $fecha = $registro["FECHA"];
            $folio = $registro["FOLIOINTERNO"];
            $cliente = $registro["NOCLIENTE"];
            $nombre = $registro["NOMBRE"];
            $clave[$x] = $registro["SKU"];
            $cantidad[$x] = $registro["UNIDADESxSKU"];
            $factura = $registro["FACTURA"];
            if($tipo=="Muestra"){
              $costo[$x] = 0;
            }
            else{
              $costo[$x] = $registro["MONTO"];
            }
            $motivo = $registro["MOTIVO"];
            $observaciones = $registro["OBSERVACIONES"];
            $lista[$x] = $registro["LISTAPRECIOS"];
            $user = $registro["USUARIO"];
            $folioRecepcion = $registro["RECEPCION"];
            $devolucion[$x] = $registro["DEVOLUCION"];
            $descuento = $registro["DESCUENTO"];
            $x++;

          }
          if($x==1){
              header("location:sae.php");
          }
          $resultado->closeCursor();
          $cont=count($cantidad);

          if($tipo=="Factor 3"||$tipo=="Entrada Caja Factor 3"){
            for ($i=1; $i <=$cont ; $i++)
            {
              $separador = explode("G", $clave[$i]);
              if($separador[0]!="CAR"){
                $importe[$i] = imp($cantidad[$i], $costo[$i]);
                $subtotales[$i] = sub($descuento, $importe[$i]);
              }
            }

            $iva = 0;
            $sub = subtotal($subtotales);
            $total = $sub;
            $letra = num2letras($total, $fem = false, $dec = true);
          }
          else{
            for ($i=1; $i <=$cont ; $i++)
            {
              $separador = explode("G", $clave[$i]);
              if($separador[0]!="CAR"){
                $importe[$i] = imp($cantidad[$i], $costo[$i]);
                $subtotales[$i] = sub($descuento, $importe[$i]);
              }
            }
            $sub = subtotal($subtotales);
            $iva = iva($sub);
            $total = total($sub,$iva);
            if($tipo=="Muestra"){
              $letra = "CERO";
            }
            else{
              $letra = num2letras($total, $fem = false, $dec = true);
            }
          }
          if($separador[0]=="CAR"){
            $importe[$cont] = $costo[$cont];
            $subtotales[$cont] = $costo[$cont];
            //$total = $total+$costo[$cont];
            //$letra = num2letras($total, $fem = false, $dec = true);
          }
        ?>

        <!--<table witd='50%' align='center' border=1>-->
        <header class="row">
          <div class="container col-md-8">
            <button style="float: left;" class="btn btn-primary" onclick='visualizar()'>Regresa a Tabla</button>
            <h1 align="center">Nota Crédito</h1>
          </div>
          <div class="container col-md-4">
            <form action='cierre.php'>
              <input style="float: right;" class="btn btn-primary" type='submit' value='Cierra Sesión' />
            </form>
            <button style="float: right;" class="btn btn-primary"><a href="notas_pdf/<?= $pdf?>" target="_blank">PDF</a></button>

          </div>
        </header>
        <div class="container">
          <? if($tipo=="Factor 3"||$tipo=="Entrada Caja Factor 3") :?>
          <table class="table table-bordered table-condensed">
          <!--<table witd='50%' align='center' border=1>-->
            <tr>
            <th colspan=6 align='center'> <img src='imagenes/apa.jpg'></th>

            <th>MES</th>
            <td align='center'><?= mes_sae($fecha)?></td>
            <th>FECHA</th>
            <td align='center'><?= fechaStandar($fecha)?></td>
            </tr>
            <tr>
              <th colspan=6 align='center'>REPORTE DE ENTRADA DE MERCANCIA</th>
            <th>TIPO</th>
            <td align='center'><?= $tipo?></td>
            <th>FOLIO</th>
            <td align='center'><?= $folio?></td>
            </tr>
            <tr>
            <th colspan=6 align='left'> NOMBRE: <?= $nombre?></th>
            <th>FOLIO REC: </th>
            <td align='center'><?= $folioRecepcion?></td>
            <th>CLIENTE: </th>
            <td align='center'><?= $cliente?></td>
            </tr>

            <tr>
            <th>CANT</th>
            <th>No.</th>
            <th>DEV.</th>
            <th>No. FACT</th>
            <th colspan=2>MOTIVO</th>
            <th>COSTO</th>
            <th>IMPORTE</th>
            <th>DESC.</th>
            <th>SUBTOTAL</th>
            </tr>

            <?php for($i=1; $i<=tamanoTabla($cantidad);$i++):?>
              <?php if($i<=$cont):?>
                <?php if($i==1):?>
                  <tr>
                        <td align='center'><?= $cantidad[$i]?></td>
                        <td align='center'><?= $clave[$i]?></td>
                        <td align='center'><?= $devolucion[$i]?></td>
                        <td align='center'><?= $factura?></td>
                        <td rowspan=<?=tamanoTabla($cantidad)?> colspan=2 align='center'>
                        <textarea id="motivo" name='motivo' rows=8 cols=40 style='font-size:20px; font-type:Arial' readonly><?= $motivo . " \n\nObservaciones:\n" . strtolower($observaciones)?></textarea></td>
                        <td align='center'><?= "$" . number_format($costo[$i], 2, ".", ",")?></td>
                        <td align='center'><?= "$" . number_format($importe[$i], 2, ".", ",")?></td>
                        <td align='center'><?= $descuento . "%"?></td>
                        <td align='center'><?= "$" . number_format($subtotales[$i], 2, ".", ",")?></td>
                  </tr>
                <?php else:?>
                  <tr>
                        <td align='center'><?= $cantidad[$i]?></td>
                        <td align='center'><?= $clave[$i]?></td>
                        <td align='center'><?= $devolucion[$i]?></td>
                        <td align='center'></td>
                        <td align='center'><?= "$" . number_format($costo[$i], 2, ".", ",")?></td>
                        <td align='center'><?= "$" . number_format($importe[$i], 2, ".", ",")?></td>
                        <td align='center'></td>
                        <td align='center'><?= "$" . number_format($subtotales[$i], 2, ".", ",")?></td>
                  </tr>
                <?php endif?>
             <?php else:?>
               <tr>
                     <td>&nbsp;</td>
                     <td>&nbsp;</td>
                     <td>&nbsp;</td>
                     <td>&nbsp;</td>
                     <td>&nbsp;</td>
                     <td>&nbsp;</td>
                     <td>&nbsp;</td>
                     <td>&nbsp;</td>
                </tr>
              <?php endif?>
          <?php endfor?>

          <tr>
            <th colspan=7 rowspan=2 align='center'><?= "(" . $letra . ")"?></th>
            <th>SUBTOTAL</th>
            <td colspan=2 align='center'><?= "$" . number_format($sub, 2, ".", ",")?></td>
          </tr>
          <tr>
            <th>TOTAL</th>
            <td colspan=2 align='center'><?= "$" . number_format($total, 2, ".", ",")?></td>
          </tr>
          <tr>
            <td colspan=5 rowspan=3 >
            <table>
            <tr>
              <th>ELABORO</th>
            </tr>
            <tr>
              <th><?= $user?></th>
            </tr>
            <tr>
              <th>DEPARTAMENTO DE VENTAS</th>
            </tr>
            </table>
            </td>
            <td colspan=5 rowspan=3>
             <table>
             <tr><th>RECIBE</th></tr>
             <tr><th>&nbsp;</th></tr>
             <tr><th>DEPARTAMENTO DE CRÉDITO</th></tr>
             </table>
            </td>
          </tr>

          </table>
        <? else : ?>
        <table class="table table-bordered table-condensed">
          <tr>
          <th colspan=6 align='center'> <img src='imagenes/apa.jpg'></th>

          <th>MES</th>
          <td align='center'><?= mes_sae($fecha)?></td>
          <th>FECHA</th>
          <td align='center'><?= fechaStandar($fecha)?></td>
          </tr>
          <tr>
            <th colspan=6 align='center'>REPORTE DE ENTRADA DE MERCANCIA</th>
          <th>TIPO</th>
          <td align='center'><?= $tipo?></td>
          <th>FOLIO</th>
          <td align='center'><?= $folio?></td>
          </tr>
          <tr>
          <th colspan=6 align='left'> NOMBRE: <?= $nombre?></th>
          <th>FOLIO REC: </th>
          <td align='center'><?= $folioRecepcion?></td>
          <th>CLIENTE: </th>
          <td align='center'><?= $cliente?></td>
          </tr>

          <tr>
          <th>CANT</th>
          <th>No.</th>
          <th>DEV.</th>
          <th>No. FACT</th>
          <th colspan=2>MOTIVO</th>
          <th>COSTO</th>
          <th>IMPORTE</th>
          <th>DESC.</th>
          <th>SUBTOTAL</th>
          </tr>

          <?php for($i=1; $i<=tamanoTabla($cantidad);$i++):?>
            <?php if($i<=$cont):?>
              <?php if($i==1):?>
                <tr>
                      <td align='center'><?= $cantidad[$i]?></td>
                      <td align='center'><?= $clave[$i]?></td>
                      <td align='center'><?= $devolucion[$i]?></td>
                      <td align='center'><?= $factura?></td>
                      <td rowspan=<?=tamanoTabla($cantidad)?> colspan=2 align='center'>
                      <textarea id="motivo" name='motivo' rows=8 cols=40 style='font-size:20px; font-type:Arial' readonly><?= $motivo . " \n\nObservaciones:\n" . strtolower($observaciones)?></textarea></td>
                      <td align='center'><?= "$" . number_format($costo[$i], 2, ".", ",")?></td>
                      <td align='center'><?= "$" . number_format($importe[$i], 2, ".", ",")?></td>
                      <td align='center'><?= $descuento . "%"?></td>
                      <td align='center'><?= "$" . number_format($subtotales[$i], 2, ".", ",")?></td>
                </tr>
              <?php else:?>
                <tr>
                      <td align='center'><?= $cantidad[$i]?></td>
                      <td align='center'><?= $clave[$i]?></td>
                      <td align='center'><?= $devolucion[$i]?></td>
                      <td align='center'></td>
                      <td align='center'><?= "$" . number_format($costo[$i], 2, ".", ",")?></td>
                      <td align='center'><?= "$" . number_format($importe[$i], 2, ".", ",")?></td>
                      <td align='center'></td>
                      <td align='center'><?= "$" . number_format($subtotales[$i], 2, ".", ",")?></td>
                </tr>
              <?php endif?>
           <?php else:?>
             <tr>
                   <td>&nbsp;</td>
                   <td>&nbsp;</td>
                   <td>&nbsp;</td>
                   <td>&nbsp;</td>
                   <td>&nbsp;</td>
                   <td>&nbsp;</td>
                   <td>&nbsp;</td>
                   <td>&nbsp;</td>
              </tr>
            <?php endif?>
        <?php endfor?>

        <tr>
          <th colspan=7 rowspan=3 align='center'><?= "(" . $letra . ")"?></th>
          <th>SUBTOTAL</th>
          <td colspan=2 align='center'><?= "$" . number_format($sub, 2, ".", ",")?></td>
        </tr>
        <tr>
          <th>IVA</th>
          <td colspan=2 align='center'><?= "$" . number_format($iva, 2, ".", ",")?></td>
        </tr>
        <tr>
          <th>TOTAL</th>
          <td colspan=2 align='center'><?= "$" . number_format($total, 2, ".", ",")?></td>
        </tr>
        <tr>
          <td colspan=5 rowspan=3 >
          <table>
          <tr>
            <th>ELABORO</th>
          </tr>
          <tr>
            <th><?= $user?></th>
          </tr>
          <tr>
            <th>DEPARTAMENTO DE VENTAS</th>
          </tr>
          </table>
          </td>
          <td colspan=5 rowspan=3>
           <table>
           <tr><th>RECIBE</th></tr>
           <tr><th>&nbsp;</th></tr>
           <tr><th>DEPARTAMENTO DE CRÉDITO</th></tr>
           </table>
          </td>
        </tr>

        </table>
        <? endif ?>
        </div>





        <section>

          <div class="container">

           <h1 align='center'> Cancela Nota</h1>
           <form method='post' action='final_sae.php' enctype="multipart/form-data">

           <table class="table table-condensed table-bordered table-responsive">
           <tr>
           <td colspan=2 align='center'><img src='imagenes/apa.jpg' class="img-responsive"></td>
           </tr>
           <tr>
             <div class="form-group">
               <td><label for="pdf">PDF</label></td>
               <td><input  id="pdf" type="file" name="archivo"/></td>
             </div>
           </tr>
           <tr>
           <input name='folio' type='hidden' value='<?= $folio?>'>
           <input name='contador' type='hidden' value='<?= $cont?>'>
           <td colspan=2 align='center'><input class="btn btn-primary" type='submit' value='Capturar'></td>
           </tr>
           </table>
           </form>
          </div>
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

            function saludo(){
              alert("Hola Buenos Días!!!");
            }
            function sae(){
              setTimeout("location.href='sae.php'",500);
            }
            function visualizar(){
              setTimeout("location.href='sae.php'",500);
            }
            function cierre(){
              setTimeout("location.href='cierre.php'",500);
            }
      </script>
  </body>
</html>
