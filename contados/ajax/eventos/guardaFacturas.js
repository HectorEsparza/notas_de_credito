$(document).ready(function(){

  $("#guardar").click(function(){
    //alert("Se va a guardar las facturas");
    enviar();
  });
  function enviar(){

    var factura = [];
    var cliente = [];
    var nombre = [];
    var estatus = [];
    var fecha = [];
    var descuento = [];
    var importe = [];
    var vendedor = [];
    var contador = $("#contador").val();
    for (var i = 1; i <= contador; i++){
      factura[i] = $("#factura"+i).text();
      cliente[i] = $("#cliente"+i).text();
      nombre[i] = $("#nombre"+i).text();
      estatus[i] = $("#estatus"+i).text();
      fecha[i] = $("#fecha"+i).text();
      descuento[i] = $("#descuento"+i).text();
      importe[i] = $("#importe"+i).text();
      vendedor[i] = $("#vendedor"+i).text()
    }
    var parametros =
    {
      factura: factura,
      cliente: cliente,
      nombre: nombre,
      estatus: estatus,
      fecha: fecha,
      descuento: descuento,
      importe: importe,
      vendedor: vendedor,
      contador: contador,
    }
    $.ajax({
        async: true, //Activar la transferencia asincronica
        type: "POST", //El tipo de transaccion para los datos
        dataType: "json", //Especificaremos que datos vamos a enviar
        contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
        url: "ajax/guardaFacturas.php", //Sera el archivo que va a procesar la petición AJAX
        data: parametros, //Datos que le vamos a enviar
        // data: "total="+total+"&penalizacion="+penalizacion,
        beforeSend: inicioEnvio,
         //Es la función que se ejecuta antes de empezar la transacción
        success: llegada, //Función que se ejecuta en caso de tener exito
        timeout: 6000,
        error: problemas //Función que se ejecuta si se tiene problemas al superar el timeout
    });
    return false;
  }
  function inicioEnvio(){
    console.log("Cargando...");
  }

  function llegada(datos){
    alert(datos[0]);
    setTimeout("location.href='visualizacion.php'",500);
  }

  function problemas(){
    alert("Problemas en el servidor...");
    console.log("Problemas en el servidor...");
  }
});
