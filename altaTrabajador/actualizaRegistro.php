<!DOCTYPE html>
<html>
  <head>
    <mete set_charset='utf8' />
    <title>Actualización</title>
    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
  	<link href="css/bootstrap.min.css" rel="stylesheet">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
  	<link rel="stylesheet" type="text/css" href="css/estiloAltas.css" />
    <script type="text/javascript" src="ajax/js/jquery-ui.js"></script>
    <script type="text/javascript" src="ajax/eventos/puestos.js"></script>
    <script type="text/javascript" src="ajax/eventos/insertaDatos.js"></script>
    <script type="text/javascript" src="ajax/eventos/verificaDatos.js"></script>
    <script type="text/javascript" src="ajax/eventos/formularioRecursos.js"></script>
    <script type="text/javascript" src="ajax/eventos/textoMayuscula.js"></script>
    <!-- <script type="text/javascript" src="ajax/eventos/activaSelectores.js"></script> -->


  </head>
  <body>
    <?php session_start();
      $usuario = $_SESSION['user'];
      $acceso = 0;

      require_once("../funciones.php");
      $base = conexion_local();
      $consulta="SELECT DEPARTAMENTO, USUARIO, PERMISO FROM USUARIOS WHERE USUARIO=?";
      $resultado = $base->prepare($consulta);
      $resultado-> execute(array($usuario));
      $registro = $resultado->fetch(PDO::FETCH_NUM);
      $departamento = $registro[0];
      // $departamento = explode("_", $departamento);

      // for ($i=0; $i < count($departamento) ; $i++) {
      //     $auxiliar = $departamento . " " . $departamento[$i];
      // }
      //$departamento = str_replace("_" , " ", $departamento);
      $user = $registro[1];
      $permiso = $registro[2];





      //echo $departamento;
      if(!isset($usuario))
      {
        header("location:../index.html");
      }

      // elseif($departamento=="VENTAS"||$departamento=="CREDITO Y COBRANZA"||$departamento=="RECURSOS HUMANOS"||
      //        $departamento=="CONTABILIDAD"||$departamento=="PRODUCCION SOPORTE"||$departamento=="PRODUCCION MANGUERA")
      // {
      //   $acceso=1;
      //       //echo "Entramos";
      //   //header("location:../home.php");
      // }

      elseif($permiso==2){
        header("location:../home.php");
      }
      $id = $_GET['folio'];
      $documentos = array();

      $base = conexion_local();
      $consulta = "SELECT * FROM DOCUMENTOS WHERE ID=?";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($id));
      //RECUPERANDO DATOS DE LA TABLA DOCUMENTOS
      while ($registro = $resultado->fetch(PDO::FETCH_NUM)){
        for ($i=1; $i < count($registro) ; $i++){
          $documentos[$i] = $registro[$i];
        }
      }
      $contadorDocumentos = count($documentos);


      $resultado->closeCursor();


      $consulta = "SELECT * FROM SOLICITUD WHERE ID=?";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($id));
      //RECUPERANDO DATOS DE LA TABLA SOLICITUD
      while ($registro = $resultado->fetch(PDO::FETCH_NUM)){
        for ($i=1; $i < count($registro) ; $i++){
          $solicitud[$i] = $registro[$i];
        }
      }
      $contadorSolicitud = count($solicitud);
      $resultado->closeCursor();

      $departamentoConsulta = str_replace(" ", "_", $solicitud[2]);
      //echo "El departamento es: " . $departamentoConsulta;
      $consulta = "SELECT NOMBRE, APELLIDO FROM USUARIOS WHERE DEPARTAMENTO=?";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($departamentoConsulta));
      $registro = $resultado->fetch(PDO::FETCH_NUM);
      // echo $departamentoConsulta;
      if($departamentoConsulta=="VENTAS"){
        $firma = "OLIVIA_CRUZ";
      }
      else{
        $firma = $registro[0] . "_" . $registro[1];
      }

      // echo "El gerente es " . $firma;

    ?>
    <header class="row">
  		<div class="container col-md-8">
  			<h1 align='center'>
  				8.0 Solicitud de Ingreso
  			</h1>
  			<input type='button' id="home" class="btn btn-primary" style='background:url("imagenes/home3.jpg"); float: left; width: 50px; height: 50px;' />
  			<div align="center"><img src="imagenes/apa.jpg" /></div>
  		</div>
  		<div class="container col-md-4">
  			<form action='../cierre.php'>
  				<input style="float: right;" class="btn btn-primary" type='submit' value='Cierra Sesión' />
  			</form>
        <input type="button" style="float: right;" class="btn btn-primary" onclick="visualizacion()" value="Cargar Registro" />
  			<input type="button" style="float: right;" class="btn btn-primary" onclick="registro()" id ='new' value='Nuevo Registro' />
        <input type="button" style="float: right;" class="btn btn-primary" onclick="impresion()" id ='impresion' value='Imprimir' />

  		</div>
  	</header>
    <input type="hidden" id='user' value=<?= $user?> />
    <input type="hidden" id='departamento' value=<?= $departamento?> />
    <input type="hidden" id='contadorSolicitud' value=<?= $contadorSolicitud?> />
    <input type="hidden" id='contadorDocumentos' value=<?= $contadorDocumentos?> />
    <input type="hidden" id='firma' value=<?= $firma?> />
    <?for ($i=1; $i <= $contadorDocumentos; $i++) :?>
        <input type="hidden" id="documentos<?= $i?>" value="<?= $documentos[$i]?>" />
    <? endfor?>

    <?for ($i=1; $i <= $contadorSolicitud; $i++) :?>
        <input type="hidden" id="solicitud<?= $i?>" value="<?= $solicitud[$i]?>" />
    <? endfor?>

    <form action="modificandoRegistro.php" method="post" enctype="multipart/form-data">
    <input type="hidden" id='ID' name="ID" value=<?= $id?> />
    <div id="documentos" style="float: left; margin-left: 100px;">
      <h1 align='center'>DOCUMENTOS</h1>
      <table border="1" >
          <tr>
            <th>DOCUMENTOS</th>
            <th>STATUS ENTREGA</th>
          </tr>
          <tr class="colorSolicitud">
            <td>Solicitud Empleo</td>
            <td align='center'>
              <select id="solicitud" name="solicitud">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr class="colorActa">
            <td>Acta Nacimiento</td>
            <td align='center'>
              <select id="acta" name="acta">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr class="colorActa">
            <td>IFE</td>
            <td align='center'>
              <select id="ife" name="ife">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr class="colorComprobante">
            <td>Comprobante Domicilio</td>
            <td align='center'>
              <select id="domicilio" name="domicilio">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr class="colorSeguro">
            <td>Seguro Social</td>
            <td align='center'>
              <select id="seguro" name="seguro">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr class="colorCurp">
            <td>CURP</td>
            <td align='center'>
              <select id="curp" name="curp">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr class="colorRfc">
            <td>Cédula de Identificación Físcal</td>
            <td align='center'>
              <select id="rfc" name="rfc">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <!-- <tr>
            <td>Antecedentes No Penales</td>
            <td align='center'>
              <select id="penales" name="penales">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Fotografías(4)</td>
            <td align='center'>
              <select id="fotos" name="fotos">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Comprobante Estudio</td>
            <td align='center'>
              <select id="estudios" name="estudios">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr> -->
          <tr class="colorInfonavit">
            <td>Crédito Infonavit</td>
            <td align='center'>
              <select id="infonavit" name="infonavit">
                <option value="NO">NO</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr class="colorInfonavit">
            <td>Adeudo Bancomer</td>
            <td align='center'>
              <select id="adeudo" name="adeudo">
                <option value="NO">NO</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr id="botones">
            <td colspan="2" align='center' id="botonGuardar"><input type='submit' id="guardar" value='Guardar' class="btn btn-primary"/></td>
          </tr>
      </table>
      <br />
      <table border="1" id="tablaGerente">
        <tr>
          <th>Gerente del Departamento que solicita el ingreso</th>
        </tr>
        <tr>
          <td id="solicitudGerente" align='center'>&nbsp;</td>
        </tr>
        <tr>
          <th align='center'>Firma</th>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div>
    <div id="solicitud" style="float: left; margin-left: 100px; ">
      <h1>SOLICITUD INGRESO</h1>
      <table border="1" >
        <tr class="solicitudOculto">
          <td align='center'>Fecha de Alta *</td>
          <td align='center'><input type="text" id="fechaAlta" name="fechaAlta" placeholder="Primer día de Trabajo"/></td>
        </tr>
        <tr class="solicitudOculto">
          <td align='center'>Departamento *</td>
          <td align='center'><input type="text" id="vistaDepartamento" name="vistaDepartamento" readonly /></td>
        </tr>
        <tr class="solicitudOculto">
          <td align='center'>Puesto *</td>
          <td align='center'>
            <select id="vistaPuesto" name="vistaPuesto">
            </select></td>
        </tr>
        <tr class="solicitudOculto">
          <td align='center'>Salario Diario *</td>
          <td align='center'><input type="number" step="any" id="salarioDiario" name='salarioDiario' readonly/></td>
        </tr>
        <tr class="solicitudOculto">
          <td align='center'>Salario Semanal *</td>
          <td align='center'><input type="number" step="any" id="salarioSemanal" name='salarioSemanal' readonly/></td>
        </tr>
        <tr class="solicitudOculto">
          <td align='center'>Teléfono *</td>
          <td align='center'><input type="text" id="telefono" name='telefono' /></td>
        </tr>
        <tr class="solicitudOculto">
          <td align='center'>Correo Electrónico</td>
          <td align='center'><input type="text" id="correo" name='correo' placeholder="Opcional" /></td>
        </tr>
        <tr class="solicitudOculto">
          <td align='center'>Emergencia Comunicarse con: *</td>
          <td align='center'><input type="text" id="personaEmergencia" name='personaEmergencia' placeholder='Nombre'/></td>
        </tr>
        <tr class="solicitudOculto">
          <td align='center'>Teléfono Emergencia *</td>
          <td align='center'><input type="text" id="telefonoEmergencia" name='telefonoEmergencia'/></td>
        </tr>
        <tr class="actaOculto">
          <td align='center'>Nombre Completo *</td>
          <td align='center'><input type="text" id="nombre" name="nombre"/></td>
        </tr>
        <tr class="actaOculto">
          <td align='center'>Fecha de Nacimiento *</td>
          <td align='center'><input type="text" id="fechaNacimiento" name='fechaNacimiento' /></td>
        </tr>
        <tr class="actaOculto">
          <td align='center'>Estado Civil *</td>
          <td align='center'>
            <select id="edoCivil" name="edoCivil">
              <option value=""></option>
              <option value="Soltero">Soltero</option>
              <option value="Casado">Casado</option>
              <option value="Unión Libre">Unión Libre</option>
            </select>
          </td>
        </tr>
        <tr class="actaOculto">
          <td align='center'>Sexo *</td>
          <td align='center'>
            <select id="sexo" name="sexo">
              <option value=""></option>
              <option value="Hombre">Hombre</option>
              <option value="Mujer">Mujer</option>
            </select>
          </td>
        </tr>
        <tr class="domicilioOculto">
          <td align='center'>Calle y Número EXT. INT. *</td>
          <td align='center'><input type="text" id="domicilioCaptura" name='domicilioCaptura'/></td>
        </tr>
        <tr class="domicilioOculto">
          <td align='center'>Colonia *</td>
          <td align='center'><input type="text" id="colonia" name='colonia'/></td>
        </tr>
        <tr  class="domicilioOculto">
          <td align='center'>C.P *</td>
          <td align='center'><input type="text" id="cp" name='cp'/></td>
        </tr>
        <tr  class="domicilioOculto">
          <td align='center'>Población *</td>
          <td align='center'><input type="text" id="poblacion" name='poblacion'/></td>
        </tr>
        <tr class="seguroOculto">
          <td align='center'>No. Seguridad Social *</td>
          <td align='center'><input type="text" id="seguridadSocial" name='seguridadSocial'/></td>
        </tr>
        <tr class="curpOculto">
          <td align='center'>CURP *</td>
          <td align='center'><input type="text" id="curpCaptura" name='curpCaptura'/></td>
        </tr>
        <tr class="rfcOculto">
          <td align='center'>RFC *</td>
          <td align='center'><input type="text" id="rfcCaptura" name='rfcCaptura'/></td>
        </tr>
        <tr class="infonavitOculto">
          <td align='center'><label for="pdf">PDF</label></td>
          <td align='center' id="prueba"><input  id="pdf" type="file" name="archivo"/></td>
        </tr>
          <input type="hidden" id="status" name='status' value="" />
      </table>
    </div>
    </form>
    <div id="recursosHumanos" style="float: left; margin-left: 100px;">
      <h1>RECURSOS HUMANOS</h1>
      <form action="formRecursos.php" method="post" enctype="multipart/form-data">
        <table border="1" >
          <tr>
            <td>No. Empleado *</td>
            <td><input type="text" id="noEmpleado" name="noEmpleado"/></td>
          </tr>
          <tr>
            <td>Contrato *</td>
            <td id="contratoFila"><input type="file" id="contrato" name="contrato"/></td>
          </tr>
          <tr>
            <td>IMSS *</td>
            <td id="imssFila"><input type="file" id="imss" name="imss"/></td>
          </tr>
          <tr>
            <td>Tarjeta Si Vale</td>
            <td><input type="text" id="siVale" name="siVale"/></td>
          </tr>
          <tr>
            <td>Antecedentes No Penales</td>
            <td align='center'>
              <select id="penales" name="penales">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Fotografías(4)</td>
            <td align='center'>
              <select id="fotos" name="fotos">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Comprobante Estudio</td>
            <td align='center'>
              <select id="estudios" name="estudios">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr>
            <input type="hidden" id='ID' name="ID" value=<?= $id?> />
            <td colspan="2" align="center"><input type="submit" id="final" class="btn btn-primary"value="Finalizar" disabled/></td>
          </tr>
        </table>
      </form>
    </div>
    <div id="gerente" style="float: left; margin-left: 100px;">
      <h1>Gerente Recursos Humanos</h1>
      <form action="formGerente.php" method="post">
        <table border="1" >
          <tr>
            <td>Bancomer</td>
            <td><input type="text" id="bancomer" name="bancomer"/></td>
          </tr>
          <tr>
          <tr>
            <td>Estatus Actual</td>
            <td id="insertaEstatus"></td>
          </tr>
            <td>Cambia Estatus</td>
            <td>
              <select id="estatusFinal" name="estatusFinal">
                <option value=""></option>
                <option value="Aceptado">Aceptado</option>
                <option value="Rechazado">Rechazado</option>
                <option value="Faltan Documentos">Faltan Documentos</option>
              </select>
            </td>
          </tr>
          <tr>
            <input type="hidden" id='ID' name="ID" value=<?= $id?> />
            <td colspan="2" align="center"><input type="submit" id="autorizacion" class="btn btn-primary" value="Autorizacion" disabled></td>
          </tr>
        </table>
      </form>
    </div>
  <script type="text/javascript">

  			$(document).ready(function(){


  									$("#home").click(function(){

  										setTimeout("location.href='../home.php'", 500);
  									});

                    $('#fecha').datepicker({
                      //dateFormat:'yy-mm-dd'
                      //dateFormat: 'dd-mm-yy'
                      dateFormat: 'dd/mm/yy',
                      changeMonth: true,
                      changeYear: true,
                      yearRange: '1940:2000'
                    });
                    $("#guardar").click(function(){
                      console.log("Entramos");
                      var solicitud = $("#solicitud"),
                          acta = $("#acta"),
                          ife = $("#ife"),
                          domicilio = $("#domicilio"),
                          seguro = $("#seguro"),
                          curp = $("#curp"),
                          rfc = $("#rfc"),
                          penales = $("#penales"),
                          fotos = $("#fotos"),
                          estudios = $("#estudios"),
                          infonavit = $("#infonavit"),
                          adeudo = $("#adeudo");
                      var fechaAlta = $("#fechaAlta"),
                          departamento = $("#vistaDepartamento"),
                          puesto = $("#vistaPuesto"),
                          salarioDiario = $("#salarioDiario"),
                          nombre = $("#nombre"),
                          fechaNacimiento = $("#fechaNacimiento"),
                          edoCivil = $("#edoCivil"),
                          sexo = $("#sexo"),
                          telefono = $("#telefono"),
                          personaEmergencia = $("#personaEmergencia"),
                          telefonoEmergencia = $("#telefonoEmergencia"),
                          domicilioCaptura = $("#domicilioCaptura"),
                          colonia = $("#colonia"),
                          cp = $("#cp"),
                          poblacion = $("#poblacion"),
                          seguridadSocial = $("#seguridadSocial"),
                          curpCaptura = $("#curpCaptura"),
                          rfcCaptura = $("#rfcCaptura");


                          if(fechaAlta.val()!=""&&departamento.val()!=""&&puesto.val()!=""&&salarioDiario.val()!=""&&nombre.val()&&
                            fechaNacimiento.val()!=""&&edoCivil.val()!=""&&sexo.val()!=""&&telefono.val()!=""&&personaEmergencia.val()!=""&&
                            telefonoEmergencia.val()!=""&&domicilioCaptura.val()!=""&&colonia.val()!=""&&cp.val()!=""&&poblacion.val()!=""&&
                            seguridadSocial.val()!=""&&curpCaptura.val()!=""&&rfcCaptura.val()!=""){
                              $("#status").val("Revision");
                          }
                          else{
                            $("#status").val("Faltan Datos")
                          }
                          solicitud.attr("disabled", false);
                          acta.attr("disabled", false);
                          ife.attr("disabled", false);
                          domicilio.attr("disabled", false);
                          seguro.attr("disabled", false);
                          curp.attr("disabled", false);
                          rfc.attr("disabled", false);
                          penales.attr("disabled", false);
                          fotos.attr("disabled", false);
                          estudios.attr("disabled", false);
                          infonavit.attr("disabled", false);
                          adeudo.attr("disabled", false);
                          puesto.attr("disabled", false);
                          sexo.attr("disabled", false);
                          edoCivil.attr("disabled", false);

                    });

                    var fullmonth_array = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                                            "Juio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                    var abrevia_dias = ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"];
                    $('#fechaAlta').datepicker({
                      //dateFormat:'yy-mm-dd'
                      //dateFormat: 'dd-mm-yy'
                      dateFormat: 'dd/mm/yy',
                      changeMonth: true,
                      changeYear: true,
                      yearRange: '2018:2025',
                      monthNamesShort: fullmonth_array,
                      dayNamesMin: abrevia_dias,
                      selectOtherMonths: true
                    });

                    $('#fechaNacimiento').datepicker({
                      //dateFormat:'yy-mm-dd'
                      //dateFormat: 'dd-mm-yy'
                      dateFormat: 'dd/mm/yy',
                      changeMonth: true,
                      changeYear: true,
                      yearRange: '1950:2050',
                      monthNamesShort: fullmonth_array,
                      dayNamesMin: abrevia_dias,
                      selectOtherMonths: true
                    });



  			});

        //var departamento = $("#departamento");
        //alert(document.getElementById('departamento').value);
        //alert($("#departamento"))
        function registro(){
            setTimeout("location.href='registro.php'",500);
        }
  			function visualizacion(){
            setTimeout("location.href='visualizacion.php'",500);
        }
  			function saludo(folio){
  					setTimeout("location.href='actualizaRegistro.php?folio="+folio+"'");
  			}
        function impresion(){
          $("#gerente").hide();
          $("#recursosHumanos").hide();
          print();
          var departamento = $("#departamento").val(),

          departamento = departamento.split("_");
          for (var i = 0; i < departamento.length; i++) {
            if(i==0){
              auxiliar = departamento[i];
            }
            else{
              auxiliar = auxiliar+" "+departamento[i];
            }
          }
          console.log(auxiliar);
          // alert(auxiliar);
          switch (auxiliar){
            case "ADMINISTRADOR":
              $("#gerente").show();
              $("#recursosHumanos").show();
              break;
            case "RECURSOS HUMANOS":
              $("#gerente").hide();
              $("#recursosHumanos").show();
            default:
              break;

          }

        }


  </script>
  </body>
</html>
