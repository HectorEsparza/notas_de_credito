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
      $subtotal1 = 0; //Este es la suma de todos los importes
      $subtotal2 = 0; //Resta del subtotal1 y el descuento
      $ivaCarta = 0; //IVA aplicado al subtotal2
      $total = 0; //Suma del subtotal2 y el iva
      $letra = ""; //La representación en formato letra del total
      $nombre = ""; //Nombre del cliente
      $descuentodeCarta = 0;
      $fecha = fecha();
      $folio = $_POST['consecutivo'];
      $descuentodeCliente = $_POST['descuentoConsulta'];
      $cliente = $_POST['cliente']; //Clave del cliente
      $cont = $_POST['contador']; //Contador para saber cuantas partidas fueron capturadas
      $calle = "";
      $colonia = "";
      $cp = "";
      $rfc = "";
      $telefono ="";

      // echo "El tipo de devolución es: " . $tipo_dev;
      // echo "<h1>Contador: " . $cont . "</h1>";
      for ($i=1; $i <=$cont ; $i++)
      {

        $cantidad[$i] = $_POST['cantidad' . $i];
        $clave[$i] = $_POST['clave' . $i];
        $lista[$i] = $_POST['lista' . $i];
        $costo[$i] = $_POST['cost' . $i];
        $importe[$i] = imp($cantidad[$i],$costo[$i]);
        // echo "Cantidad: " . $cantidad[$i] . " Clave: " . $clave[$i] . "Lista: " . $lista[$i] . "Costo: " . $costo[$i] . "Importe: " . $importe[$i] . "<br />";

      }

      $subtotal1 = subtotal($importe);
      // $descuentodeCarta = sub($descuentodeCliente, $subtotal1);
      // $subtotal2 = $subtotal1-$descuentodeCarta;
      // $ivaCarta = iva($subtotal2);
      $total = sub($descuentodeCliente, $subtotal1);
      $iva = iva($total);
      $total = $total+$iva;

      echo "El Total es: " + $total;
      try{
        $base = conexion_local();
        $consulta = "SELECT NOMBRE FROM CLIENTES WHERE CLAVE=?";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($cliente));
        $registro = $resultado->fetch(PDO::FETCH_NUM);
        $nombre = $registro[0];
        $resultado->closeCursor();

        $consulta = "SELECT REGISTRO FROM PEDIDOS_VIS ORDER BY REGISTRO DESC";
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
        $verificaFolio = folioPedidos();

        for ($i=1; $i <= $cont ; $i++) {
          $consulta = "INSERT INTO PEDIDOS(FECHA, FOLIOINTERNO, NOCLIENTE, NOMBRE, SKU, UNIDADESxSKU, MONTO,
                               LISTAPRECIOS, USUARIO, STATUS, DESCUENTO)
             VALUES(?,?,?,?,?,?,?,?,?,?,?)";
          $resultado = $base->prepare($consulta);
          $resultado->execute(array($fecha, $verificaFolio, $cliente, $nombre, $clave[$i], $cantidad[$i], $costo[$i], $lista[$i], usuario($usuario), "NO ASOCIADO", $descuentodeCliente));
        }
        $resultado->closeCursor();
        $consulta = "INSERT INTO PEDIDOS_VIS(FOLIOINTERNO, CLIENTE, CARTAFACTURA, TOTAL, FECHA, STATUS, NOCLIENTE, REGISTRO, USUARIO)
                      VALUES(?,?,?,?,?,?,?,?,?)";
        $resultado = $base->prepare($consulta);
        $resultado->execute(array($verificaFolio, $nombre, "NO ASOCIADO", $total, $fecha, "NO ASOCIADO", $cliente, $registro, usuario($usuario)));
        $resultado->closeCursor();

        // echo "<h1>Contador: " . $cont . "</h1>";
        // for ($i=1; $i <= $cont ; $i++) {
        //   echo "Costo" . $i . ": " . $costo[$i] . " Descripcion" . $i . ": " . $descripcion[$i] . "<br />";
        // }
        header("location:impresionPedido.php?folio=" . $verificaFolio);

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
