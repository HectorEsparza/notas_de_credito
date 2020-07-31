$(document).ready(function(){

    $("#enviarPassword").click(function(){
      var url = window.location.search;
      url = url.split("=");
      var usuario = url[1];
      //console.log(usuario);
      if($("#newPassword").val()!="" && $("#confirmPassword").val()!=""){
        if($("#newPassword").val()==$("#confirmPassword").val()){
          //alert("Enviando petición AJAX");
          enviar(usuario);
        }
        else{
          alert("Las contraseñas no coinciden, verificalas por favor");
        }
      }
      else{
        alert("Introduce la nueva contraseña y confirmala, por favor");
      }
  
    });
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
          url: "php/cambiarContraseña.php", //Sera el archivo que va a procesar la petición AJAX
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
        console.log("Enviando petición de cambio de password...");
    }
  
    function llegada(resultados){
      if(resultados.opcion==0){
        alert("Se actualizo la contraseña, inicia sesión por favor");
        setTimeout("location.href='index.html'", 500);
      }
    }
  
    function problemas(textError, textStatus) {
          //var error = JSON.parse(textError);
          alert("Problemas en el Servlet: " + JSON.stringify(textError));
          alert("Problemas en el servlet: " + JSON.stringify(textStatus));
    }
  });