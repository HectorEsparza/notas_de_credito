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
      //echo $id;
      $base = conexion_local();
      $consulta = "SELECT * FROM DOCUMENTOS WHERE ID=?";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($id));
      // $registro = $resultado->fetch(PDO::FETCH_NUM);
      //
      // $solicitud = $registro[1];
      // $acta = $registro[2];
      // $ife = $registro[3];
      // $domicilio = $registro[4];
      // $seguro = $registro[5];
      // $curp = $registro[6];
      // $rfc = $registro[7];
      // $penales = $registro[8];
      // $fotos = $registro[9];
      // $estudios = $registro[10];
      // $infonavit = $registro[11];
      while ($registro = $resultado->fetch(PDO::FETCH_NUM)){
        for ($i=1; $i < count($registro) ; $i++){
          $documentos[$i] = $registro[$i];
        }
      }
      $contadorDocumentos = count($documentos);

      // for ($i=1; $i <= $contadorDocumentos ; $i++) {
      //     echo $documentos[$i] . " ";
      // }
      $resultado->closeCursor();
      //echo $solicitud . " " . $ife . " " . $infonavit;

      $consulta = "SELECT * FROM SOLICITUD WHERE ID=?";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($id));
      // $registro = $resultado->fetch(PDO::FETCH_NUM);
      //
      // $fechaAlta= $registro[1];
      // $vistaDepartamento = $registro[2];
      // $vistaPuesto = $registro[3];
      // $salarioDiario = $registro[4];
      // $nombre = $registro[5];
      // $fechaNacimiento = $registro[6];
      // $seguridadSocial = $registro[7];
      // $rfcCaptura = $registro[8];
      // $curpCaptura = $registro[9];
      // $domicilioCaptura = $registro[10];
      // $colonia = $registro[11];
      // $cp = $registro[12];
      // $poblacion = $registro[13];
      // $correo = $registro[14];
      // $personaEmergencia = $registro[15];
      // $telefonoEmergencia = $registro[16];

      //echo $fechaAlta . " " . $vistaDepartamento . " " . $vistaPuesto . " " . $salarioDiario . " " . $telefonoEmergencia;
      while ($registro = $resultado->fetch(PDO::FETCH_NUM)){
        for ($i=1; $i < count($registro) ; $i++){
          $solicitud[$i] = $registro[$i];
        }
      }
      $contadorSolicitud = count($solicitud);
      $resultado->closeCursor();
      //echo "<br />" . $contadorSolicitud;

    ?>
    <header class="row">
  		<div class="container col-md-8">
  			<h1 align='center'>
  				Cargando Trabajador
  			</h1>
  			<input type='button' id="home" class="btn btn-primary" style='background:url("imagenes/home3.jpg"); float: left; width: 50px; height: 50px;' />
  			<div align="center"><img src="imagenes/apa.jpg" /></div>
  		</div>
  		<div class="container col-md-4">
  			<form action='../cierre.php'>
  				<input style="float: right;" class="btn btn-primary" type='submit' value='Cierra Sesión' />
  			</form>
        <input type="button" style="float: right;" class="btn btn-primary" onclick="visualizacion()" value="Cargar Registro" />
  			<input type="button" style="float: right;" class="btn btn-primary" onclick="registro()" value='Nuevo Registro' />

  		</div>
  	</header>
    <input type="hidden" id='user' value=<?= $user?> />
    <input type="hidden" id='departamento' value=<?= $departamento?> />
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
          <tr>
            <td>Solicitud Empleo</td>
            <td align='center'>
              <select id="solicitud" name="solicitud">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Acta Nacimiento</td>
            <td align='center'>
              <select id="acta" name="acta">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>IFE</td>
            <td align='center'>
              <select id="ife" name="ife">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Comprobante Domicilio</td>
            <td align='center'>
              <select id="domicilio" name="domicilio">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Seguro Social</td>
            <td align='center'>
              <select id="seguro" name="seguro">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>CURP</td>
            <td align='center'>
              <select id="curp" name="curp">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Cédula de Identificación Físcal</td>
            <td align='center'>
              <select id="rfc" name="rfc">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
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
            <td>Crédito Infonavit</td>
            <td align='center'>
              <select id="infonavit" name="infonavit">
                <option value="NO">NO</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr>
            <td colspan="2" align='center'><input type='submit' id="guardar" value='Guardar' class="btn btn-primary"/></td>
          </tr>
      </table>
    </div>
    <div id="solicitud" style="float: left; margin-left: 100px; ">
      <h1>SOLICITUD INGRESO</h1>
      <table border="1" >
          <tr class="solicitudOculto">
            <td align='center'>Fecha de Alta</td>
            <td align='center'><input type="text" id="fechaAlta" name="fechaAlta" placeholder="dd/mm/yyyy" readonly/></td>
          </tr>
          <tr class="solicitudOculto">
            <td align='center'>Departamento</td>
            <td align='center'><input type="text" id="vistaDepartamento" name="vistaDepartamento" readonly /></td>
          </tr>
          <tr class="solicitudOculto">
            <td align='center'>Puesto</td>
            <td align='center'>
              <select id="vistaPuesto" name="vistaPuesto">
              </select>
            </td>
          </tr>
          <tr class="solicitudOculto">
            <td align='center'>Salario Diario</td>
            <td align='center'><input type="number" step="any" id="salarioDiario" name='salarioDiario' readonly/></td>
          </tr>
          <tr class="actaOculto">
            <td align='center'>Nombre Completo</td>
            <td align='center'><input type="text" id="nombre" name="nombre"/></td>
          </tr>
          <tr class="actaOculto">
            <td align='center'>Fecha de Nacimiento</td>
            <td align='center'><input type="text" id="fechaNacimiento" name='fechaNacimiento' placeholder="dd/mm/yyyy" /></td>
          </tr>
          <tr class="actaOculto">
            <td align='center'>Teléfono</td>
            <td align='center'><input type="text" id="telefono" name='telefono' /></td>
          </tr>
          <tr class="seguroOculto">
            <td align='center'>No. Seguridad Social</td>
            <td align='center'><input type="text" id="seguridadSocial" name='seguridadSocial'/></td>
          </tr>
          <tr class="rfcOculto">
            <td align='center'>RFC</td>
            <td align='center'><input type="text" id="rfcCaptura" name='rfcCaptura'/></td>
          </tr>
          <tr class="curpOculto">
            <td align='center'>CURP</td>
            <td align='center'><input type="text" id="curpCaptura" name='curpCaptura'/></td>
          </tr>
          <tr class="domicilioOculto">
            <td align='center'>Calle y Número EXT. INT.</td>
            <td align='center'><input type="text" id="domicilioCaptura" name='domicilioCaptura'/></td>
          </tr>
          <tr class="domicilioOculto">
            <td align='center'>Colonia</td>
            <td align='center'><input type="text" id="colonia" name='colonia'/></td>
          </tr>
          <tr  class="domicilioOculto">
            <td align='center'>C.P</td>
            <td align='center'><input type="text" id="cp" name='cp'/></td>
          </tr>
          <tr  class="domicilioOculto">
            <td align='center'>Población</td>
            <td align='center'><input type="text" id="poblacion" name='poblacion'/></td>
          </tr>
          <tr class="estudiosOculto">
            <td align='center'>Correo Electrónico</td>
            <td align='center'><input type="text" id="correo" name='correo'/></td>
          </tr>
          <tr class="estudiosOculto">
            <td align='center'>Emergencia Comunicarse con:</td>
            <td align='center'><input type="text" id="personaEmergencia" name='personaEmergencia'/></td>
          </tr>
          <tr class="estudiosOculto">
            <td align='center'>Teléfono Emergencia</td>
            <td align='center'><input type="text" id="telefonoEmergencia" name='telefonoEmergencia'/></td>
          </tr>
          <tr class="infonavitOculto">
            <td align='center'><label for="pdf">PDF</label></td>
            <td align='center' id="prueba"><input  id="pdf" type="file" name="archivo"></td>
          </tr>
          <input type="hidden" id="status" name='status' value="" />
      </table>
    </div>

    <div id="recursosHumanos" style="float: left; margin-left: 100px;">
      <h1>RECURSOS HUMANOS</h1>
      <form action="modificandoRegistro.php" method="post" enctype="multipart/form-data">
        <table border="1" >
          <tr>
            <td>No. Empleado</td>
            <td><input type="text" id="noEmpleado" name="noEmpleado"/></td>
          </tr>
          <tr>
            <td>Contrato</td>
            <td><input  id="contrato" type="file" name="contrato"/></td>
          </tr>
          <tr>
            <td>IMSS</td>
            <td><input  id="imss" type="file" name="imss"/></td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input type="submit" id="final" class="btn btn-primary"value="Finalizar" disabled/></td>
          </tr>
        </table>
      </form>
    </div>
  </form>
  <script type="text/javascript">

  			$(document).ready(function(){

  									// $('#tag').autocomplete({
  									// 		source: function(request, response){
  									// 				$.ajax({
  									// 						url:"colores.php",
  									// 						dataType:"json",
  									// 						data:{q:request.term},
  									// 						success: function(data){
  									// 								response(data);
  									// 						}
  									// 				});
  									// 		},
  									// 		minLength:3,
  									// 		select: function(event, ui){
  									// 				//alert("Selecciono: "+ui.item.label);
  									// 		}
  									// });
  									$("#home").click(function(){

  										setTimeout("location.href='../home.php'", 500);
  									});
                    // $(function(){
                    //   $.datepicker.setDefaults($.datepicker.regional["es"]);
                    //   $("#fecha").datepicker({
                    //     firstDay: 1
                    //   });
                    // });

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
                          puesto = $("#vistaPuesto");
                      var fechaAlta = $("#fechaAlta"),
                          departamento = $("#vistaDepartamento"),
                          salarioDiario = $("#salarioDiario"),
                          nombre = $("#nombre"),
                          fechaNacimiento = $("#fechaNacimiento"),
                          seguridadSocial = $("#seguridadSocial"),
                          rfcCaptura = $("#rfcCaptura"),
                          curpCaptura = $("#curpCaptura"),
                          domicilioCaptura = $("#domicilioCaptura"),
                          colonia = $("#colonia"),
                          cp = $("#cp"),
                          poblacion = $("#poblacion"),
                          correo = $("#correo"),
                          personaEmergencia = $("#personaEmergencia"),
                          telefonoEmergencia = $("#telefonoEmergencia");

                          if(puesto.val()!=""&&fechaAlta.val()!=""&&departamento.val()!=""&&salarioDiario.val()!=""&&nombre.val()&&
                            fechaNacimiento.val()!=""&&seguridadSocial.val()!=""&&rfcCaptura.val()!=""&&domicilioCaptura.val()!=""&&
                            colonia.val()!=""&&cp.val()!=""&&poblacion.val()!=""&&correo.val()!=""&&
                            personaEmergencia.val()!=""&&telefonoEmergencia.val()!=""){
                              $("#status").val("Revision");
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
                          puesto.attr("disabled", false);
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


  </script>
  </body>
</html>
