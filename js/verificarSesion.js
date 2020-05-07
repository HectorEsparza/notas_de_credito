$(document).ready(function(){

   enviar();

   //Función ajax
    function enviar() {
        $.ajax({
            async: true, //Activar la transferencia asincronica
            type: "POST", //El tipo de transaccion para los datos
            dataType: "json", //Especificaremos que datos vamos a enviar
            contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
            url: "../php/verificarSesion.php", //Sera el archivo que va a procesar la petición AJAX
            //data: parametros, //Datos que le vamos a enviar
            beforeSend: inicioEnvio, //Es la función que se ejecuta antes de empezar la transacción
            success: llegada, //Función que se ejecuta en caso de tener exito
            timeout: 4000,
            error: problemas //Función que se ejecuta si se tiene problemas al superar el timeout
        });
        return false;
    }
    function inicioEnvio() {
        console.log("Verificando si se inicio sesión...");
    }

    function llegada(resultados) {
      if(resultados.opcion==0){
        alert("Inicia sesión, por favor");
        setTimeout("location.href='../index.html'",500);
      }
    }

    function problemas(textError, textStatus) {
        //var error = JSON.parse(textError);
        alert("Problemas en el Servlet: " + JSON.stringify(textError));
        alert("Problemas en el servlet: " + JSON.stringify(textStatus));
    }
});
