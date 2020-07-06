<?php
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

$query = $con->prepare("SELECT CLIENTE.IDCLIENTE, CLIENTE.NOMBRE, PORCENTAJE, RFC, CLIENTE.ESTATUS, VENDEDOR.NOMBRE FROM CLIENTE
						INNER JOIN DESCUENTO ON CLIENTE.IDDESCUENTO=DESCUENTO.IDDESCUENTO
						INNER JOIN VENDEDOR_CLIENTE ON CLIENTE.IDCLIENTE=VENDEDOR_CLIENTE.IDCLIENTE
						INNER JOIN VENDEDOR ON VENDEDOR.IDVENDEDOR=VENDEDOR_CLIENTE.IDVENDEDOR 
						WHERE VENDEDOR_CLIENTE.ESTATUS='Activo' ORDER BY CLIENTE.IDCLIENTE DESC LIMIT ? OFFSET ?");
$query->bind_param("ii",$limit,$offset);
$query->execute();

// vincular variables a la sentencia preparada
//$query->bind_result($id_usuario, $nombres,$apellidos);
$query->bind_result($idCliente, $nombreCliente, $descuento, $rfc, $estatus, $nombreVendedor);

// obtener valores
while ($query->fetch()) {
	$data_json = array();

	$data_json["idCliente"] = $idCliente;
	$data_json["nombreCliente"] = $nombreCliente;
	$data_json["descuento"] = $descuento;
	$data_json["rfc"] = $rfc;
	$data_json["estatus"] = $estatus;
	$data_json["nombreVendedor"] = $nombreVendedor;
	$data[]=$data_json;
}

// obtiene la cantidad de registros
$cantidad_consulta = $con->query("select count(*) as total from CLIENTE");
$row = $cantidad_consulta->fetch_assoc();
$cantidad['cantidad']=$row['total'];


$json["lista"] = array_values($data);
$json["cantidad"] = array_values($cantidad);

// envia la respuesta en formato json
header("Content-type:application/json; charset = utf-8");
echo json_encode($json);
exit();
?>