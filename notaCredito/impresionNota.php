<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="" content="" />
    <meta name="" content="" />
    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
    <link href="css/estiloNota.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Impresión</title>
    <style>
      a{
            color: #FFFFFF;
      }
      td{
        height: 15px;
      }
      textarea{
        resize: none;
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
      $user = usuario($usuario);


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
          <?php if($usuario=="olcruz") :?>
            <table witd='85%' align='center' border=0>
              <tr>
              <td>
              <input class="btn btn-primary" type='submit' id='captura' value='Imprimir' onclick="print();"/>

              </td>
              <td>
              <button onclick="nota();" class="btn btn-primary">Nueva Nota</button>
              </td>
              <td>
              <button onclick="visualizar();" class="btn btn-primary">Visualizar Notas</button>
              </td>
              <td>
              <button onclick="cancela();" class="btn btn-primary">Cancela Nota</button>
              </td>
              <td>
              <form name="formulario2" action="cierre.php" method="post">
              <input class="btn btn-primary" type="submit" value="Cerrar Sesion" />
              </form>
              </td>
              </tr>
            </table>
              <? for($j=1; $j<=2; $j++) :?>
                  <? if($tipo=="Factor 3"||$tipo=="Entrada Caja Factor 3") :?>
                  <table width='20%' align='center' border=1>
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
                      <td colspan=5>
                       <div align="center">
                         <b>ELABORO</b><br />
                         <b><?= $user?></b><br />
                         <b>DEPARTAMENTO DE VENTAS</b><br />
                       </div>
                      </td>
                      <td colspan=5>
                       <div align="center">
                         <b>RECIBE</b><br />
                         <br />
                         <b>DEPARTAMENTO DE CRÉDITO</b><br />
                       </div>
                      </td>
                      </tr>

                  </table>
                  <? else :?>
                      <table width='20%' align='center' border=1>
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
                          <td colspan=5>
                           <div align="center">
                             <b>ELABORO</b><br />
                             <b><?= $user?></b><br />
                             <b>DEPARTAMENTO DE VENTAS</b><br />
                           </div>
                          </td>
                          <td colspan=5>
                           <div align="center">
                             <b>RECIBE</b><br />
                             <br />
                             <b>DEPARTAMENTO DE CRÉDITO</b><br />
                           </div>
                          </td>
                          </tr>

                      </table>
                  <? endif?>
                  <?if(tamanoTabla($cantidad)>15 && $j==1) :?>
                    <br /><br /><br /><br /><br /><br /><br /><br />
                    <br /><br /><br /><br /><br /><br /><br /><br />
                    <br /><br /><br /><br /><br /><br /><br /><br />
                    <br /><br /><br /><br /><br />
                  <? else :?>
                    <br />
                  <? endif ?>
              <? endfor ?>

          <? else :?>
              <table witd='85%' align='center' border=0>

              <tr>
              <td>
              <input class="btn btn-primary" type='submit' id='captura' value='Imprimir' onclick="imprime();"/>

              </td>
              <td>
              <button onclick="nota();" class="btn btn-primary">Nueva Nota</button>
              </td>
              <td>
              <button onclick="visualizar();" class="btn btn-primary">Visualizar Notas</button>
              </td>
              <td>
              <form name="formulario2" action="cierre.php" method="post">
              <input class="btn btn-primary" type="submit" value="Cerrar Sesion" />
              </form>
              </td>
              </tr>

              </table>
              <? for($j=1; $j<=2; $j++) :?>
                  <? if($tipo=="Factor 3"||$tipo=="Entrada Caja Factor 3") :?>
                      <table width='20%' align='center' border=1>

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
                          <td colspan=5>
                           <div align="center">
                             <b>ELABORO</b><br />
                             <b><?= $user?></b><br />
                             <b>DEPARTAMENTO DE VENTAS</b><br />
                           </div>
                          </td>
                          <td colspan=5>
                           <div align="center">
                             <b>RECIBE</b><br />
                             <br />
                             <b>DEPARTAMENTO DE CRÉDITO</b><br />
                           </div>
                          </td>
                          </tr>

                      </table>
                      <br /><br />
                  <? else :?>
                      <table width='20%' align='center' border=1>
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
                      <td colspan=5>
                      <div align="center">
                      <b>ELABORO</b><br />
                      <b><?= $user?></b><br />
                      <b>DEPARTAMENTO DE VENTAS</b><br />
                      </div>
                      </td>
                      <td colspan=5>
                      <div align="center">
                      <b>RECIBE</b><br />
                      <br />
                      <b>DEPARTAMENTO DE CRÉDITO</b><br />
                      </div>
                      </td>
                      </tr>

                      </table>
                      <br /><br />
                  <? endif ?>
                  <?if(tamanoTabla($cantidad)>15 && $j==1) :?>
                    <br /><br /><br /><br /><br /><br /><br /><br />
                    <br /><br /><br /><br /><br /><br /><br /><br />
                    <br /><br /><br /><br /><br /><br /><br /><br />
                    <br /><br /><br /><br /><br />
                  <? else :?>
                    <br />
                  <? endif ?>
              <? endfor ?>
          <?endif ?>
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
              setTimeout("location.href='visualizacion.php'",500);
            }
            function cierre(){
              setTimeout("location.href='cierre.php'",500);
            }
            function nota(){
              setTimeout("location.href='nota.php'",500);
            }
            function cancela(){
              var consecutivo = document.getElementsByTagName('td')[8].innerText;
              // alert(consecutivo);
              setTimeout("location.href='notaCancelada.php?folio="+consecutivo+"'");
              // alert("Oralee Muchachon tienes el consecutivo "+consecutivo+"!!!");
            }

            function imprime()
            {
              var texto = document.getElementById('motivo');
              // alert(texto.value);
              print( texto.value );
            }
          </script>
          </body>
          </html>
