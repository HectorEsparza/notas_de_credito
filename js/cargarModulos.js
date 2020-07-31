$(document).ready(function(){
    enviar();

    function enviar(usuario){
        var parametros =
        {
          usuario: usuario,
          password: $("#newPassword").val(),
        }
        $.ajax({
            async: true, //Activar la transferencia asincronica
            type: "POST", //El tipo de transaccion para los datos
            dataType: "json", //Especificaremos que datos vamos a enviar
            contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
            url: "../php/cargarModulos.php", //Sera el archivo que va a procesar la petición AJAX
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
          console.log("Enviando petición para cargar Módulos...");
      }
    
      function llegada(datos){
        var contador = Object.keys(datos.modulos).length;
        // alert(contador);
        var contenido = "";
        var auxiliar = 0;

        for (var i = 0; i < contador; i++) {

            contenido += '<div class="col-sm-12 col-md-4">'+
                            '<input type="button" id="'+datos.identificador[i]+'" value="'+datos.modulos[i]+'" class="btn btn-primary" />'+
                         '</div>';
        }

        $("#modulos").empty();
        $("#modulos").append(contenido);
        $("body").append('<script src="../js/redireccionamientoModulos.js"></script>');
      }
    
      function problemas(textError, textStatus) {
            //var error = JSON.parse(textError);
            alert("Problemas en el Servlet: " + JSON.stringify(textError));
            alert("Problemas en el servlet: " + JSON.stringify(textStatus));
      }
});