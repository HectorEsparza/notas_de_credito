$(document).ready(function(){


    var boton = $("#gerentes");
    boton.click(enviar);

    function enviar(){
      // var total = $("#totalNota").val();
      // var penalizacion = $("#penalizacionNota").val();
      // console.log(total);
      var parametros =
      {
        empleado: $("#empleado").val(),
        nombre: $("#nombre").val()

      }
      $.ajax({
          async: true, //Activar la transferencia asincronica
          type: "GET", //El tipo de transaccion para los datos
          dataType: "html", //Especificaremos que datos vamos a enviar
          contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
          url: "ajax/filtroGerentes.php", //Sera el archivo que va a procesar la petición AJAX
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
        var cargando = $("#table");
        cargando.html("Cargando...");
    }

    function llegada(datos){
        $("#table").html(datos);
    }

    function problemas(){
        $("#table").html("Problemas en el servidor...");
    }


});
