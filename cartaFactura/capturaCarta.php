<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Carta Factura</title>
    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
      body{
        font-size: 13px;
        font-family: arial;
      }
    </style>
  </head>

    <?php session_start();
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
        header("location:inicio.html");
      }

      elseif($departamento!="VENTAS")
      {
        header("location:inicio.html");
      }
      date_default_timezone_set('America/Mexico_City');
      $cantidad = array();
      $clave = array();
      $lista = array();
      $costo = array();
      $importe = array();
      $descripcion = array();
      $subtotal1 = 0; //Este es la suma de todos los importes
      $subtotal2 = 0; //Resta del subtotal1 y el descuento
      $ivaCarta = 0; //IVA aplicado al subtotal2
      $total = 0; //Suma del subtotal2 y el iva
      $letra = ""; //La representación en formato letra del total
      $nombre = ""; //Nombre del cliente
      $descuentodeCarta = 0;
      $fecha = fecha();
      $folioPedido = $_POST['consecutivo'];
      $descuentodeCliente = $_POST['descuentoConsulta'];
      $cliente = $_POST['cliente']; //Clave del cliente
      // $cont = $_POST['contador']; //Contador para saber cuantas partidas fueron capturadas
      $tipo = $_POST['tipo'];
      $calle = "";
      $colonia = "";
      $cp = "";
      $rfc = "";
      $telefono ="";
      $interno = 1;
      $flete = $_POST['flete'];
      $aux = 1;

      // echo "El tipo de devolución es: " . $tipo_dev;

      for ($i=1; $i <=24 ; $i++)
      {
          if($_POST['cantidad' . $i]!=""){
            $cantidad[$aux] = $_POST['cantidad' . $i];
            $clave[$aux] = $_POST['clave' . $i];
            $lista[$aux] = $_POST['lista' . $i];
            $costo[$aux] = $_POST['cost' . $i];
            $descripcion[$aux] = $_POST['description' . $i];
            $importe[$aux] = imp($cantidad[$aux],$costo[$aux]);
            $aux++;
          }


      }

        // $importe[$i] = imp($cantidad[$i],$costo[$i]);

        // echo "Flete: <h1>" . $flete . "</h1>";

      // echo 'Hola Amigos!!!<br />';
      //
      // for ($i=1; $i <=count($cantidad); $i++) {
      //   echo 'Cantidad: ' . $cantidad[$i] . ' Clave: ' . $clave[$i] . ' Costo: ' . $costo[$i] . ' Descripcion: ' . $descripcion[$i] . ' Importe: ' . $importe[$i] . '<br />';
      // }
      $subtotal1 = subtotal($importe);
      $descuentodeCarta = round((($descuentodeCliente/100)*$subtotal1)*100)/100;
      $subtotal2 = $subtotal1-$descuentodeCarta;
      if($flete>0){
        $cantidad [] = 1;
        $clave [] = "FLETE";
        $costo [] = $flete;
        $subtotal2 = $subtotal2+$flete;
      }
      if($tipo=="1. Carta Factura"){
        $ivaCarta = iva($subtotal2);
        $total = $subtotal2+$ivaCarta;
      }
      else{
        $ivaCarta = 0;
        $total = $subtotal2+$ivaCarta;
      }

      //
      //
      try{
        $base = conexion_local();
        $consulta = "SELECT NOMBRE FROM CLIENTES WHERE CLAVE=?";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($cliente));
        $registro = $resultado->fetch(PDO::FETCH_NUM);
        $nombre = $registro[0];

        $verificaFolio = folioCartas($tipo);

        for ($i=1; $i <= count($cantidad) ; $i++) {
          $consulta = "INSERT INTO CARTAS(TIPO, FECHA, FOLIOINTERNO, NOCLIENTE, NOMBRE, SKU, UNIDADESxSKU, MONTO,
                               USUARIO, STATUS, DESCUENTO)
             VALUES(?,?,?,?,?,?,?,?,?,?,?)";
          $resultado = $base->prepare($consulta);
          $resultado->execute(array($tipo, $fecha, $verificaFolio, $cliente, $nombre, $clave[$i], $cantidad[$i], $costo[$i], usuario($usuario), "ACTIVA", $descuentodeCliente));
        }
        $resultado->closeCursor();
        $consulta = "INSERT INTO CARTAS_VIS(FOLIOINTERNO, CLIENTE, TOTAL, FECHA, STATUS, NOCLIENTE, FOLIOPEDIDO, USUARIO)
                      VALUES(?,?,?,?,?,?,?,?)";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($verificaFolio, $nombre, $total, $fecha, "ACTIVA", $cliente, $folioPedido, usuario($usuario)));
        $resultado->closeCursor();

        $consulta = "UPDATE PEDIDOS SET CARTAFACTURA=?, STATUS=? WHERE FOLIOINTERNO=?";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($verificaFolio, "ASOCIADO", $folioPedido));
        $resultado->closeCursor();

        $consulta = "UPDATE PEDIDOS_VIS SET CARTAFACTURA=?, STATUS=? WHERE FOLIOINTERNO=?";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($verificaFolio, "ASOCIADO", $folioPedido));
        $resultado->closeCursor();

        // echo "<h1>Contador: " . $cont . "</h1>";
        // for ($i=1; $i <= $cont ; $i++) {
        //   echo "Costo" . $i . ": " . $costo[$i] . " Descripcion" . $i . ": " . $descripcion[$i] . "<br />";
        // }
       header("location:impresionCarta.php?folio=" . $verificaFolio);

      }
      catch (Exception $e){
        $mensaje = $e->GetMessage();
        $linea = $e->getline();
        echo "<h1>Error: " . $mensaje . "</h1><br />";
        echo "<h1>Linea del Error: " . $linea . "</h1><br />";

        // die($e->GetMessage());
        // die($e->getline());
        // die("<h1>ERROR: " . $e->GetMessage());
        // echo "<br /><h3>" . $e->getline() . "</h3>";
      }
      finally{
        $base = null;
      }
  ?>
  <body>
    <script>
      $(document).ready(function(){

        $("#carta").click(function(){
            setTimeout("location.href='carta.php'",500);
        });

        $("#cierra").click(function(){
          setTimeout("location.href='cierre.php'",500);
        });
      });
    </script>
  </body>
</html>
