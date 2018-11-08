<?php

  require_once("../funciones.php");
  $id = $_POST['ID'];
  //DOCUMENTOS
  $solicitud = $_POST['solicitud'];
  $acta = $_POST['acta'];
  $ife = $_POST['ife'];
  $domicilio = $_POST['domicilio'];
  $seguro = $_POST['seguro'];
  $curp = $_POST['curp'];
  $rfc = $_POST['rfc'];
  // $penales = $_POST['penales'];
  // $fotos = $_POST['fotos'];
  // $estudios = $_POST['estudios'];
  $infonavit = $_POST['infonavit'];


  //Solicitud
  $fechaAlta= $_POST['fechaAlta'];
  $vistaDepartamento = $_POST['vistaDepartamento'];
  $vistaPuesto = $_POST['vistaPuesto'];
  $salarioDiario = $_POST['salarioDiario'];
  $salarioSemanl = $_POST['salarioSemanal'];
  $nombre = $_POST['nombre'];
  $fechaNacimiento = $_POST['fechaNacimiento'];
  $edoCivil = $_POST['edoCivil'];
  $sexo = $_POST['sexo'];
  $telefono = $_POST['telefono'];
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
  $status = $_POST['status'];
  move_uploaded_file($ruta, $destino);

  //echo $solicitud . " " . $id . " " . $nombre;
  $base = conexion_local();
  $consulta = "UPDATE DOCUMENTOS SET SOLICITUD=?, ACTA=?, IFE=?, DOMICILIO=?, SEGURO=?, CURP=?, RFC=?, INFONAVIT=? WHERE ID=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($solicitud, $acta, $ife, $domicilio, $seguro, $curp, $rfc, $infonavit, $id));
  $resultado->closeCursor();

  $consulta = "UPDATE SOLICITUD SET FECHA_ALTA=?, DEPARTAMENTO=?, PUESTO=?, SALARIO=?, NOMBRE=?, NACIMIENTO=?, TELEFONO=?, SEGURO=?, RFC=?, CURP=?, CALLE=?,
                           COLONIA=?, CP=?, POBLACION=?, CORREO=?, PERSONA=?, EMERGENCIA=?, PDF=?, STATUS=?, SEMANAL=?, EDO_CIVIL=?, SEXO=? WHERE ID=?";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($fechaAlta, $vistaDepartamento, $vistaPuesto, $salarioDiario, $nombre, $fechaNacimiento,
                            $telefono, $seguridadSocial, $rfcCaptura, $curpCaptura, $domicilioCaptura, $colonia, $cp,
                            $poblacion, $correo, $personaEmergencia, $telefonoEmergencia, $archivo, $status, $salarioSemanl,
                            $edoCivil, $sexo, $id));
  $resultado->closeCursor();

  header("location:visualizacion.php");





?>
