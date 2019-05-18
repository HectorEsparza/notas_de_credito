$(document).ready(function(){

  $("#guardar").click(function(){
    enviar();
  });

  function enviar(){

    var arreglo = [];
    var facturas = [];
    var metodos = [];
    var observaciones = [];
    var contador = 1;
    var folio = $("#folio").val();
    var fecha = $("#fechaCaptura").val();
    var total = $("#total").text();
    var usuario = $("#usuario").val();
    arreglo = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
    for (var i = 1; i <= 80; i++){
      if($("#factura"+i).val()!=""&&$("#cliente"+i).text()!=""){
        facturas[contador] = $("#factura"+i).val();
        metodos[contador] = $("#metodo"+i).val();
        observaciones[contador] = $("#observaciones"+i).val();
        contador++;
      }
    }
    var parametros =
    {
      arreglo: arreglo,
      facturas: facturas,
      metodos: metodos,
      observaciones: observaciones,
      contador: contador,
      folio: folio,
      fecha: fecha,
      total: total,
      usuario: usuario,
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
        alert("Captura el método de pago de la factura "+datos[2]);
      }
    }
    //console.log("Hoy es "+datos[0]+ ", mañana será "+datos[1]+". Pero el mejor día de la semana es el "+datos[5]);
  }

  function problemas(){
    console.log("Problemas en el servidor...");
  }
});
