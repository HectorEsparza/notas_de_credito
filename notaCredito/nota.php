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
  <title>Nota</title>
  <script type="text/javascript" src="ajax/js/tipo_dev.js"></script>
  <script type="text/javascript" src="ajax/js/cliente.js"></script>
  <script type="text/javascript" src="ajax/js/descuento.js"></script>
  <!-- <script type="text/javascript" src="ajax/js/importe.js"></script> -->
  <script type="text/javascript" src="ajax/js/limpiar.js"></script>
  <script type="text/javascript" src="ajax/js/listas.js"></script>
  <script type="text/javascript" src="ajax/js/costo.js"></script>
  <script type="text/javascript" src="ajax/js/nuevo_costo.js"></script>
  <script type="text/javascript" src="ajax/js/nuevo_costo2.js"></script>
  <script type="text/javascript" src="ajax/js/permiso.js"></script>
  <script type="text/javascript" src="ajax/js/importe2.js"></script><!--Para la nueva columna agregada en la nota, "IMPORTE"-->
  <script type="text/javascript" src="ajax/js/subtotal.js"></script><!--Para la nueva columna agregada en la nota, "SUBTOTAL"-->
  <script type="text/javascript" src="ajax/js/nvo_subtotal.js"></script><!--Calcula el subtotal cuando se cambia de lista"-->
  <script type="text/javascript" src="ajax/js/nvo_importe.js"></script><!--Calcula el importe cuando se cambia la lista"-->
  <script type="text/javascript" src="ajax/js/cambioSubtotal.js"></script><!--Calcula el subtotal cuando se cambia la cantidad"-->
  <script type="text/javascript" src="ajax/js/cambioImporte.js"></script><!--Calcula el importe cuando se cambia la cantidad"-->
  <script type="text/javascript" src="ajax/js/listaDescuentos.js"></script><!--Permite visualizar los diferentes descuentos que se manejan-->
  <script type="text/javascript" src="ajax/js/cambioDescuento.js"></script><!--Permite cambiar el descuento-->
  <script type="text/javascript" src="ajax/js/cambioDescuento2.js"></script><!--Permite cambiar el descuento, para usuarios sin permisos-->
  <script type="text/javascript" src="ajax/js/penalizacion.js"></script><!--Muestra una tabla para poder seleccionar el porcentaje de la penalizacion-->
  <script type="text/javascript" src="ajax/js/calculoPenalizacion.js"></script><!--Calcula la penalización que se va a aplicar-->
  <script type="text/javascript" src="ajax/js/informacionPenalizacion.js"></script><!--Despliega la información de la penalización en forma de tabla-->
  <script type="text/javascript" src="ajax/js/cancelaPenalizacion.js"></script><!--Cancela la penalización que ya se haya aplicado-->
  <script type="text/javascript" src="ajax/js/penalizacion2.js"></script><!--Pasa por una verificación para los usuarios que no tienen permisos-->
  <!-- <script type="text/javascript" src="ajax/js/folioRecepcion.js"></script><Verifica si el folio de recepcion no esta repetido-->
  <script type="text/javascript" src="ajax/js/subtotalesListas.js"></script><!--Verifica si el folio de recepcion no esta repetido-->

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
            Generar Nueva Nota de Crédito
          </h1>
        <!-- </div>
        <div class="container col-md-4"> -->

          <form action='cierre.php'>
            <input style="float: right; margin-right: 0px;" class="btn btn-primary" type='submit' value='Cierra Sesión' />
          </form>
          <!-- <form action='visualizacion.php'> -->
          <button style="float: right;" class="btn btn-primary" id="visualizar">Visualizar Notas</button>
          <button style="float: right; display: none;" class="btn btn-primary" id="cancelaPenalizacion">Cancela Penalización</button>
          <button style="float: right; display: none;" class="btn btn-primary"  id="penalizacion" >Penalización</button>
          <!-- </form> -->
          <form name="formulario" id="form" action="captura.php" method="post">
          <input type="hidden" value=10 id="contadorSubtotal" />
        </div>
      </header>
      <section>
        <article >
          <table width='75%' border="1" align='left'>

            <?php for ($i=1; $i <=25 ; $i++):?>
              <?php if($i==1): ?>
                <tr>
                  <th colspan=12 align='center'>REPORTE DE ENTRADA DE MERCANCIA <input  type="button" class="boton" value=25 id="formatoPartidas"></th>
                </tr>
                <tr>
                  <th style="width:25px">TIPO</th>
                  <td align='center' style="width:50px">
                    <select id='tipo' name='tipo' required>
                      <option value=''></option>
                      <option value='Devolución Parcial'>1.Devolución Parcial</option>
                      <option value='Factura Completa'>2.Factura Completa</option>
                      <option value='Entrada Caja'>3.Entrada Caja</option>
                      <option value='Factor 3'>4.Factor 3</option>
                      <option value='Cambio Físico'>5.Cambio Físico</option>
                      <option value='Entrada Caja Factor 3'>6.Entrada Caja Factor 3</option>
                      <option value='Muestra'>7.Muestra</option>
                    </select>
                  </td>
                  <th style="width:25px">FOLIO</th>
                  <td align='center' id='folio' style="width:20px"></td>
                  <th style="width:100px">FOLIO REC.</th>
                  <td align='center' style="width:50px"><input style="width:50px" type='number' min=0 id="folioRecepcion" name= "folioRecepcion" required readonly /></td>
                  <th style="width:75px">NO. FACT</th>
                  <td style="width:70px" align='center'><input type='text' id="factura" name='factura' style="width:70px" required readonly/></td>
                  <th style="width:25px">CLIENTE</th>
                  <td style="width:30px" align='center'><input type='number' min=1 max=4000 class='cliente' id="clienteValor" name='cliente' required readonly/>
                  </td>
                  <th style="width:50px">DESCUENTO</th>
                  <td align='center' id='descuento' style="width:100px;"></td>
                </tr>
                <tr>
                  <th colspan=12 id="cliente">NOMBRE: </th>
                </tr>
                <tr>
                  <th colspan=12 id="motivoPrincipal">
                    <label>MOTIVO: </label>
                    <select name="motivo" required>
                      <option value=""></option>
                      <option value="ERROR AL SOLICITAR">ERROR AL SOLICITAR</option>
                      <!-- <option value="CAMBIO FÍSICO">CAMBIO FÍSICO</option> -->
                      <option value="ERROR DE VENTAS">ERROR DE VENTAS</option>
                      <option value="DEFECTO DE FÁBRICA">DEFECTO DE FÁBRICA</option>
                      <option value="MUESTRAS">MUESTRAS</option>
                      <option value="RECUPERACIÓN DE MERCANCÍA">RECUPERACIÓN DE MERCANCÍA</option>
                      <option value="REFACTURACIÓN">REFACTURACIÓN</option>
                      <option value="POR FALTA DE CANCELACIÓN EN EL MES">POR FALTA DE CANCELACIÓN EN EL MES</option>
                      <option value="PRECIO MÁS CARO">PRECIO MÁS CARO</option>
                      <option value="CAMBIO RAZÓN SOCIAL">CAMBIO RAZÓN SOCIAL</option>
                      <option value="PRECIO ESPECIAL">PRECIO ESPECIAL</option>
                      <option value="NO CORRESPONDE LA ESPECIFICACIÓN">NO CORRESPONDE LA ESPECIFICACIÓN</option>
                      <option value="ERROR DE ALMACÉN">ERROR DE ALMACÉN</option>
                    </select>
                  </th>
                </tr>
                <tr>
                    <th colspan=12 align='center'>PRODUCTOS </th>
                </tr>
                <tr>
                  <th colspan=2 align='center'>CANTIDAD</th>
                  <th colspan=2 align='center'>CLAVE</th>
                  <th colspan=2 align='center'>DEVOLUCION</th>
                  <th colspan=2 align='center'>COSTO</th>
                  <th colspan=2 align='center'>IMPORTE</th>
                  <th colspan=2 align='center'>SUBTOTAL</th>

                </tr>
                <tr>
                      <td align='center' colspan=2>
                        <input type='number'id="cantidad<?= $i?>" name="cantidad<?= $i?>" class="cantidad<?= $i?>" min=1
                          oninput="cambioImporte(document.querySelector('.cantidad<?= $i?>').value, document.getElementById('costo<?= $i?>').innerText, <?= $i?>);
                          cambioSubtotal(document.querySelector('.cantidad<?= $i?>').value, document.getElementById('costo<?= $i?>').innerText, document.getElementById('descuento').innerText, <?= $i?>)"readonly />
                      </td>
                      <td align='center' colspan=2>
                        <input type='text'  id="clave<?= $i?>"  name="clave<?= $i?>" class="clave<?= $i?>"
                        oninput="costo(<?= $i?>, document.querySelector('.clave<?= $i?>').value,  document.getElementById('user').value);importe(<?= $i?>, document.querySelector('.cantidad<?= $i?>').value, document.querySelector('.clave<?= $i?>').value);
                                subtotal(<?= $i?>, document.querySelector('.cantidad<?= $i?>').value, document.querySelector('.clave<?= $i?>').value, document.getElementById('descuento').innerText)" readonly />
                      </td>
                      <td align='center' colspan=2 >
                        <select id="devolucion<?= $i?>" name="devolucion<?= $i?>" disabled required>
                          <option value=""></option>
                          <option value="Merma">Merma</option>
                          <option value="Almacen">Almacen</option>
                        </select>
                      </td>
                      <td align='center' colspan=2 id="costo<?= $i?>">
                        <input type='button' class="boton" value='?' onclick="listas(document.querySelector('.clave<?= $i?>').value,<?= $i?>, document.getElementById('user').value);" />
                      </td>
                      <td align='center' colspan=2 id="importeNota<?= $i?>">
                      </td>
                      <td align='center' colspan=2 id="subtotal<?= $i?>">
                      </td>
                      <input type="hidden"  name="subtotalPenalizacion<?= $i?>" id='subtotalPenalizacion<?= $i?>' value=""/>

                </tr>

            <?php elseif($i>1 && $i<=10) :?>
              <tr>
                    <td align='center' colspan=2>
                      <input type='number'id="cantidad<?= $i?>" name="cantidad<?= $i?>" class="cantidad<?= $i?>" min=1
                      oninput="importe(<?= $i?>, document.querySelector('.cantidad<?= $i?>').value, document.querySelector('.clave<?= $i?>').value);
                              subtotal(<?= $i?>, document.querySelector('.cantidad<?= $i?>').value, document.querySelector('.clave<?= $i?>').value, document.getElementById('descuento').innerText)" readonly />
                    </td>
                    <td align='center' colspan=2>
                      <input type='text'  id="clave<?= $i?>" name="clave<?= $i?>" class="clave<?= $i?>"
                      oninput="costo(<?= $i?>, document.querySelector('.clave<?= $i?>').value,  document.getElementById('user').value);importe(<?= $i?>, document.querySelector('.cantidad<?= $i?>').value, document.querySelector('.clave<?= $i?>').value);
                              subtotal(<?= $i?>, document.querySelector('.cantidad<?= $i?>').value, document.querySelector('.clave<?= $i?>').value, document.getElementById('descuento').innerText)" readonly />
                    </td>
                    <td align='center' colspan=2 >
                      <select id="devolucion<?= $i?>" name="devolucion<?= $i?>" disabled>
                        <option value=""></option>
                        <option value="Merma">Merma</option>
                        <option value="Almacen">Almacen</option>
                      </select>
                    </td>
                    <td align='center' colspan=2 id="costo<?= $i?>">
                      <input type='button' class="boton" value='?' onclick="listas(document.querySelector('.clave<?= $i?>').value,<?= $i?>, document.getElementById('user').value);" />
                    </td>
                    <td align='center' colspan=2 id="importeNota<?= $i?>">
                    </td>
                    <td align='center' colspan=2 id="subtotal<?= $i?>">
                    </td>
                    <input type="hidden"  name="subtotalPenalizacion<?= $i?>" id='subtotalPenalizacion<?= $i?>' value=""/>


              </tr>
            <?php else: ?>

              <tr id="muestraFilas<?= $i?>" hidden>
                    <td align='center' colspan=2>
                      <input type='number'id="cantidad<?= $i?>" name="cantidad<?= $i?>" class="cantidad<?= $i?>" min=1
                      oninput="importe(<?= $i?>, document.querySelector('.cantidad<?= $i?>').value, document.querySelector('.clave<?= $i?>').value);
                              subtotal(<?= $i?>, document.querySelector('.cantidad<?= $i?>').value, document.querySelector('.clave<?= $i?>').value, document.getElementById('descuento').innerText)" readonly />
                    </td>
                    <td align='center' colspan=2>
                      <input type='text'  id="clave<?= $i?>" name="clave<?= $i?>" class="clave<?= $i?>"
                      oninput="costo(<?= $i?>, document.querySelector('.clave<?= $i?>').value,  document.getElementById('user').value);importe(<?= $i?>, document.querySelector('.cantidad<?= $i?>').value, document.querySelector('.clave<?= $i?>').value);
                              subtotal(<?= $i?>, document.querySelector('.cantidad<?= $i?>').value, document.querySelector('.clave<?= $i?>').value, document.getElementById('descuento').innerText)" readonly />
                    </td>
                    <td align='center' colspan=2 >
                      <select id="devolucion<?= $i?>" name="devolucion<?= $i?>" disabled>
                        <option value=""></option>
                        <option value="Merma">Merma</option>
                        <option value="Almacen">Almacen</option>
                      </select>
                    </td>
                    <td align='center' colspan=2 id="costo<?= $i?>">
                      <input type='button' class="boton" value='?' onclick="listas(document.querySelector('.clave<?= $i?>').value,<?= $i?>, document.getElementById('user').value);" />
                    </td>
                    <td align='center' colspan=2 id="importeNota<?= $i?>">
                    </td>
                    <td align='center' colspan=2 id="subtotal<?= $i?>">
                    </td>
                    <input type="hidden"  name="subtotalPenalizacion<?= $i?>" id='subtotalPenalizacion<?= $i?>' value=""/>


              </tr>

                <?php endif ?>
                <input type="hidden"  name="lista<?= $i?>" id='lis<?= $i?>' value=""/>
                <input type="hidden"  name="cost<?= $i?>" id="cost<?= $i?>" value="" />

            <?php endfor?>
            <tr>
              <th colspan=8 rowspan=3 align='center' id=pen></th>
              <th colspan=2>SUBTOTAL</th>
              <td colspan=2 align='center'><input style="text-align:center" type="text" id="subtotalNota" readonly  value="$0"/></td>
            </tr>
            <tr>
              <th colspan=2>IVA</th>
              <td colspan=2 align='center'><input style="text-align:center" type="text" id="iva" readonly value="$0"/></td>
            </tr>
            <tr>
              <th colspan=2>TOTAL</th>
              <td colspan=2 align='center'><input style="text-align:center" type="text" id="totalNota" readonly value="$0"/></td>
            </tr>

              <tr>
                <th colspan=12 align='center'>OBSERVACIONES</th>
              </tr>
              <tr>
                <td colspan=9 align='center'><textarea name='observaciones' rows=2 cols=50 style='font-size:20px; font-type:Arial' placeholder="Breve descripción..." ></textarea></td>
                <td colspan=3 align='center'><input class="btn btn-primary" type='submit' id='captura' value='Capturar' /></td>
                <!-- <td align='center'><input type='button' class="btn btn-primary" id='penalizacion' value='10% Penalización' /></td> -->
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

            </form>

          </table>
        </article>

      <input type="hidden" id="tester" class="prueba" value="" readonly/>
      <!--</div>-->

      <?php for ($i=0; $i < 10; $i++):?>
        <br />
      <?php endfor?>


      <aside>
        <div style="float: right; margin-right: 0px" id="listas"></div>
      </aside>
    </section>
  <script src="ajax/eventos/motivo.js"></script>
  <script src="ajax/eventos/validar.js"></script>
  <script src="ajax/eventos/contador.js"></script>
  <script src="ajax/eventos/descuento.js"></script>
  <script src="ajax/eventos/subtotalNota.js"></script>
  <script src="ajax/eventos/actualizaConDescuento.js"></script>
  <script src="ajax/eventos/consecutivo.js"></script>
  <script src="ajax/eventos/productoNoValido.js"></script>
  <script src="ajax/eventos/productoRepetido.js"></script>
  <script src="ajax/eventos/activaCasillas.js"></script>
  <script src="ajax/eventos/cierreInactividad.js"></script>
  <script src="ajax/eventos/clickDescuento.js"></script>
  <script src="ajax/eventos/muestraFilas.js"></script>



  <script src="ajax/eventos/costo_event.js"></script>
  <script>

    // var tipoDevolucion = document.getElementById('tipo');
    // // var valorDevolucion = document.getElementById('tipo').value;
    // tipoDevolucion.addEventListener('change', folio(document.getElementById('tipo').value));
    // addEventListener(document, "touchstart", function(e) {
    //   console.log(e.defaultPrevented);  // will be false
    //   e.preventDefault();   // does nothing since the listener is passive
    //   console.log(e.defaultPrevented);  // still false
    // }, Modernizr.passiveeventlisteners ? {passive: true} : false);
    var lis = [];
    for (var i = 1; i <=25; i++)
    {
      lis[i] = "PRODUCTOS1";
      document.getElementById('lis'+i).value = lis[i];
    }

    var formulario = document.getElementsByName('formulario')[0],
        elementos = formulario.elements;

        //Esta funcion recupera el texto del costo para convertirlo en flotante
        function convertir(costo)
        {
          //Recibimos el costo en forma de texto
          var texto, subcadena, numero;
          texto = costo;
          //Separamos el texto en dos cadenas y nos quedamos con la cadena que contiene solo numeros
          subcadena = texto.split("$");
          //Remplasamos las comas del texto por vacio y hacemos la conversion a flotante
          numero = parseFloat(subcadena[1].replace(',', ""));
          //Retornamos el numero ya en forma flotante listo para hacer operaciones con el
          return numero;
        }

        var costo_event = function()
        {
          if(document.getElementById('costo1').innerText!="")
          {
            document.getElementById('cost1').value = convertir(document.getElementById('costo1').innerText);
          }
          if(document.getElementById('costo2').innerText!="")
          {
            document.getElementById('cost2').value = convertir(document.getElementById('costo2').innerText);
          }
          if(document.getElementById('costo3').innerText!="")
          {
            document.getElementById('cost3').value = convertir(document.getElementById('costo3').innerText);
          }
          if(document.getElementById('costo4').innerText!="")
          {
            document.getElementById('cost4').value = convertir(document.getElementById('costo4').innerText);
          }
          if(document.getElementById('costo5').innerText!="")
          {
            document.getElementById('cost5').value = convertir(document.getElementById('costo5').innerText);
          }
          if(document.getElementById('costo6').innerText!="")
          {
            document.getElementById('cost6').value = convertir(document.getElementById('costo6').innerText);
          }
          if(document.getElementById('costo7').innerText!="")
          {
            document.getElementById('cost7').value = convertir(document.getElementById('costo7').innerText);
          }
          if(document.getElementById('costo8').innerText!="")
          {
            document.getElementById('cost8').value = convertir(document.getElementById('costo8').innerText);
          }
          if(document.getElementById('costo9').innerText!="")
          {
            document.getElementById('cost9').value = convertir(document.getElementById('costo9').innerText);
          }
          if(document.getElementById('costo10').innerText!="")
          {
            document.getElementById('cost10').value = convertir(document.getElementById('costo10').innerText);
          }
          if(document.getElementById('costo11').innerText!="")
          {
            document.getElementById('cost11').value = convertir(document.getElementById('costo11').innerText);
          }
          if(document.getElementById('costo12').innerText!="")
          {
            document.getElementById('cost12').value = convertir(document.getElementById('costo12').innerText);
          }
          if(document.getElementById('costo13').innerText!="")
          {
            document.getElementById('cost13').value = convertir(document.getElementById('costo13').innerText);
          }
          if(document.getElementById('costo14').innerText!="")
          {
            document.getElementById('cost14').value = convertir(document.getElementById('costo14').innerText);
          }
          if(document.getElementById('costo15').innerText!="")
          {
            document.getElementById('cost15').value = convertir(document.getElementById('costo15').innerText);
          }
          if(document.getElementById('costo16').innerText!="")
          {
            document.getElementById('cost16').value = convertir(document.getElementById('costo16').innerText);
          }
          if(document.getElementById('costo17').innerText!="")
          {
            document.getElementById('cost17').value = convertir(document.getElementById('costo17').innerText);
          }
          if(document.getElementById('costo18').innerText!="")
          {
            document.getElementById('cost18').value = convertir(document.getElementById('costo18').innerText);
          }
          if(document.getElementById('costo19').innerText!="")
          {
            document.getElementById('cost19').value = convertir(document.getElementById('costo19').innerText);
          }
          if(document.getElementById('costo20').innerText!="")
          {
            document.getElementById('cost20').value = convertir(document.getElementById('costo20').innerText);
          }
          if(document.getElementById('costo21').innerText!="")
          {
            document.getElementById('cost21').value = convertir(document.getElementById('costo21').innerText);
          }
          if(document.getElementById('costo22').innerText!="")
          {
            document.getElementById('cost22').value = convertir(document.getElementById('costo22').innerText);
          }
          if(document.getElementById('costo23').innerText!="")
          {
            document.getElementById('cost23').value = convertir(document.getElementById('costo23').innerText);
          }
          if(document.getElementById('costo24').innerText!="")
          {
            document.getElementById('cost24').value = convertir(document.getElementById('costo24').innerText);
          }
          if(document.getElementById('costo25').innerText!="")
          {
            document.getElementById('cost25').value = convertir(document.getElementById('costo25').innerText);
          }
        }

        formulario.addEventListener("submit", costo_event);

        $(document).ready(function(){

          $("#visualizar").click(function(){

            var gerente = document.getElementById('gerente').value;
            setTimeout("location.href='visualizacion.php'", 500);
          });

          $("#folioRecepcion").blur(function(){

            var valor = $("#folioRecepcion").val();
            console.log("Entramos con el folio "+valor);
            if(valor==""){
              alert("El folio de recepción introducido ya existe en la base de datos");
            }
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
        // $(document).ready(function(){
        //   var prueba = $("#listas").children($("#cancelaciondePen")).val();
        //     alert(prueba);
        //
        // });
        // $(document).ready(function(){
        //
        //   var cancelaPenalizacion = $("#cancelaPenalizacion");
        //   cancelaPenalizacion.click(enviar);
        //
        //   function enviar(){
        //     // var total = $("#totalNota").val();
        //     // var penalizacion = $("#penalizacionNota").val();
        //     // console.log(total);
        //     var parametros =
        //     {
        //       total: $("#totalNota").val(),
        //       penalizacion: $("#penalizacionNota").val()
        //     }
        //     $.ajax({
        //         async: true, //Activar la transferencia asincronica
        //         type: "POST", //El tipo de transaccion para los datos
        //         dataType: "html", //Especificaremos que datos vamos a enviar
        //         contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
        //         url: "cancelaPenalizacion.php", //Sera el archivo que va a procesar la petición AJAX
        //         data: parametros, //Datos que le vamos a enviar
        //         // data: "total="+total+"&penalizacion="+penalizacion,
        //         beforeSend: inicioEnvio, //Es la función que se ejecuta antes de empezar la transacción
        //         success: llegada, //Función que se ejecuta en caso de tener exito
        //         timeout: 4000,
        //         error: problemas //Función que se ejecuta si se tiene problemas al superar el timeout
        //     });
        //     return false;
        //   }
        //   function inicioEnvio(){
        //       var cargando = $("#totalNota");
        //       cargando.val("Cargando...");
        //   }
        //
        //   function llegada(datos){
        //       $("#totalNota").val(datos);
        //       $("#cancelaPenalizacion").hide();
        //       $("#pen").text("");
        //   }
        //
        //   function problemas(){
        //       $("#totalNota").val("Problemas en el servidor");
        //   }
        // });

  </script>

</body>
</html>
