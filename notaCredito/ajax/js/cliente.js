$(document).ready(function(){

  var cliente = $("#clienteValor");
  cliente.change(enviar);

  function enviar(){
    var parametros =
    {
      cliente: $("#clienteValor").val(),
    }
    $.ajax({
        async: true, //Activar la transferencia asincronica
        type: "GET", //El tipo de transaccion para los datos
        dataType: "html", //Especificaremos que datos vamos a enviar
        contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
        url: "ajax/cliente.php", //Sera el archivo que va a procesar la petición AJAX
        data: parametros, //Datos que le vamos a enviar
        beforeSend: inicioEnvio, //Es la función que se ejecuta antes de empezar la transacción
        success: llegada, //Función que se ejecuta en caso de tener exito
        timeout: 4000,
        error: problemas //Función que se ejecuta si se tiene problemas al superar el timeout
    });
    return false;
  }
  function inicioEnvio(){
      var cargando = $("#cliente");
      cargando.text("Cargando...");
  }

  function llegada(datos){
      $("#cliente").text(datos);
  }

  function problemas(){
      $("#cliente").text("Problemas en el servidor");
  }
});
