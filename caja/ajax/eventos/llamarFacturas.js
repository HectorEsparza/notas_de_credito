$(document).ready(function(){

    $("#factura1").change(function(){
      var mayuscula = $("#factura1").val();
      mayuscula = mayuscula.toUpperCase();
      $("#factura1").val(mayuscula);
      $("#factura").val($("#factura1").val());
      $("#indice").val("1");
      enviar();
    });

    $("#factura2").change(function(){
      var mayuscula = $("#factura2").val();
      mayuscula = mayuscula.toUpperCase();
      $("#factura2").val(mayuscula);
      $("#factura").val($("#factura2").val());
      $("#indice").val("2");
      enviar();
    });

    $("#factura3").change(function(){
      var mayuscula = $("#factura3").val();
      mayuscula = mayuscula.toUpperCase();
      $("#factura3").val(mayuscula);
      $("#factura").val($("#factura3").val());
      $("#indice").val("3");
      enviar();
    });

    $("#factura4").change(function(){
      var mayuscula = $("#factura4").val();
      mayuscula = mayuscula.toUpperCase();
      $("#factura4").val(mayuscula);
      $("#factura").val($("#factura4").val());
      $("#indice").val("4");
      enviar();
    });

    $("#factura5").change(function(){
      var mayuscula = $("#factura5").val();
      mayuscula = mayuscula.toUpperCase();
      $("#factura5").val(mayuscula);
      $("#factura").val($("#factura5").val());
      $("#indice").val("5");
      enviar();
    });

    $("#factura6").change(function(){
      var mayuscula = $("#factura6").val();
      mayuscula = mayuscula.toUpperCase();
      $("#factura6").val(mayuscula);
      $("#factura").val($("#factura6").val());
      $("#indice").val("6");
      enviar();
    });

    $("#factura7").change(function(){
      var mayuscula = $("#factura7").val();
      mayuscula = mayuscula.toUpperCase();
      $("#factura7").val(mayuscula);
      $("#factura").val($("#factura7").val());
      $("#indice").val("7");
      enviar();
    });

    $("#factura8").change(function(){
      var mayuscula = $("#factura8").val();
      mayuscula = mayuscula.toUpperCase();
      $("#factura8").val(mayuscula);
      $("#factura").val($("#factura8").val());
      $("#indice").val("8");
      enviar();
    });

    $("#factura9").change(function(){
      var mayuscula = $("#factura9").val();
      mayuscula = mayuscula.toUpperCase();
      $("#factura9").val(mayuscula);
      $("#factura").val($("#factura9").val());
      $("#indice").val("9");
      enviar();
    });

    $("#factura10").change(function(){
      var mayuscula = $("#factura10").val();
      mayuscula = mayuscula.toUpperCase();
      $("#factura10").val(mayuscula);
      $("#factura").val($("#factura10").val());
      $("#indice").val("10");
      enviar();
    });

    $("#factura11").change(function(){
      var mayuscula = $("#factura11").val();
      mayuscula = mayuscula.toUpperCase();
      $("#factura11").val(mayuscula);
      $("#factura").val($("#factura11").val());
      $("#indice").val("11");
      enviar();
    });

    $("#factura12").change(function(){
      var mayuscula = $("#factura12").val();
      mayuscula = mayuscula.toUpperCase();
      $("#factura12").val(mayuscula);
      $("#factura").val($("#factura12").val());
      $("#indice").val("12");
      enviar();
    });

    $("#factura13").change(function(){
      var mayuscula = $("#factura13").val();
      mayuscula = mayuscula.toUpperCase();
      $("#factura13").val(mayuscula);
      $("#factura").val($("#factura13").val());
      $("#indice").val("13");
      enviar();
    });

    $("#factura14").change(function(){
      var mayuscula = $("#factura14").val();
      mayuscula = mayuscula.toUpperCase();
      $("#factura14").val(mayuscula);
      $("#factura").val($("#factura14").val());
      $("#indice").val("14");
      enviar();
    });

    $("#factura15").change(function(){
      var mayuscula = $("#factura15").val();
      mayuscula = mayuscula.toUpperCase();
      $("#factura15").val(mayuscula);
      $("#factura").val($("#factura15").val());
      $("#indice").val("15");
      enviar();
    });

    function enviar(){
      // var total = $("#totalNota").val();
      // var penalizacion = $("#penalizacionNota").val();
      // console.log(total);
      var parametros =
      {
        indice: $("#indice").val(),
        factura: $("#factura").val(),
        total: $("#total").text(),
      }
      $.ajax({
          async: true, //Activar la transferencia asincronica
          type: "POST", //El tipo de transaccion para los datos
          dataType: "json", //Especificaremos que datos vamos a enviar
          contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
          url: "ajax/llamarFacturas.php", //Sera el archivo que va a procesar la petición AJAX
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
      var total = 0;
      var subtotal = 0;
      var auxiliar = [];
      $("#cliente"+datos[3]).text(datos[0]);
      $("#nombre"+datos[3]).text(datos[1]);
      if(datos[2]>0){
        $("#importe"+datos[3]).text("$"+datos[2]);
      }
      else{
        $("#importe"+datos[3]).text("");
      }
      for (var j = 1; j<=15; j++){
        if(document.getElementById('importe'+j).innerText==""){
          auxiliar[j] = 0;
        }
        else{
          var valor = document.getElementById('importe'+j).innerText;
          var cadena = valor.split("$");
          auxiliar[j] = parseFloat(cadena[1]);
          console.log(auxiliar[j]);
        }
        subtotal = subtotal + auxiliar[j];
      }
      $("#total").text("$"+subtotal);


      //console.log("Se activo la factura "+datos[0]+", con folio "+datos[1]);
      //alert(datos);
    }

    function problemas(){
       console.log("Problemas en el servidor");
    }

});
