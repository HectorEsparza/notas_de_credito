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

      elseif($departamento!="CREDITO Y COBRANZA")
      {
        header("location:../home.php");
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
        $resultado2 = $base->prepare($consulta2);
        $resultado2 -> execute(array($folio));
        $registro2 = $resultado2->fetch(PDO::FETCH_NUM);
        if($registro2[0]==""){
          $pdf="nulo";
        }
        else{
          $pdf = $registro2[0];
        }

        //Para las notas con número SAE
        $consulta4 = "SELECT * FROM NOTAS WHERE FOLIOINTERNO=?";
        $resultado4 = $base->prepare($consulta4);
        $resultado4 -> execute(array($folio));
        $registro4 = $resultado4->fetch(PDO::FETCH_NUM);

        if($registro4[2]==null){
            header("location:sae.php");
        }



          while ($registro = $resultado->fetch(PDO::FETCH_NUM))
          {

              $tipo = $registro[0];
              $fecha = $registro[1];
              $folio = $registro[2];
              $cliente = $registro[3];
              $nombre = $registro[4];
              $clave[$x] = $registro[5];
              $cantidad[$x] = $registro[6];
              $factura = $registro[7];
              $monto = $registro[8];
              $motivo = $registro[9];
              $lista[$x] = $registro[11];
              $user = $registro[12];
              $folioRecepcion = $registro[16];
              $devolucion[$x] = $registro[17];
              $descuento = $registro[18];
              $x++;

          }
          $resultado->closeCursor();

          for($i=1;$i<=count($lista);$i++){
            $separador = explode("G", $clave[$i]);
            if($separador[0]!="CAR"){
              $consulta = 'SELECT PRECIO FROM ' . $lista[$i] . ' WHERE CLAVEDEARTÍCULO=?';
              $resultado = $base->prepare($consulta);
              $resultado->execute(array($clave[$i]));
              $registro = $resultado->fetch(PDO::FETCH_NUM);
              $costo[$i] = $registro[0];
            }
            else{
              //A la penalizacion no se le cobra descuento
              $flag = 1;
            }
          }
          $resultado->closeCursor();
          $cont=count($cantidad);

          if($tipo=="4. Factor 3"||$tipo=="6. Entrada Caja Factor 3"){
            for ($i=1; $i <=$cont ; $i++)
            {
              $importe[$i] = imp($cantidad[$i], $costo[$i]);
              $subtotales[$i] = sub($descuento, $importe[$i]);
            }

            $iva = 0;
            $sub = subtotal($subtotales);
            $total = $sub;
            $letra = num2letras($total, $fem = false, $dec = true);
          }
          else{
            for ($i=1; $i <=$cont ; $i++)
            {
              $importe[$i] = imp($cantidad[$i], $costo[$i]);
              $subtotales[$i] = sub($descuento, $importe[$i]);
            }
            $sub = subtotal($subtotales);
            $iva = iva($sub);
            $total = total($sub,$iva);
            $letra = num2letras($total, $fem = false, $dec = true);
          }
          if($flag==1){
            $costo[$cont] = $monto;
            $importe[$cont] = $monto;
            $subtotales[$cont] = $monto;
            $total = $total+$monto;
            $letra = num2letras($total, $fem = false, $dec = true);
          }
          //$tipo2 sirve para ver si la nota de crédito es de tipo Muestra o Cambio Físico
          $tipo2 = explode("-", $folio);
          $tipo2 = $tipo2[0];

        ?>
      <? if($registro4[10]!=null||$tipo2=="CF"||$tipo2=="M"):?>
        <input type="hidden" id="valorPDF" value="<?= $pdf?>" />
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
            <button style="float: right;" id="botonPDF" class="btn btn-primary"><a href="notas_pdf/<?= $pdf?>" target="_blank">PDF</a></button>

          </div>
        </header>
        <div class="container">
          <? if($tipo=="4. Factor 3"||$tipo=="6. Entrada Caja Factor 3") :?>
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
                        <textarea name='motivo' rows=10 cols=40 style='font-size:20px; font-type:Arial' readonly><?= $motivo?></textarea></td>
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
                      <textarea name='motivo' rows=10 cols=40 style='font-size:20px; font-type:Arial' readonly><?= $motivo?></textarea></td>
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


      <? else:?>
      <header class="row">
        <div class="container col-md-8">
          <button style="float: left;" class="btn btn-primary" onclick='visualizar()'>Regresa a Tabla</button>
          <h1 align="center">Nota Crédito</h1>
        </div>
        <div class="container col-md-4">
          <form action='cierre.php'>
            <input style="float: right;" class="btn btn-primary" type='submit' value='Cierra Sesión' />
          </form>
        </div>
      </header>
        <section>
          <div class="container">
            <? if($tipo=="4. Factor 3"||$tipo=="6. Entrada Caja Factor 3") :?>
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
                          <textarea name='motivo' rows=10 cols=40 style='font-size:20px; font-type:Arial' readonly><?= $motivo?></textarea></td>
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
                          <textarea name='motivo' rows=10 cols=40 style='font-size:20px; font-type:Arial' readonly><?= $motivo?></textarea></td>
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
          <? endif?>
          </div>
          <div class="container">

           <h1 align='center'> Número SAE</h1>
           <form method='post' action='final_sae.php' enctype="multipart/form-data">

           <table class="table table-condensed table-bordered table-responsive">
           <tr>
           <td colspan=2 align='center'><img src='imagenes/apa.jpg' class="img-responsive"></td>
           </tr>
           <tr>
             <div class="form-group">
               <td><label for="nota">Nota SAE</label></td>
               <td><input class="form-control" id="nota" type='text' name='sae' required></td>
             </div>
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
      <? endif?>
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

              var pdf = $("#valorPDF").val();

              if(pdf=="nulo"){
                $("#botonPDF").hide();
              }
              else{
                $("#botonPDF").show();
              }
            });
            function sae(){
              setTimeout("location.href='sae.php'",500);
            }
            function visualizar(){
              setTimeout("location.href='sae.php'",500);
            }

      </script>
  </body>
</html>
