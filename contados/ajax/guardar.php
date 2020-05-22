<?php
  session_start();
  $usuario = $_SESSION["user"];
  require_once("../../funciones.php");
  $contador = $_POST['contador'];
  $contador -= 1;
  $facturas = $_POST['facturas'];
  $cajas = $_POST['cajas'];
  $pesos = $_POST['pesos'];
  $recibes = $_POST['recibes'];
  $observaciones = $_POST['observaciones'];
  $flag = 0;
  $folio = $_POST['folio'];
  $fecha = $_POST['fecha'];
  $total = $_POST['total'];
  $total = explode("$", $total);
  $total = $total[1];
  $datos = array();
  $entrada = "";
  $fechaEntrada = "";


  $base = conexion_local();
  for ($i=1; $i <= $contador ; $i++) {
    $consulta = "SELECT CARGAS.idContado, CONTADO.FECHA FROM CARGAS INNER JOIN CONTADO ON CARGAS.idContado=CONTADO.idContado WHERE CARGAS.CLAVE=?";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($facturas[$i]));
    $registro = $resultado->fetch(PDO::FETCH_ASSOC);
    $entrada = $registro["idContado"];
    $fechaEntrada = $registro["FECHA"];
    $resultado->closeCursor();
    //Checamos que la factura introducida no tenga ya un folio de entrada
    // if($entrada!=""){
    //   $flag = 1;
    //   $datos[1] = 0;
    //   $datos[2] = $facturas[$i];
    //   $datos[3] = $entrada;
    //   $datos[4] = $fechaEntrada;
    // }
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
    //Checamos que para cada factura introducida exista un número de cajas/bolsas introducido
    if($cajas[$i]==""){
      // $flag = 1;
      // $datos[1] = 2;
      // $datos[2] = $facturas[$i];
    }
    else{
      //Checamos que para cada factura introducida los números de cajas/bolsas y pesos sean mayor a 0
      //Además de que para el número de cajas solamente se permiten enteros
      if((($cajas[$i]-floor($cajas[$i]))!=0) || $cajas[$i]<=0 || $pesos[$i]<=0){
        $flag = 1;
        $datos[1] = 5;
        $datos[2] = $facturas[$i];
      }
    }
    //Checamos que para cada factura introducida exista un número de peso introducido
    // if($pesos[$i]==""){
    //   $flag = 1;
    //   $datos[1] = 3;
    //   $datos[2] = $facturas[$i];
    // }
    //Checamos que para cada factura introducida exista un nombre de recepción
    // if($recibes[$i]==""){
    //   $flag = 1;
    //   $datos[1] = 4;
    //   $datos[2] = $facturas[$i];
    // }
    
  }
  $datos[0] = $flag;

  if($flag==0){

    //Obtenemos el departamento y el nombre+apellido del usuario
    $consulta = "SELECT DEPARTAMENTO,NOMBRE,APELLIDO FROM USUARIOS WHERE USUARIO=?";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($usuario));
    $registro = $resultado->fetch(PDO::FETCH_ASSOC);
    $departamento = $registro["DEPARTAMENTO"];
    $usuario = $registro["NOMBRE"]." ".$registro["APELLIDO"];
    $resultado->closeCursor();
    //Consulta para guardar la entrada del Contado
    $consulta = "INSERT INTO CONTADO(idContado, Folio, Fecha, Departamento, Total, Usuario)
                               VALUES(?,?,?,?,?,?)";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array(NULL, $folio, fechaConsulta($fecha), $departamento, $total, $usuario));
    $resultado->closeCursor();
    //Consulta para obtener el idContado que se acaba de capturar
    $consulta = "SELECT idContado FROM CONTADO WHERE Folio=?";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($folio));
    $registro = $resultado->fetch(PDO::FETCH_ASSOC);
    $folio = $registro["idContado"];
    $resultado->closeCursor();
    //Consulta para actualizar la entrada de las facturas
    for($i=1; $i <= $contador ; $i++){
      $consulta = "UPDATE CARGAS SET idContado=?, Cajas_Contado=?, Peso_Contado=?, Recibe_Contado=?, Observaciones_Contado=?, Entrada_Contado=? WHERE CLAVE=?";
      $resultado = $base->prepare($consulta);
      $resultado->execute(array($folio, $cajas[$i], $pesos[$i], $recibes[$i], $observaciones[$i], $i, $facturas[$i]));
    }
    $resultado->closeCursor();

  }
  //Devolvemos el arreglo de $datos
  //En la posición 0 guardamos a flag, la cual nos indica si se pudieron o no guardar los datos
  //En la posición 1 guardamos la opción por la cual fallo la captura de los datos
  //*0 es para las facturas que ya tienen un folio de entrada
  //*1 es para las facturas que se están capturando más de una vez
  //*2 es para las facturas que no tienen capturado un número de cajas
  //*3 es para las facturas que no tienen capturado un número de peso 
  //*4 es para las facturas que no tienen capturado un nombre de recepción
  //*5 es para las facturas que no los cajas y el peso no son mayor a 0
  //En la posición 2 guardamos la factura en cuestión
  //En la posición 3 guardamos el folio de la Cobranza
  //En la posición 4 guardamos la fecha de la cobranza

  echo json_encode($datos);


?>
