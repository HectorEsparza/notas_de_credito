<?php
require_once("../funciones.php");
//obtiene los valores para realizar la paginacion
$limit = isset($_POST["limit"]) && intval($_POST["limit"]) > 0 ? intval($_POST["limit"])	: 20;
$offset = isset($_POST["offset"]) && intval($_POST["offset"])>=0	? intval($_POST["offset"])	: 0;
$cliente = $_POST["cliente"];
$tipo = "RR%";
$estatus = "Emitida";
// $limit = 20;
// $offset = 0;
// $cliente = 73;
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

//$query = $con->prepare("SELECT idCliente, Nombre FROM CLIENTE WHERE Remision='Activo' LIMIT ? OFFSET ?");
$query = $con->prepare("SELECT CLAVE, CLIENTE, NOMBRE, FECHA, IMPORTE FROM CARGAS WHERE CLIENTE=?  AND CLAVE LIKE ? AND ESTATUS=? ORDER BY FECHA DESC LIMIT ? OFFSET ?");
$query->bind_param("issii",$cliente,$tipo,$estatus,$limit,$offset);
$query->execute();

// vincular variables a la sentencia preparada
//$query->bind_result($id_usuario, $nombres,$apellidos);
$query->bind_result($clave, $idCliente, $nombreCliente, $fecha, $importe);

// obtener valores
while ($query->fetch()) {
	$data_json = array();
    $data_json["clave"] = $clave;
	$data_json["idCliente"] = $idCliente;
    $data_json["nombreCliente"] = $nombreCliente;
    $data_json["fecha"] = fechaStandar($fecha);
    $data_json["importe"] = $importe;
    //Obtener el saldo para cada remisión
    $consultaSaldo = "SELECT SUM(Abono) AS total FROM SALDO INNER JOIN CARGAS 
                          ON SALDO.idFacturaRemision=CARGAS.idFacturaRemision WHERE CARGAS.CLAVE=?";
    $resultadoSaldo = $base->prepare($consultaSaldo);
    $resultadoSaldo->execute(array($clave));
    $registroSaldo = $resultadoSaldo->fetch(PDO::FETCH_ASSOC);
    if($registroSaldo["total"]==null){
        $data_json["saldo"] = $importe;
    }
    else{
        $data_json["saldo"] = round(($importe-$registroSaldo["total"])*100)/100;
    }
    $resultadoSaldo->closeCursor();
   
	$data[]=$data_json;
}
$base = null;

// obtiene la cantidad de registros
$cantidad_consulta = $con->query("select count(*) as total FROM CARGAS WHERE CLIENTE=" . $cliente . "  AND CLAVE LIKE 'RR%' AND ESTATUS='Emitida' ORDER BY FECHA DESC");
$row = $cantidad_consulta->fetch_assoc();
$cantidad['cantidad']=$row['total'];
//$cantidad['cantidad']=112;


$json["lista"] = array_values($data);
$json["cantidad"] = array_values($cantidad);

// envia la respuesta en formato json
header("Content-type:application/json; charset = utf-8");
echo json_encode($json);
exit();
