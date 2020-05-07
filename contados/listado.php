<?php
session_start();
$user = $_SESSION["user"];
// obtiene los valores para realizar la paginacion
$limit = isset($_POST["limit"]) && intval($_POST["limit"]) > 0 ? intval($_POST["limit"])	: 20;
$offset = isset($_POST["offset"]) && intval($_POST["offset"])>=0	? intval($_POST["offset"])	: 0;
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

$query = $con->prepare("SELECT Folio, Fecha, Departamento, Total, Usuario FROM CONTADO ORDER BY idContado DESC LIMIT ? OFFSET ?");
$query->bind_param("ii",$limit,$offset);
$query->execute();

// vincular variables a la sentencia preparada
//$query->bind_result($id_usuario, $nombres,$apellidos);
$query->bind_result($clave, $fecha, $departamento, $total, $usuario);

// obtener valores
while ($query->fetch()) {
	$data_json = array();

	$data_json["clave"] = $clave;
	$data_json["fecha"] = $fecha;
	$data_json["departamento"] = $departamento;
	$data_json["usuario"] = $usuario;
	$data_json["total"] = $total;
	$data[]=$data_json;
}

// obtiene la cantidad de registros
$cantidad_consulta = $con->query("select count(*) as total from CONTADO");
$row = $cantidad_consulta->fetch_assoc();
$cantidad['cantidad']=$row['total'];

// obtiene el departamento del usuario
$query = $con->prepare("SELECT DEPARTAMENTO FROM USUARIOS WHERE USUARIO=?");
$query->bind_param("s",$user);
$query->execute();

// vincular variables a la sentencia preparada
//$query->bind_result($id_usuario, $nombres,$apellidos);
$query->bind_result($departamentoUsuario);

// obtener valores
while ($query->fetch()) {
	$json["departamento"] = $departamentoUsuario;
}


$json["lista"] = array_values($data);
$json["cantidad"] = array_values($cantidad);
// envia la respuesta en formato json
header("Content-type:application/json; charset = utf-8");
echo json_encode($json);
exit();
?>
