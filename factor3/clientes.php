<?php
require_once("../funciones.php");
// obtiene los valores para realizar la paginacion
$limit = isset($_POST["limit"]) && intval($_POST["limit"]) > 0 ? intval($_POST["limit"])	: 25;
$offset = isset($_POST["offset"]) && intval($_POST["offset"])>=0	? intval($_POST["offset"])	: 0;

$base = conexion_local();
// realiza la conexion
//$con = new mysqli("50.62.209.84","hesparza","b29194303","aplicacion");
$con = new mysqli("localhost","root","","aplicacion");
$con->set_charset("utf8");
//$base = new PDO('mysql:host=localhost; dbname=aplicacion', 'root', '');
//$base = new PDO("mysql:host=50.62.209.117;dbname=aplicacion","hesparza","b29194303");
//$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//$base->exec("SET CHARACTER SET utf8");

// array para devolver la informacion
$json = array();
$data = array();
//consulta que deseamos realizar a la db
//$query = $con->prepare("select id_usuario,nombres,apellidos from  usuarios limit ? offset ?");

//El limite empieza con 10 y el Offset con 0

$query = $con->prepare("SELECT idCliente, Nombre FROM CLIENTE WHERE Remision='Activo' LIMIT ? OFFSET ?");
$query->bind_param("ii",$limit,$offset);
$query->execute();

// vincular variables a la sentencia preparada
//$query->bind_result($id_usuario, $nombres,$apellidos);
$query->bind_result($idCliente, $nombreCliente);

// obtener valores
while ($query->fetch()) {
	$data_json = array();

	$data_json["idCliente"] = $idCliente;
	$data_json["nombreCliente"] = $nombreCliente;
	//Obtener el importe total de las remisiones para cada cliente
	$consultaImporteRemisiones = "SELECT SUM(IMPORTE) as importe FROM CARGAS WHERE CLIENTE=?  AND CLAVE LIKE ? AND ESTATUS=?  ORDER BY FECHA DESC";
	$resultadoImporteRemisiones = $base->prepare($consultaImporteRemisiones);
	$resultadoImporteRemisiones->execute(array($idCliente, 'RR%', 'Emitida'));
	$registroImporteRemisiones = $resultadoImporteRemisiones->fetch(PDO::FETCH_ASSOC);
	if($registroImporteRemisiones["importe"]!=null){
		$importe = $registroImporteRemisiones["importe"];
	}
	else{
		$importe = 0;
	}
	$resultadoImporteRemisiones->closeCursor();
	//Obtener los abonos totales de la remisiones para cada cliente
	$consultaAbonoRemisiones = "SELECT SUM(Abono) as abono FROM SALDO INNER JOIN CARGAS ON SALDO.idFacturaRemision=CARGAS.idFacturaRemision WHERE CLIENTE=?";
	$resultadoAbonoRemisiones = $base->prepare($consultaAbonoRemisiones);
	$resultadoAbonoRemisiones->execute(array($idCliente));
	$registroAbonoRemisiones = $resultadoAbonoRemisiones->fetch(PDO::FETCH_ASSOC);
	if($registroAbonoRemisiones["abono"]!=null){
		$abono = $registroAbonoRemisiones["abono"];
	}
	else{
		$abono = 0;
	}
	$resultadoAbonoRemisiones->closeCursor();
	$data_json["saldoCliente"] = $importe-$abono;
	$data[]=$data_json;
}

$base = null;

// obtiene la cantidad de registros
$cantidad_consulta = $con->query("select count(*) as total from CLIENTE where Remision='Activo'");
$row = $cantidad_consulta->fetch_assoc();
$cantidad['cantidad']=$row['total'];


$json["lista"] = array_values($data);
$json["cantidad"] = array_values($cantidad);

// envia la respuesta en formato json
header("Content-type:application/json; charset = utf-8");
echo json_encode($json);
exit();
?>
