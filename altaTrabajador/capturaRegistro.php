<?php
  require_once("../funciones.php");
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

  echo $rfc . " " . $estudios;
  $base = conexion_local();
  $consulta = "INSERT INTO DOCUMENTOS(SOLICITUD, ACTA, IFE, DOMICILIO, SEGURO, CURP, RFC, ANTECEDENTES, FOTOS, ESTUDIO, INFONAVIT)
                      VALUES(?,?,?,?,?,?,?,?,?,?,?)";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($solicitud, $acta, $ife, $domicilio, $seguro, $curp, $rfc, $penales, $fotos, $estudios, $infonavit));
  $resultado->closeCursor();

  $consulta = "INSERT INTO SOLICITUD(FECHA_ALTA, DEPARTAMENTO, PUESTO, SALARIO, NOMBRE, NACIMIENTO, SEGURO, RFC, CURP, CALLE,
                           COLONIA, CP, POBLACION, CORREO, PERSONA, TELEFONO, PDF, STATUS)
                      VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";



  $resultado = $base->prepare($consulta);
  $resultado->execute(array($fechaAlta, $vistaDepartamento, $vistaPuesto, $salarioDiario, $nombre, $fechaNacimiento,
                            $seguridadSocial, $rfcCaptura, $curpCaptura, $domicilioCaptura, $colonia, $cp,
                            $poblacion, $correo, $personaEmergencia, $telefonoEmergencia, $archivo, "Capturando"));
  $resultado->closeCursor();

  header("location:visualizacion.php");


?>
