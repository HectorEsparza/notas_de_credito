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

$query = $con->prepare("SELECT  ID, EMPLEADO, NOMBRE, CURP, RFC, SEGURO, SALARIO, SEMANAL,
																DEPARTAMENTO, PUESTO, FECHA_ALTA, BANCOMER, SIVALE, CALLE, COLONIA, CP, POBLACION, NACIMIENTO,
																TELEFONO, EMERGENCIA, PERSONA, CORREO, EDO_CIVIL, SEXO,
															  STATUS FROM SOLICITUD ORDER BY ID DESC LIMIT ? OFFSET ?");
$query->bind_param("ii",$limit,$offset);
$query->execute();

// vincular variables a la sentencia preparada
//$query->bind_result($id_usuario, $nombres,$apellidos);
$query->bind_result($id, $empleado, $nombre, $curp, $rfc, $seguro, $salarioDiario, $salarioSemanal, $departamento,
										$puesto,  $fechaAlta, $bancomer, $sivale, $calle, $colonia, $cp, $poblacion, $fechaNacimiento,
										$telefono, $telefonoEmergencia, $personaEmergencia, $correo, $edoCivil, $sexo, $status);

// obtener valores
while ($query->fetch()) {
	$data_json = array();

	$data_json["id"] = $id;
	$data_json["empleado"] = $empleado;
	$data_json["nombre"] = $nombre;
	$data_json["curp"] = $curp;
	$data_json["rfc"] = $rfc;
	$data_json["seguro"] = $seguro;
	$data_json["salarioDiario"] = $salarioDiario;
	$data_json["salarioSemanal"] = $salarioSemanal;
	$data_json["departamento"] = $departamento;
	$data_json["puesto"] = $puesto;
	$data_json["fechaAlta"] = $fechaAlta;
	$data_json["bancomer"] = $bancomer;
	$data_json["sivale"] = $sivale;
	$data_json["calle"] = $calle;
	$data_json["colonia"] = $colonia;
	$data_json["cp"] = $cp;
	$data_json["poblacion"] = $poblacion;
	$data_json["fechaNacimiento"] = $fechaNacimiento;
	$data_json["telefono"] = $telefono;
	$data_json["telefonoEmergencia"] = $telefonoEmergencia;
	$data_json["personaEmergencia"] = $personaEmergencia;
	$data_json["correo"] = $correo;
	$data_json["edoCivil"] = $edoCivil;
	$data_json["sexo"] = $sexo;
	$data_json["status"] = $status;
	$data[]=$data_json;
}

// obtiene la cantidad de registros
$cantidad_consulta = $con->query("select count(*) as total from SOLICITUD");
$row = $cantidad_consulta->fetch_assoc();
$cantidad['cantidad']=$row['total'];


$json["lista"] = array_values($data);
$json["cantidad"] = array_values($cantidad);

// envia la respuesta en formato json
header("Content-type:application/json; charset = utf-8");
echo json_encode($json);
exit();
?>
