<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="" content="" />
  <meta name="" content="" />
  <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
  <link href="css/estiloNota.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <title>Captura</title>
  <style>
    body
    {
      font-family: Arial;
      font-size: 14px;
    }
  </style>
</head>
<body>
<?php
ini_set('max_execution_time', 1500);
session_start();
$usuario = $_SESSION['user'];

require_once("../funciones.php");
  $base = conexion_local();
  $consulta="SELECT DEPARTAMENTO FROM USUARIOS WHERE USUARIO=?";
  $resultado = $base->prepare($consulta);
  $resultado-> execute(array($usuario));
  $registro = $resultado->fetch(PDO::FETCH_NUM);
  $departamento = $registro[0];
  $user = usuario($usuario);


if(!isset($usuario))
{
  header("location:../index.html");
}

//echo "<h1>" . $usuario . "</h1>";
date_default_timezone_set('America/Mexico_City');
//require("funciones.php");
$tipo_dev = $_POST['tipo'];
$cantidad = array();
$clave = array();
$lista = array();
$costo = array();
$importe = array();
$subtotales = array();
$devolucion = array();
$subtotal = 0;
$iva = 0;
$total = 0;
$letra = "";
$nombre = "";
$descuento = 0;
$fecha = fecha();
$folio = $_POST['consecutivo'];
$folioRecepcion = $_POST['folioRecepcion'];
$descuento = $_POST['descuentoConsulta'];
$penalizacion = $_POST['penalizacionNota'];
$porcentaje = $_POST['porcentaje'];

$factura = $_POST['factura'];
$cliente = $_POST['cliente'];
$motivo = $_POST['motivo'];
$observaciones = $_POST['observaciones'];
$cont = $_POST['contador'];

// echo "El tipo de devolución es: " . $tipo_dev;

for ($i=1; $i <=$cont ; $i++)
{

  $cantidad[$i] = $_POST['cantidad' . $i];
  $clave[$i] = $_POST['clave' . $i];
  $lista[$i] = $_POST['lista' . $i];
  $costo[$i] = $_POST['cost' . $i];
  $devolucion[$i] = $_POST['devolucion' . $i];


}

