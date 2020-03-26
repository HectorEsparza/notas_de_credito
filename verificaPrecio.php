<?php
  require_once("funciones.php");
  // $base = conexion_local();
  // $consulta = "SELECT CLAVEDEARTÍCULO FROM PRODUCTOS1";
  // $resultado = $base->prepare($consulta);
  // $resultado->execute(array());
  // while ($registro = $resultado->fetch(PDO::FETCH_NUM)) {
  //   echo $registro[0] . "<br />";
  // }
  // $clave_nueva = array();
  // $precio_viejo = array();
  // $precio_nuevo = array();
  // $contador = 0;
  // $clave_sinCoincidir = array();
  // $base = new PDO("mysql:host=127.0.0.1;dbname=aplicacion_2.0","root","");
  // $base->exec("SET CHARACTER SET utf8");
  // $consulta = "SELECT CLAVE FROM PRODUCTOS_APA";
  // $resultado = $base->prepare($consulta);
  // $resultado->execute(array());
  // while ($registro = $resultado->fetch(PDO::FETCH_NUM)) {
  //   $clave_nueva[$contador] = $registro[0];
  //   $contador++;
  // }
  // $resultado->closeCursor();
  // $base_vieja = conexion_local();
  // // $consulta = "SELECT PRECIO FROM PRODUCTOS1";
  // // $resultado = $base_vieja->prepare($consulta);
  // // $resultado->execute(array());
  // // while ($registro = $resultado->fetch(PDO::FETCH_NUM)) {
  // //   echo $registro[0] . "<br />";
  // //   //$contador++;
  // // }
  //
  // for ($i=0; $i < $contador; $i++) {
  //   $consulta = "SELECT PRECIO FROM PRODUCTOS6 WHERE CLAVEDEARTÍCULO=?";
  //   $resultado = $base_vieja->prepare($consulta);
  //   $resultado->execute(array($clave_nueva[$i]));
  //   $registro = $resultado->fetch(PDO::FETCH_NUM);
  //   $precio_viejo[$i] = $registro[0];
  // }
  // $resultado->closeCursor();
  // $contador = 0;
  // $consulta = "SELECT IMPORTE FROM PRODUCTOS_APA INNER JOIN PRODUCTOS_APA_PRECIO
  //              ON PRODUCTOS_APA.IDAPA=PRODUCTOS_APA_PRECIO.IDAPA
  //              INNER JOIN PRECIO ON PRODUCTOS_APA_PRECIO.IDPRECIO=PRECIO.IDPRECIO
  //              WHERE PRODUCTOS_APA_PRECIO.IDLISTASPRECIO=?";
  // $resultado = $base->prepare($consulta);
  // $resultado->execute(array("6"));
  // while ($registro = $resultado->fetch(PDO::FETCH_NUM)) {
  //   $precio_nuevo[$contador]= $registro[0];
  //   $contador++;
  // }
  // $resultado->closeCursor();
  // $contador2 = 0;
  // for ($i=0; $i < $contador; $i++) {
  //   if($precio_nuevo[$i]!=$precio_viejo[$i]){
  //     $clave_sinCoincidir[$contador2] = $clave_nueva[$i];
  //     $contador2++;
  //     echo $clave_nueva[$i] . "<br />";
  //   }
  // }
  //echo $contador2;
  $idVazlo = array();
  $idPrecio = array();
  $contador = 0;
  $base = new PDO("mysql:host=127.0.0.1;dbname=aplicacion_2.0","root","");
  $base->exec("SET CHARACTER SET utf8");

  $consulta = "SELECT * FROM PRODUCTOS_VAZLO";
  $resultado = $base->prepare($consulta);
  $resultado->execute(array());
  while ($registro = $resultado->fetch(PDO::FETCH_NUM)) {
    $idVazlo[$contador] = $registro[0];
    $idPrecio[$contador] = $registro[2];
    $contador++;
    //echo $registro[0] . " " . $registro[2] . "<br />";
  }
  $resultado->closeCursor();

  for ($i=0; $i < $contador; $i++) {
    $consulta = "INSERT INTO PRODUCTOS_VAZLO_PRECIO (IDVAZLO, IDPRECIO, IDLISTASPRECIO)
                        VALUES(?,?,?)";
    $resultado = $base->prepare($consulta);
    $resultado->execute(array($idVazlo[$i], $idPrecio[$i], 1));
  }

  $resultado->closeCursor();
  echo 2
?>
