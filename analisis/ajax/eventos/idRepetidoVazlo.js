$(document).ready(function(){

    var idVazlo = $("#idVazlo");

    idVazlo.change(enviar);

    function enviar(){
      // var total = $("#totalNota").val();
      // var penalizacion = $("#penalizacionNota").val();
      // console.log(total);
      var parametros =
      {
        idVazlo: $("#idVazlo").val(),
      }
      $.ajax({
          async: true, //Activar la transferencia asincronica
          type: "POST", //El tipo de transaccion para los datos
          dataType: "html", //Especificaremos que datos vamos a enviar
          contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
          url: "ajax/idRepetidoVazlo.php", //Sera el archivo que va a procesar la petición AJAX
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
        var cargando = $("#idVazlo");
        cargando.val("Cargando...");
    }

    function llegada(datos){
        $("#idVazlo").val(datos);
        if($("#idVazlo").val()==""){
          alert("Error, el ID capturado ya existe");
        }
        else{
          $("#envio").prop("disabled", true);
        }
        // $("#envio").prop("disabled", true);
    }

    function problemas(){
        $("#idVazlo").val("Problemas en el servidor");
    }


});
