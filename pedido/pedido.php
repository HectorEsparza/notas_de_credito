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
  <title>Pedido</title>

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
    $base = null;
    if(!isset($usuario)){
      header("location:../index.html");
    }
  ?>


      <input type="hidden" id='user' value=<?= $user?> />
      <input type="hidden" id='gerente' value=<?= $gerente?> />

      <header class="row" style="margin-top: 0px;">
        <div class="container col-md-12">
          <input type='button' id="home" class="btn btn-primary" style='background:url("imagenes/home3.jpg"); float: left; width: 50px; height: 50px;' />
          <img src='imagenes/apa.jpg' style="float: left;">
          <h1 align='center'>
            Generar Nuevo Pedido
          </h1>
        <!-- </div>
        <div class="container col-md-4"> -->

          <form action='cierre.php'>
            <input style="float: right; margin-right: 0px;" class="btn btn-primary" type='submit' value='Cierra Sesión' />
          </form>
          <!-- <form action='visualizacion.php'> -->
          <button style="float: right;" class="btn btn-primary" id="visualizar">Visualizar Pedidos</button>
          <!-- </form> -->
          <form name="formulario" id="form" action="capturaPedido.php" method="post">
          <input type="hidden" value=10 id="contadorSubtotal" />
        </div>
      </header>
      <section>
        <article >
          <table width='60%' border="1" style="float: left; margin-right: 150px">
          <!-- <table width='60%' border="1" align='left'> -->

            <?php for ($i=1; $i <=24 ; $i++):?>
              <?php if($i==1): ?>
                <tr>
                  <th colspan=8 align='center'>PEDIDO<input  type="button" class="boton" value=24 id="formatoPartidas"></th>
                </tr>
                <tr>
                  <th style="width:25px">FOLIO</th>
                  <td align='center' id='folio' style="width:20px"><?= folioPedidos(); ?></td>
                  <th style="width:25px" colspan="2" >CLIENTE</th>
                  <td style="width:30px" align='center'><input type='number' min=1 max=4000 class='cliente' id="clienteValor" name='cliente' required
                    oninput="cli(document.querySelector('.cliente').value);
                           desc(document.querySelector('.cliente').value)" />
                  </td>
                  <th style="width:50px" colspan="2" >DESCUENTO</th>
                  <td align='center' id='descuento' style="width:100px;"></td>
                </tr>
                <tr>
                  <th colspan=8 id="cliente">NOMBRE: </th>
                </tr>
                <tr>
                    <th colspan=8 align='center'>PRODUCTOS </th>
                </tr>
                <tr>
                  <th align='center'>CANTIDAD</th>
                  <th align='center'>CLAVE</th>
                  <th colspan=4 align='center'>DESCRIPCION</th>
                  <th align='center'>COSTO</th>
                  <th align='center'>IMPORTE</th>
                </tr>
                <tr>
                      <td align='center'>
                        <input type='number'id="cantidad<?= $i?>" name="cantidad<?= $i?>" class="cantidad<?= $i?>" min=1
                          oninput="cambioImporte(document.querySelector('.cantidad<?= $i?>').value, document.getElementById('costo<?= $i?>').innerText, <?= $i?>);"readonly />
                      </td>
                      <td align='center'>
                        <input type='text'  id="clave<?= $i?>"  name="clave<?= $i?>" class="clave<?= $i?>"
                        oninput="costo(<?= $i?>, document.querySelector('.clave<?= $i?>').value,  document.getElementById('user').value);importe(<?= $i?>, document.querySelector('.cantidad<?= $i?>').value, document.querySelector('.clave<?= $i?>').value);
                        descripcion(<?= $i?>, document.querySelector('.cantidad<?= $i?>').value, document.querySelector('.clave<?= $i?>').value, document.getElementById('descuento').innerText);" readonly />
                      </td>
                      <td align='left' colspan=4 style="font-size: 12px;" id="descripcion<?= $i?>"></td>
                      <td align='center' id="costo<?= $i?>">
                        <input type='button' class="boton" value='?' onclick="listas(document.querySelector('.clave<?= $i?>').value,<?= $i?>, document.getElementById('user').value);" />
                      </td>
                      <td align='center' id="importeNota<?= $i?>"></td>
                </tr>

            <?php elseif($i>1 && $i<=10) :?>
              <tr>
                    <td align='center'>
                      <input type='number'id="cantidad<?= $i?>" name="cantidad<?= $i?>" class="cantidad<?= $i?>" min=1
                        oninput="cambioImporte(document.querySelector('.cantidad<?= $i?>').value, document.getElementById('costo<?= $i?>').innerText, <?= $i?>)"readonly />
                    </td>
                    <td align='center'>
                      <input type='text'  id="clave<?= $i?>"  name="clave<?= $i?>" class="clave<?= $i?>"
                      oninput="costo(<?= $i?>, document.querySelector('.clave<?= $i?>').value,  document.getElementById('user').value); importe(<?= $i?>, document.querySelector('.cantidad<?= $i?>').value, document.querySelector('.clave<?= $i?>').value);
                      descripcion(<?= $i?>, document.querySelector('.cantidad<?= $i?>').value, document.querySelector('.clave<?= $i?>').value, document.getElementById('descuento').innerText);" readonly />
                    </td>
                    <td align='left' colspan=4 id="descripcion<?= $i?>" style="font-size: 12px;"></td>
                    <td align='center' id="costo<?= $i?>">
                      <input type='button' class="boton" value='?' onclick="listas(document.querySelector('.clave<?= $i?>').value,<?= $i?>, document.getElementById('user').value);" />
                    </td>
                    <td align='center' id="importeNota<?= $i?>"></td>
              </tr>
            <?php else: ?>

              <tr id="muestraFilas<?= $i?>" hidden>
                      <td align='center'>
                        <input type='number'id="cantidad<?= $i?>" name="cantidad<?= $i?>" class="cantidad<?= $i?>" min=1
                          oninput="cambioImporte(document.querySelector('.cantidad<?= $i?>').value, document.getElementById('costo<?= $i?>').innerText, <?= $i?>)"readonly />
                      </td>
                      <td align='center'>
                        <input type='text'  id="clave<?= $i?>"  name="clave<?= $i?>" class="clave<?= $i?>"
                        oninput="costo(<?= $i?>, document.querySelector('.clave<?= $i?>').value,  document.getElementById('user').value);importe(<?= $i?>, document.querySelector('.cantidad<?= $i?>').value, document.querySelector('.clave<?= $i?>').value);
                        descripcion(<?= $i?>, document.querySelector('.cantidad<?= $i?>').value, document.querySelector('.clave<?= $i?>').value, document.getElementById('descuento').innerText);" readonly />
                      </td>
                      <td align='left' colspan=4 id="descripcion<?= $i?>" style="font-size: 12px;"></td>
                      <td align='center' id="costo<?= $i?>">
                        <input type='button' class="boton" value='?' onclick="listas(document.querySelector('.clave<?= $i?>').value,<?= $i?>, document.getElementById('user').value);" />
                      </td>
                      <td align='center' id="importeNota<?= $i?>"></td>
                </tr>

                <?php endif ?>
                <input type="hidden"  name="lista<?= $i?>" id='lis<?= $i?>' value=""/>
                <input type="hidden"  name="cost<?= $i?>" id="cost<?= $i?>" value="" />
                <input type="hidden"  name="description<?= $i?>" id="description<?= $i?>" value="" />

            <?php endfor?>
            <!-- <tr>
              <th colspan=6 rowspan=5 align='center' id=pen></th>
              <th>SUBTOTAL</th>
              <td align='center'><input style="text-align:center" type="text" id="subtotalNota" readonly /></td>
            </tr>
            <tr>
              <th >DESCUENTO</th>
              <td align='center'><input style="text-align:center" type="text" id="descuentoCarta" readonly /></td>
            </tr>
            <tr>
              <th>SUBTOTAL</th>
              <td align='center'><input style="text-align:center" type="text" id="subtotalNota2" readonly /></td>
            </tr>
            <tr>
              <th>IVA</th>
              <td align='center'><input style="text-align:center" type="text" id="iva" readonly /></td>
            </tr> -->
            <tr>
              <th colspan=6 rowspan=5 align='center' id=pen></th>
              <th>TOTAL</th>
              <td align='center'><input style="text-align:center" type="text" id="totalNota" readonly /></td>
            </tr>

              <tr>
                <td colspan=8 align='center'><input class="btn btn-primary" type='submit' id='captura' value='Capturar' /></td>
              </tr>
              <tr>
                <input type="hidden" id="prueba" name="prueba"/>
                <input type="hidden" id='contador' name="contador" value="0" />
                <input type="hidden" id="consecutivo" name="consecutivo" value="" />
                <input type="hidden" id="descuentoConsulta" name="descuentoConsulta" value="" />
                <input type="hidden" id="penalizacionNota" name="penalizacionNota" value="0" />
                <input type="hidden" id="porcentaje" name="porcentaje" value="0" />
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

  <script src="ajax/eventos/validar.js"></script>
  <script src="ajax/eventos/contador.js"></script>
  <script src="ajax/eventos/descuento.js"></script>
  <script src="ajax/eventos/subtotalNota.js"></script>
  <script src="ajax/eventos/actualizaConDescuento.js"></script>
  <script src="ajax/eventos/productoNoValido.js"></script>
  <script src="ajax/eventos/productoRepetido.js"></script>
  <script src="ajax/eventos/activaCasillas.js"></script>
  <script src="ajax/eventos/cierreInactividad.js"></script>
  <script src="ajax/eventos/muestraFilas.js"></script>
  <script>

    var lis = [];
    for (var i = 1; i <=24; i++)
    {
      lis[i] = "PRODUCTOS1";
      document.getElementById('lis'+i).value = lis[i];
    }

        $(document).ready(function(){

          $("#visualizar").click(function(){

            var gerente = document.getElementById('gerente').value;
            setTimeout("location.href='visualizarPedidos.php'", 500);
          });

          $("#home").click(function(){

            setTimeout("location.href='../home.php'", 500);
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

        function totalSub(importe, descuento){
          var x = descuento/100;
          var y = importe-(importe*x);
          var z = Math.round(y*100)/100;
          return z;
        }

        function saludo(){
          alert("Oraleee Muchachon!!!");
        }

  </script>

</body>
</html>
