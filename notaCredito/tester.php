<?php

	require_once("../funciones.php");
	$aux = 1;
	$folio = array();
	$base = conexion_local();
	$consulta = "SELECT * FROM NOTAS_VIS";
	$resultado = $base->prepare($consulta);
	$resultado->execute(array());
	$cont = $resultado->rowCount();
	$resultado->closeCursor();

	$consulta = "SELECT FOLIOINTERNO FROM NOTAS_VIS";
	$resultado = $base->prepare($consulta);
	$resultado->execute(array());

	while ($registro = $resultado->fetch(PDO::FETCH_NUM)){

		$folio[$aux] = $registro[0];
		$aux++;
	}
	$resultado->closeCursor();
	for ($i=1; $i <= $cont ; $i++) {

		$consulta = "UPDATE NOTAS_VIS SET REGISTRO=? WHERE FOLIOINTERNO=?";
		$resultado = $base->prepare($consulta);
		$resultado->execute(array($i, $folio[$i]));


	}
	$resultado->closeCursor();

?>
