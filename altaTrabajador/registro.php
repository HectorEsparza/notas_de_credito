<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Nuevo Registro</title>
    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
  	<link href="css/bootstrap.min.css" rel="stylesheet">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
  	<link rel="stylesheet" type="text/css" href="css/estiloSAE.css" />
    <script type="text/javascript" src="ajax/js/jquery-ui.js"></script>
    <script type="text/javascript" src="ajax/eventos/muestraFormulario.js"></script>
    <script type="text/javascript" src="ajax/eventos/botonCapturar.js"></script>
    <script type="text/javascript" src="ajax/eventos/puestos.js"></script>
    <script type="text/javascript" src="ajax/eventos/salarioDiario.js"></script>
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

    ?>
    <header class="row">
  		<div class="container col-md-8">
  			<h1 align='center'>
  				Nuevo Trabajador
  			</h1>
  			<input type='button' id="home" class="btn btn-primary" style='background:url("imagenes/home3.jpg"); float: left; width: 50px; height: 50px;' />
  			<div align="center"><img src="imagenes/apa.jpg" /></div>
  		</div>
  		<div class="container col-md-4">
  			<form action='../cierre.php'>
  				<input style="float: right;" class="btn btn-primary" type='submit' value='Cierra Sesión' />
  			</form>
        <input type="button" style="float: right;" class="btn btn-primary" onclick="visualizacion()" value="Cargar Registro" />

  		</div>
  	</header>
    <input type="hidden" id='user' value=<?= $user?> />
    <input type="hidden" id='departamento' value=<?= $departamento?> />
    <form action="capturaRegistro.php" method="post" enctype="multipart/form-data">
    <div id="documentos" style="float: left; margin-left: 150px">
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
            <td colspan="2" align='center'><input type='submit' value='Guardar' class="btn btn-primary"/></td>
          </tr>
      </table>
    </div>
    <div id="solicitud" style="float: right; margin-right: 450px; ">
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
              </select></td>
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
            <td align='center' id="prueba"><input  id="pdf" type="file" name="archivo"/></td>
          </tr>
          <tr class="botonCapturar">
            <td colspan="2"><input type="button" class="btn btn-primary" value="Finalizar" id="boton"/></td>
          </tr>
      </table>
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

  			});


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
