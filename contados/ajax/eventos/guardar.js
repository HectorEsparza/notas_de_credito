$(document).ready(function(){

  $("#guardar").click(function(){
    enviar();
  });

  function enviar(){
    var facturas = [];
    var cajas = [];
    var pesos = [];
    var recibes = [];
    var observaciones = [];
    var contador = 1;
    var folio = $("#folio").val();
    var fecha = $("#fechaCaptura").val();
    var total = $("#total").text();
    for (var i = 1; i <= 100; i++){
      if($("#factura"+i).val()!=""&&$("#cliente"+i).text()!=""){
        facturas[contador] = $("#factura"+i).val();
        cajas[contador] = $("#cajas"+i).val();
        pesos[contador] = $("#peso"+i).val();
        recibes[contador] = $("#recibe"+i).val();
        observaciones[contador] = $("#observaciones"+i).val();
        contador++;
      }
    }
    var parametros =
    {
      facturas: facturas,
      cajas: cajas,
      pesos: pesos,
      recibes: recibes,
      observaciones: observaciones,
      contador: contador,
      folio: folio,
      fecha: fecha,
      total: total,
    }
    $.ajax({
        async: true, //Activar la transferencia asincronica
        type: "POST", //El tipo de transaccion para los datos
        dataType: "json", //Especificaremos que datos vamos a enviar
        contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
        url: "ajax/guardar.php", //Sera el archivo que va a procesar la petición AJAX
        data: parametros, //Datos que le vamos a enviar
        // data: "total="+total+"&penalizacion="+penalizacion,
        beforeSend: inicioEnvio, //Es la función que se ejecuta antes de empezar la transacción
        success: llegada, //Función que se ejecuta en caso de tener exito
        timeout: 4000,
        error: problemas //Función que se ejecuta si se tiene problemas al superar el timeout
    });
    return false;
  }
  function inicioEnvio(){
    console.log("Cargando...");
  }

  function llegada(datos){
    //console.log(datos);
    if(datos[0]==0){
      alert("Se pudo guardar de manera exitosa");
      setTimeout("location.href='visualizacion.php'",500);
    }
    else{
      //alert("Existe un problema con los datos, por favor revisalos");
      if(datos[1]==0){
        alert("La factura "+datos[2]+" ya fue capturada en la cobranza "+datos[3]+" con fecha "+datos[4]+", favor de corregir");
      }
      else if(datos[1]==1){
        alert("La factura "+datos[2]+" esta repetida en éste documento, favor de corregir");
      }
      else if(datos[1]==2){
        alert("Captura el número de cajas/bolsas de la factura "+datos[2]);
      }
      else if(datos[1]==3){
        alert("Captura el peso de la factura "+datos[2]);
      }
      else if(datos[1]==4){
        alert("Captura el nombre de quién recibe de la factura "+datos[2]);
      }
      else if(datos[1]==5){
        alert("Los valores para cajas/bolsas y peso deben de ser mayores a 0, además los números para cajas/bolsas deben"+
        "de ser enteros, verifica los datos de la factura  "+datos[2]);
      }
    }
    //console.log("Hoy es "+datos[0]+ ", mañana será "+datos[1]+". Pero el mejor día de la semana es el "+datos[5]);
  }

  function problemas(textError, textStatus) {
    //var error = JSON.parse(textError);
    alert("Problemas en el Servlet: " + JSON.stringify(textError));
    alert("Problemas en el servlet: " + JSON.stringify(textStatus));
}
});
