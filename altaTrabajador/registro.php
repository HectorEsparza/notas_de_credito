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
  </head>
  <script type="text/javascript" src="ajax/eventos/muestraFormulario.js"></script>
  <body>
    <div id="documentos" style="float: left; margin-left: 150px">
      <h1 align='center'>DOCUMENTOS</h1>
      <table border="1" >
        <form method="post" action="captura.php" name="formDocumentos">
          <tr>
            <th>DOCUMENTOS</th>
            <th>STATUS ENTREGA</th>
          </tr>
          <tr>
            <td>Solicitud Empleo</td>
            <td align='center'>
              <select id="solicitud">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Acta Nacimiento</td>
            <td align='center'>
              <select id="acta">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>IFE</td>
            <td align='center'>
              <select id="ife">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Comprobante Domicilio</td>
            <td align='center'>
              <select id="domicilio">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Seguro Social</td>
            <td align='center'>
              <select id="seguro">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>CURP</td>
            <td align='center'>
              <select id="curp">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Cédula de Identificación Físcal</td>
            <td align='center'>
              <select id="rfc">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Antecedentes No Penales</td>
            <td align='center'>
              <select id="penales">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Fotografías(4)</td>
            <td align='center'>
              <select id="fotos">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Comprobante Estudio</td>
            <td align='center'>
              <select id="estudios">
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>

        </form>
      </table>
    </div>
    <div id="solicitud" style="float: right; margin-right: 450px; ">
      <h1>SOLICITUD INGRESO</h1>
      <table border="1" >
        <form method="post" action="captura.php" name="formDocumentos">
          <tr class="solicitudOculto">
            <td align='center'>Fecha de Alta</td>
            <td align='center'>&nbsp;</td>
          </tr>
          <tr class="solicitudOculto">
            <td align='center'>Departamento</td>
            <td align='center'>&nbsp;</td>
          </tr>
          <tr class="solicitudOculto">
            <td align='center'>Puesto</td>
            <td align='center'>&nbsp;</td>
          </tr>
          <tr class="solicitudOculto">
            <td align='center'>Salario Diario</td>
            <td align='center'>&nbsp;</td>
          </tr>
          <tr class="actaOculto">
            <td align='center'>Nombre Completo</td>
            <td align='center'>&nbsp;</td>
          </tr>
          <tr class="actaOculto">
            <td align='center'>Fecha de Nacimiento</td>
            <td align='center'>&nbsp;</td>
          </tr>
          <tr class="seguroOculto">
            <td align='center'>No. Seguridad Social</td>
            <td align='center'>&nbsp;</td>
          </tr>
          <tr class="rfcOculto">
            <td align='center'>RFC</td>
            <td align='center'>&nbsp;</td>
          </tr>
          <tr class="curpOculto">
            <td align='center'>CURP</td>
            <td align='center'>&nbsp;</td>
          </tr>
          <tr class="domicilioOculto">
            <td align='center'>Calle y Número EXT. INT.</td>
            <td align='center'>&nbsp;</td>
          </tr>
          <tr class="domicilioOculto">
            <td align='center'>Colonia</td>
            <td align='center'>&nbsp;</td>
          </tr>
          <tr  class="domicilioOculto">
            <td align='center'>C.P</td>
            <td align='center'>&nbsp;</td>
          </tr>
          <tr  class="domicilioOculto">
            <td align='center'>Población</td>
            <td align='center'>&nbsp;</td>
          </tr>
          <tr class="estudiosOculto">
            <td align='center'>Correo Electrónico</td>
            <td align='center'>&nbsp;</td>
          </tr>
          <tr class="estudiosOculto">
            <td align='center'>Emergencia Comunicarse con:</td>
            <td align='center'>&nbsp;</td>
          </tr>
          <tr class="estudiosOculto">
            <td align='center'>Teléfono Emergencia</td>
            <td align='center'>&nbsp;</td>
          </tr>

        </form>
      </table>
    </div>
  </body>
</html>
