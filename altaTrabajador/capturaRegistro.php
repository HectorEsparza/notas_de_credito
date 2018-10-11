<?php

  //DOCUMENTOS
  $solicitud = $_POST['solicitud'];
  $acta = $_POST['acta'];
  $ife = $_POST['ife'];
  $domicilio = $_POST['domicilio'];
  $seguro = $_POST['seguro'];
  $curp = $_POST['curp'];
  $rfc = $_POST['rfc'];
  $penales = $_POST['penales'];
  $fotos = $_POST['fotos'];
  $estudios = $_POST['estudios'];
  $infonavit = $_POST['infonavit'];


  //Solicitud
  $fechaAlta= $_POST['fechaAlta'];
  $vistaDepartamento = $_POST['vistaDepartamento'];
  $vistaPuesto = $_POST['vistaPuesto'];
  $salarioDiario = $_POST['salarioDiario'];
  $nombre = $_POST['nombre'];
  $fechaNacimiento = $_POST['fechaNacimiento'];
  $seguridadSocial = $_POST['seguridadSocial'];
  $rfcCaptura = $_POST['rfcCaptura'];
  $curpCaptura = $_POST['curpCaptura'];
  $domicilioCaptura = $_POST['domicilioCaptura'];
  $colonia = $_POST['colonia'];
  $cp = $_POST['cp'];
  $poblacion = $_POST['poblacion'];
  $correo = $_POST['correo'];
  $personaEmergencia = $_POST['personaEmergencia'];
  $telefonoEmergencia = $_POST['telefonoEmergencia'];
  $archivo = $_FILES['archivo']['name'];
  $ruta = $_FILES['archivo']['tmp_name'];
  $destino = "infonavit\\" . $archivo;


?>
