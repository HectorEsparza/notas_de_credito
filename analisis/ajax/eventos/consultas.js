$(document).ready(function(){

  var linea = $("#linea"), sublinea = $("#sublinea"), descuentoApa = $("#descuentoApa"), descuentoVazlo = $("#descuentoVazlo");

  linea.change(function(){
    if(linea.val()!=""&&sublinea.val()!=""&&descuentoApa.val()!=""&&descuentoVazlo.val()!=""){
      // alert("Activado AJAX");
      enviar();
    }
  });
  sublinea.change(function(){
    if(linea.val()!=""&&sublinea.val()!=""&&descuentoApa.val()!=""&&descuentoVazlo.val()!=""){
      // alert("Activado AJAX");
      enviar();
    }
  });
  descuentoApa.change(function(){
    if(linea.val()!=""&&sublinea.val()!=""&&descuentoApa.val()!=""&&descuentoVazlo.val()!=""){
      // alert("Activado AJAX");
      enviar();
    }
  });
  descuentoVazlo.change(function(){
    if(linea.val()!=""&&sublinea.val()!=""&&descuentoApa.val()!=""&&descuentoVazlo.val()!=""){
      // alert("Activado AJAX");
      enviar();
    }
  });
  function enviar(){
    // var total = $("#totalNota").val();
    // var penalizacion = $("#penalizacionNota").val();
    // console.log(total);

    var parametros =
    {
      linea: linea.val(),
      sublinea: sublinea.val(),
      descuentoApa: descuentoApa.val(),
      descuentoVazlo: descuentoVazlo.val(),
    }
    $.ajax({
        async: true, //Activar la transferencia asincronica
        type: "POST", //El tipo de transaccion para los datos
        dataType: "json", //Especificaremos que datos vamos a enviar
        contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
        url: "ajax/consultas.php", //Sera el archivo que va a procesar la petición AJAX
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
      var cargando = $("#cantidad");
      cargando.text("Cargando...");
  }

  function llegada(datos){
      // alert(datos[0]+" "+datos[1]+" "+datos[2]+" "+datos[3]);
      if(datos[1]>0){
        $("#porcentaje").css("color", "green");
        $("#cantidad").css("color", "green");
      }
      else if(datos[1]<0){
        $("#porcentaje").css("color", "red");
        $("#cantidad").css("color", "red");
      }
      $("#productos").text(datos[0]);
      $("#porcentaje").text(datos[1]+"%");
      $("#cantidad").text(datos[2]);
      $("#porcentajeCaro").text(datos[3]+"%");
      $("#cantidadCaro").text(datos[4]);
      $("#porcentajeIgual").text(datos[5]+"%");
      $("#cantidadIgual").text(datos[6]);
      $("#porcentajeBarato").text(datos[7]+"%");
      $("#cantidadBarato").text(datos[8]);
      $("#totalPorcentaje").text("100%");
      $("#totalCantidad").text(datos[0]);

  }

  function problemas(){
      $("#cantidad").text("Problemas en el servidor");
  }
});
