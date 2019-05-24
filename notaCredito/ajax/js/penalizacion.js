$(document).ready(function(){

  var penalizacion = $("#penalizacion");
  penalizacion.click(enviar);
  //Esta instruccion hace el trabajo de la funcion limpiar
  $("#listas").val("");

  function enviar(){
    console.log("Entro a la funcion");
    // subtotalesListas();
    // var total = $("#totalNota").val();
    // var penalizacion = $("#penalizacionNota").val();
    // console.log(total);
    var parametros =
    {
      usuario: $("#user").val()
    }
    $.ajax({
        async: true, //Activar la transferencia asincronica
        type: "POST", //El tipo de transaccion para los datos
        dataType: "html", //Especificaremos que datos vamos a enviar
        contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
        url: "ajax/penalizacion.php", //Sera el archivo que va a procesar la petición AJAX
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
      var cargando = $("#listas");
      cargando.text("Cargando...");
  }

  function llegada(datos){

      $("#listas").html(datos)
  }

  function problemas(){
      $("#listas").text("Problemas en el servidor");
  }
});