try
{
$base = conexion_local();
$consulta = "SELECT NOMBRE FROM CLIENTE WHERE idCliente=?";
$resultado = $base->prepare($consulta);
$resultado->execute(array($cliente));
$registro = $resultado->fetch(PDO::FETCH_NUM);
$nombre = $registro[0];

if($tipo_dev=="Factor 3"||$tipo_dev=="Entrada Caja Factor 3"){
for ($i=1; $i <=$cont ; $i++)
{
  $importe[$i] = imp($cantidad[$i], $costo[$i]);
  $subtotales[$i] = sub($descuento, $importe[$i]);
}
$sub = subtotal($subtotales);
$iva = 0;
$total = $sub;

if($porcentaje!=0){
  $cantidad [] = 1;
  $clave [] = "CARG" . $porcentaje;
  $costo [] = $penalizacion*-1;
  $importe [] = $penalizacion*-1;
  $subtotales [] = $penalizacion*-1;
  $cont++;
  //$total = $total-$penalizacion;
  $letra = num2letras($total, $fem = false, $dec = true);
}
else{
  $letra = num2letras($total, $fem = false, $dec = true);
}


$resultado->closeCursor();
}
else if($tipo_dev=="Muestra"){
  for ($i=1; $i <=$cont ; $i++)
  {
    $costo[$i] = 0;
    $importe[$i] = 0;
    $subtotales[$i] = 0;
  }
  $sub = 0;
  $iva = 0;
  $total = 0;
  $letra = num2letras($total, $fem = false, $dec = true);
}
else{
for ($i=1; $i <=$cont ; $i++)
{
  $importe[$i] = imp($cantidad[$i], $costo[$i]);
  $subtotales[$i] = sub($descuento, $importe[$i]);
}

$sub = subtotal($subtotales);
$iva = iva($sub);
$total = total($sub,$iva);
if($porcentaje!=0){
  $cantidad [] = 1;
  $clave [] = "CARG" . $porcentaje;
  $costo [] = $penalizacion*-1;
  $importe [] = $penalizacion*-1;
  $subtotales [] = $penalizacion*-1;
  $cont++;
  //$total = $total-$penalizacion;
  $letra = num2letras($total, $fem = false, $dec = true);
}
else{
  $letra = num2letras($total, $fem = false, $dec = true);
}

$resultado->closeCursor();
}

$consulta = "SELECT REGISTRO FROM NOTAS_VIS ORDER BY REGISTRO DESC";
$resultado = $base->prepare($consulta);
$resultado->execute(array());
$registro = $resultado->fetch(PDO::FETCH_NUM);

if($registro[0]==""){
  $registro = 1;
}
else{
  $registro = $registro[0]+1;
}
$resultado->closeCursor();

// echo "Subtotal es: " . $sub . "<br />";
// echo "Iva es: " . $iva . "<br />";
// echo "Total es: " . $total . "<br />";
if($tipo_dev=="Factor 3"||$tipo_dev=="Cambio Físico"||$tipo_dev=="Muestra"||$tipo_dev=="Entrada Caja Factor 3"){
  if($tipo_dev=="Factor 3"||$tipo_dev=="Entrada Caja Factor 3"){
    $sae = "F3";
  }
  elseif($tipo_dev=="Cambio Físico"){
    $sae = "C. FISICO";
  }
  elseif ($tipo_dev=="Muestra"){
    $sae= "MUESTRA";
  }
  for ($i=1; $i <=$cont ; $i++)
  {
  $consulta = "INSERT INTO NOTAS(TIPO, FECHA, FOLIOINTERNO, NOCLIENTE, NOMBRE, SKU, UNIDADESxSKU, FACTURA, MONTO,
                                 MOTIVO, OBSERVACIONES, NOTASAE, LISTAPRECIOS, USUARIO, STATUS, RECEPCION, DEVOLUCION, DESCUENTO)
               VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($tipo_dev, $fecha, $folio, $cliente, $nombre, $clave[$i], $cantidad[$i], $factura,
                            $costo[$i], $motivo, $observaciones, $sae, $lista[$i], usuario($usuario), "ACTIVA", $folioRecepcion, $devolucion[$i], $descuento));
  }
  $resultado->closeCursor();


  $consulta =  "INSERT INTO NOTAS_VIS(FOLIOINTERNO, CLIENTE, NOTASAE, TOTAL, FECHA, STATUS, NOCLIENTE, RECEPCION, REGISTRO) VALUES(?,?,?,?,?,?,?,?,?)";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($folio, $nombre, $sae, $total, $fecha, "ACTIVA", $cliente, $folioRecepcion, $registro));
  $resultado->closeCursor();
}
else{
  for ($i=1; $i <=$cont ; $i++)
  {
  $consulta = "INSERT INTO NOTAS(TIPO, FECHA, FOLIOINTERNO, NOCLIENTE, NOMBRE, SKU, UNIDADESxSKU, FACTURA, MONTO,
                                 MOTIVO, OBSERVACIONES, LISTAPRECIOS, USUARIO, STATUS, RECEPCION, DEVOLUCION, DESCUENTO)
               VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($tipo_dev, $fecha, $folio, $cliente, $nombre, $clave[$i], $cantidad[$i], $factura,
                            $costo[$i], $motivo, $observaciones, $lista[$i], usuario($usuario), "ACTIVA", $folioRecepcion, $devolucion[$i], $descuento));
  }
  $resultado->closeCursor();


  $consulta =  "INSERT INTO NOTAS_VIS(FOLIOINTERNO, CLIENTE, TOTAL, FECHA, STATUS, NOCLIENTE, RECEPCION, REGISTRO) VALUES(?,?,?,?,?,?,?,?)";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array($folio, $nombre, $total, $fecha, "ACTIVA", $cliente, $folioRecepcion, $registro));
  $resultado->closeCursor();
}

header("location:impresionNota.php?folio=". $folio);
}
catch (Exception $e)
{
  $mensaje = $e->GetMessage();
  $linea = $e->getline();
  echo "<h1>Error: " . $mensaje . "</h1><br />";
  echo "<h1>Linea del Error: " . $linea . "</h1><br />";

  // die($e->GetMessage());
  // die($e->getline());
// die("<h1>ERROR: " . $e->GetMessage());
// echo "<br /><h3>" . $e->getline() . "</h3>";
}
finally
{
$base = null;
}

?>




<script src="ajax/eventos/cierreInactividad.js"></script>
<script>
  function nota(){
      setTimeout("location.href='nota.php'",500);
  }
  function imprime(){
    print();
  }
</script>

</body>
</html>
