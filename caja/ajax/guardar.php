<?php
  require_once("../../funciones.php");
  $arreglo = $_POST['arreglo'];
  $contador = $_POST['contador'];
  $contador -= 1;
  $facturas = $_POST['facturas'];
  $metodos = $_POST['metodos'];
  $observaciones = $_POST['observaciones'];
  $flag = 0;
  $folio = $_POST['folio'];
  $fecha = $_POST['fecha'];
  $total = $_POST['total'];
  $total = explode("$", $total);
  $total = $total[1];
  $usuario = $_POST['usuario'];
  $departamento = $_POST['departamento'];
  $datos = array();
  $entrada = "";
  $fechaEntrada = "";


  $base = conexion_local();
  for ($i=1; $i <= $contador ; $i++) {
    $consulta = "SELECT ENTRADA, FECHA_ENTRADA FROM CARGAS WHERE CLAVE=?";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($facturas[$i]));
    $registro = $resultado->fetch(PDO::FETCH_NUM);
    $entrada = $registro[0];
    $fechaEntrada = $registro[1];
    $resultado->closeCursor();
    //Checamos que la factura introducida no tenga ya un folio de entrada
    if($entrada!=""){
      $flag = 1;
      $datos[1] = 0;
      $datos[2] = $facturas[$i];
      $datos[3] = $entrada;
      $datos[4] = $fechaEntrada;
    }
    //Checamos que las facturas introducidas son únicas y que no se repitieron
    for ($j=1; $j <= $contador ; $j++){
      if($j!=$i){
        if($facturas[$i]==$facturas[$j]){
          $flag = 1;
          $datos[1] = 1;
          $datos[2] = $facturas[$i];
        }
      }
    }
    //Checamos que para cada factura introducida exista un método introducido
    if($metodos[$i]==""){
      $flag = 1;
      $datos[1] = 2;
      $datos[2] = $facturas[$i];
    }
  }


  $datos[0] = $flag;

  if($flag==0){
    //Consulta para actualizar la entrada de las facturas
    for($i=1; $i <= $contador ; $i++){
      $consulta = "UPDATE CARGAS SET METODO=?, OBSERVACIONES=?, ENTRADA=?, FECHA_ENTRADA=?, NUMERO_ENTRADA=? WHERE CLAVE=?";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($metodos[$i], $observaciones[$i], $folio, $fecha, $i, $facturas[$i]));
    }
    $resultado->closeCursor();
    //Consulta para obtener el usuario
    $consulta = "SELECT NOMBRE, APELLIDO FROM USUARIOS WHERE USUARIO=?";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($usuario));
    $registro = $resultado->fetch(PDO::FETCH_NUM);
    $usuario = $registro[0] . " " . $registro[1];
    $resultado->closeCursor();
    //Consulta para guardar las entradas de cada Cobranza
    $consulta = "INSERT INTO CAJA(CLAVE, FECHA, DEPARTAMENTO, USUARIO, TOTAL)
                               VALUES(?,?,?,?,?)";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($folio, $fecha, $departamento, $usuario, $total));
    $resultado->closeCursor();
  }
  //Devolvemos el arreglo de $datos
  //En la posición 0 guardamos a flag, la cual nos indica si se pudieron o no guardar los datos
  //En la posición 1 guardamos la opción por la cual fallo la captura de los datos
  //*0 es para las facturas que ya tienen un folio de entrada
  //*1 es para las facturas que se están capturando más de una vez
  //*2 es para las facturas que no se les está asignando un método
  //En la posición 2 guardamos la factura en cuestión
  //En la posición 3 guardamos el folio de la Cobranza
  //En la posición 4 guardamos la fecha de la cobranza

  echo json_encode($datos);


?>
