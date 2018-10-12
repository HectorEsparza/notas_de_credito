<?php
  require_once("../funciones.php");
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
  $contador = count($documentos);
  for ($i=1; $i <= $contador ; $i++) {
      echo $documentos[$i] . " ";
  }
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
  $resultado->closeCursor();

?>

<input type="hidden" id="documentos" value="<?= $documentos?>" />
