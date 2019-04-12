<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="" content="" />
  <meta name="" content="" />
  <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
  <link href="css/estiloNota.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script type="text/javascript" src="ajax/js/jquery-ui.js"></script>
  <!--<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />-->
  <title>Carta</title>

  <script type="text/javascript" src="ajax/js/tipo_dev.js"></script>
  <script type="text/javascript" src="ajax/js/cliente.js"></script>
  <script type="text/javascript" src="ajax/js/descuento.js"></script>
  <script type="text/javascript" src="ajax/js/limpiar.js"></script>
  <script type="text/javascript" src="ajax/js/listas.js"></script>
  <script type="text/javascript" src="ajax/js/costo.js"></script><!--Devuelve el costo del producto ingresado -->
  <script type="text/javascript" src="ajax/js/nuevo_costo.js"></script>
  <script type="text/javascript" src="ajax/js/nuevo_costo2.js"></script>
  <script type="text/javascript" src="ajax/js/importe2.js"></script><!--Para la nueva columna agregada en la nota, "IMPORTE"-->
  <script type="text/javascript" src="ajax/js/nvo_importe.js"></script><!--Calcula el importe cuando se cambia la lista"-->
  <script type="text/javascript" src="ajax/js/listaDescuentos.js"></script><!--Permite visualizar los diferentes descuentos que se manejan-->
  <script type="text/javascript" src="ajax/js/cambioDescuento.js"></script><!--Permite cambiar el descuento-->
  <script type="text/javascript" src="ajax/js/cambioDescuento2.js"></script><!--Permite cambiar el descuento, para usuarios sin permisos-->
  <script type="text/javascript" src="ajax/js/cambioImporte.js"></script>
  <script type="text/javascript" src="ajax/js/descripcion.js"></script>
  <script type="text/javascript" src="ajax/js/flete.js"></script>
  <script type="text/javascript" src="ajax/js/informacionFlete.js"></script>

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
    $resultado->closeCursor();



    if(!isset($usuario))
    {
      header("location:../index.html");
    }

    $pedido = $_GET['folio'];
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

    $consulta = "SELECT * FROM PEDIDOS WHERE FOLIOINTERNO=?";
    $resultado = $base->prepare($consulta);
    $resultado-> execute(array($pedido));

    while ($registro = $resultado->fetch(PDO::FETCH_NUM))
    {
        $fecha = $registro[0];
        $folioPedido = $registro[1];
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
      $subtotal1 = subtotal($importe);
      $descuentodeCarta = round(($subtotal1 * ($descuentodeCliente/100))*100)/100;
      $subtotal2 = $subtotal1-$descuentodeCarta;
      $ivaCarta = iva($subtotal2);
      $total = $subtotal2+$ivaCarta;
      // $letra = num2letras($total, $fem = false, $dec = true);

      if($cont<10){
        $contador = 10;
      }
      elseif($cont>=10&&$cont<=24){
        $contador = $cont;
      }
      else{
        $contador = 24;
      }

  ?>


      <input type="hidden" id='user' value=<?= $user?> />
      <input type="hidden" id='gerente' value=<?= $gerente?> />

      <header class="row" style="margin-top: 0px;">
        <div class="container col-md-12">
          <input type='button' id="home" class="btn btn-primary" style='background:url("imagenes/home3.jpg"); float: left; width: 50px; height: 50px;' />
          <img src='imagenes/apa.jpg' style="float: left;">
          <h1 align='center'>
            Generar Nueva Carta Factura
          </h1>
        <!-- </div>
        <div class="container col-md-4"> -->

          <form action='cierre.php'>
            <input style="float: right; margin-right: 0px;" class="btn btn-primary" type='submit' value='Cierra Sesión' />
          </form>
          <!-- <form action='visualizacion.php'> -->
          <button style="float: right;" class="btn btn-primary" id="visualizar">Visualizar Cartas</button>
          <!-- </form> -->
          <button style="float: right;" class="btn btn-primary" id="cancelaFlete">Cancela Flete</button>
          <button style="float: right;" class="btn btn-primary" id="flete" onclick="limpiar(); flete();">Flete</button>
          <form name="formulario" id="form" action="../cartaFactura/capturaCarta.php" method="post">
          <input type="hidden" value=10 id="contadorSubtotal" />
        </div>
      </header>
      <section>
        <article >
          <table width='60%' border="1" style="float: left; margin-right: 150px">

            <?php for ($i=1; $i <=$contador ; $i++):?>
              <?php if($i==1): ?>
                <tr>
                  <th colspan=9 align='center'>FORMATO CARTA FACTURA</th>
                </tr>
                <tr>
                  <th>TIPO</th>
                  <td colspan=2>
                    <select name="tipo" onchange="folio(this.value)" id="tipo" required>
                      <option value=""></option>
                      <option value="1. Carta Factura">1. Carta Factura</option>
                      <option value="2. Factor 3">2. Factor 3</option>
                    </select>
                  </td>
                  <th style="width:25px" colspan=2>FOLIO</th>
                  <td align='center' id='folio' style="width:20px" colspan=2></td>
                  <th style="width:25px">CLIENTE</th>
                  <td style="width:30px" align='center'><input type='number' min=1 max=4000 class='cliente' id="clienteValor" name='cliente' required value="<?= $cliente?>" readonly/></td>
                </tr>
                <tr>
                  <th colspan=2>FOLIO PEDIDO</th>
                  <td colspan=2 id="pedido"><?= $folioPedido?></td>
                  <th style="width:50px" colspan="2" >DESCUENTO</th>
                  <td align='center' id='descuento' style="width:100px;" colspan=3><?= $descuentodeCliente . "%"?></td>
                </tr>
                <tr>
                  <th colspan=9 id="cliente">NOMBRE: <?= $nombre?></th>
                </tr>
                <tr>
                    <th colspan=9 align='center'>PRODUCTOS</th>
                </tr>
                <tr>
                  <th align='center'>CANTIDAD</th>
                  <th align='center'>DESCONTAR</th>
                  <th align='center'>CLAVE</th>
                  <th colspan=4 align='center'>DESCRIPCION</th>
                  <th align='center'>COSTO</th>
                  <th align='center'>IMPORTE</th>
                </tr>
                <tr>
                      <td align='center'>
                        <input type='number'id="cantidad<?= $i?>" name="cantidad<?= $i?>" class="cantidad<?= $i?>" min=1
                          readonly value="<?= $cantidad[$i]?>"/>
                      </td>
                      <td align='center'><input type="button" class="boton" value="-" id="descontar<?= $i?>" /></td>
                      <td align='center'>
                        <input type='text'  id="clave<?= $i?>"  name="clave<?= $i?>" class="clave<?= $i?>" readonly value="<?= $clave[$i]?>"/>
                      </td>
                      <td align='left' colspan=4><input type="text" id="descripcion<?= $i?>" name="descripcion<?= $i?>" value="<?= $descripcion[$i]?>" readonly /></td>
                      <td align='center'><input type="text" id="costo<?= $i?>" name="costo<?= $i?>" value="<?= "$" . number_format($costo[$i], 2, '.', ',')?>" readonly /></td>
                      <td align='center'><input type="text" id="importeNota<?= $i?>" name="importeNota<?= $i?>" value="<?= "$" . number_format($importe[$i], 2, '.', ',')?>" readonly/></td>
                </tr>
           <?php elseif($i<=$cont) :?>
                <tr>
                      <td align='center'>
                        <input type='number'id="cantidad<?= $i?>" name="cantidad<?= $i?>" class="cantidad<?= $i?>" min=1
                          readonly value="<?= $cantidad[$i]?>"/>
                      </td>
                      <td align='center'><input type="button" class="boton" value="-" id="descontar<?= $i?>" /></td>
                      <td align='center'>
                        <input type='text'  id="clave<?= $i?>"  name="clave<?= $i?>" class="clave<?= $i?>" readonly value="<?= $clave[$i]?>"/>
                      </td>
                      <td align='left' colspan=4><input type="text" id="descripcion<?= $i?>" name="descripcion<?= $i?>" value="<?= $descripcion[$i]?>" readonly /></td>
                      <td align='center'><input type="text" id="costo<?= $i?>" name="costo<?= $i?>" value="<?= "$" . number_format($costo[$i], 2, '.', ',')?>" readonly /></td>
                      <td align='center'><input type="text" id="importeNota<?= $i?>" name="importeNota<?= $i?>" value="<?= "$" . number_format($importe[$i], 2, '.', ',')?>" readonly/></td>
                </tr>

            <?php else :?>
              <tr>
                    <td align='center'>&nbsp;</td>
                    <td align='center'>&nbsp;</td>
                    <td align='center'>&nbsp;</td>
                    <td align='left' colspan=4>&nbsp;</td>
                    <td align='center'>&nbsp;</td>
                    <td align='center'>&nbsp;</td>
              </tr>

              <?php endif ?>
                <input type="hidden"  name="lista<?= $i?>" id='lis<?= $i?>' value=""/>
                <input type="hidden"  name="cost<?= $i?>" id="cost<?= $i?>" value="" />
                <input type="hidden"  name="description<?= $i?>" id="description<?= $i?>" value="" />

            <?php endfor?>
            <tr>
              <th colspan=7 rowspan=5 align='center' id=pen></th>
              <th>SUBTOTAL</th>
              <td align='center'><input style="text-align:center" type="text" id="subtotalNota" value="<?= "$" . number_format($subtotal1, 2, '.', ',')?>" readonly /></td>
            </tr>
            <tr>
              <th >DESCUENTO</th>
              <td align='center'><input style="text-align:center" type="text" id="descuentoCarta" value="<?= "$" . number_format($descuentodeCarta, 2, '.', ',')?>" readonly /></td>
            </tr>
            <tr>
              <th>SUBTOTAL</th>
              <td align='center'><input style="text-align:center" type="text" id="subtotalNota2" value="<?= "$" . number_format($subtotal2, 2, '.', ',') ?>" readonly /></td>
            </tr>
            <tr>
              <th>IVA</th>
              <td align='center'><input style="text-align:center" type="text" id="iva" value="<?= "$" . number_format($ivaCarta, 2, '.', ',')?>" readonly /></td>
            </tr>
            <tr>
              <th>TOTAL</th>
              <td align='center'><input style="text-align:center" type="text" id="totalNota" value="<?= "$" . number_format($total, 2, '.', ',')?>" readonly /></td>
            </tr>

              <tr>
                <td colspan=8 align='center'><input class="btn btn-primary" type='submit' id='captura' value='Capturar' /></td>
              </tr>
              <tr>
                <input type="hidden" id="prueba" name="prueba"/>
                <input type="hidden" id='contador' name="contador" value=<?= $cont?> />
                <input type="hidden" id="consecutivo" name="consecutivo" value="" />
                <input type="hidden" id="descuentoConsulta" name="descuentoConsulta" value="" />
                <input type="hidden" id="fletes" name="flete" value="" />
                </form>
              </tr>

          </table>
        </article>

      <input type="hidden" id="tester" class="prueba" value="" readonly/>
      <!--</div>-->

      <?php for ($i=0; $i < 10; $i++):?>
        <br />
      <?php endfor?>


      <aside>
        <div style="float: right; margin-right: 70px" id="listas"></div>
      </aside>
    </section>

  <!-- <script src="ajax/eventos/validar.js"></script> -->
  <script src="ajax/eventos/contador.js"></script>
  <script src="ajax/eventos/descuento.js"></script>
  <script src="ajax/eventos/subtotalNota.js"></script>
  <script src="ajax/eventos/actualizaConDescuento.js"></script>
  <script src="ajax/eventos/productoNoValido.js"></script>
  <script src="ajax/eventos/productoRepetido.js"></script>
  <!-- <script src="ajax/eventos/activaCasillas.js"></script> -->
  <script src="ajax/eventos/cierreInactividad.js"></script>
  <script src="ajax/eventos/muestraFilas.js"></script>
  <script src="ajax/eventos/descontar.js"></script>
  <script>

    var lis = [];
    // for (var i = 1; i <=25; i++)
    // {
    //   lis[i] = "PRODUCTOS1";
    //   document.getElementById('lis'+i).value = lis[i];
    // }

        $(document).ready(function(){

          $("#tipo").change(function(){
            var tipo = document.getElementById('tipo').value;
            // var consecutivo = document.getElementById('folio').innerText;
            // alert(consecutivo);

            if(tipo==""||tipo=="1. Carta Factura"){
              var iva = $("#iva").val();
              iva = iva.replace(',', '');
              iva = iva.split("$");
              iva = iva[1];
              var subtotal = $("#subtotalNota2").val();
              subtotal = subtotal.replace(',','');
              subtotal = subtotal.split("$");
              subtotal = subtotal[1];
              if(iva==0){
                iva = Math.round((subtotal*.16)*100)/100;
                total = parseFloat(iva)+parseFloat(subtotal);
                total = Math.round(total*100)/100;
                $("#iva").val(formatNumber.new(iva, "$"));
                $("#totalNota").val(formatNumber.new(total, "$"));
              }
            }
            else{
              var iva = $("#iva").val();
              iva = iva.replace(',', '');
              iva = iva.split("$");
              iva = iva[1];
              var subtotal = $("#subtotalNota2").val();
              subtotal = subtotal.replace(',','');
              subtotal = subtotal.split("$");
              subtotal = subtotal[1];
              if(iva!=0){
                $("#iva").val(formatNumber.new(0, "$"));
                $("#totalNota").val(formatNumber.new(subtotal,"$"));
              }

            }

          var descuento = $("#descuento").text();
          // console.log(descuento);
          descuento = descuento.split("%");
          descuento = descuento[0];
          $("#descuentoConsulta").val(descuento);
          });

          $("#tipo").blur(function(){
            var consecutivo = document.getElementById('pedido').innerText;
            $("#consecutivo").val(consecutivo);

          });

          // alert("Prueba");
          var contador = document.getElementById('contador').value;

          $("#visualizar").click(function(){

            var gerente = document.getElementById('gerente').value;
            setTimeout("location.href='visualizarCartas.php'", 500);
          });

          $("#home").click(function(){

            setTimeout("location.href='../home.php'", 500);
          });

          $("#cancelaFlete").click(function(){

            $("#pen").text("");
            $("#flete").val(0);
          });




        });

        var formatNumber = {
           separador: ",", // separador para los miles
           sepDecimal: '.', // separador para los decimales
           formatear:function (num){
           num +='';
           var splitStr = num.split('.');
           var splitLeft = splitStr[0];
           var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
           var regx = /(\d+)(\d{3})/;
           while (regx.test(splitLeft)) {
           splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
           }
           return this.simbol + splitLeft +splitRight;
           },
           new:function(num, simbol){
           this.simbol = simbol ||'';
           return this.formatear(num);
           }
        }

        // function totalSub(importe, descuento){
        //   var x = descuento/100;
        //   var y = importe-(importe*x);
        //   var z = Math.round(y*100)/100;
        //   return z;
        // }

        function saludo(){
          alert("Oraleee Muchachon!!!");
        }

  </script>

</body>
</html>
