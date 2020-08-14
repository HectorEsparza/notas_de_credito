$(document).ready(function () {
  $("#login").click(function () {
    if ($("#usuario").val() != "" && $("#password").val() != "") {
      enviar();
    }
    else {
      alert("Captura todos los campos, por favor");
    }

  });
  $("body").keypress(function (e) {
    var code = (e.keyCode ? e.keyCode : e.which);
    if (code == 13) {
      if ($("#usuario").val() != "" && $("#password").val() != "") {
        enviar();
      }
      else {
        alert("Captura todos los campos, por favor");
      }
    }
  });
  function enviar() {
    var parametros =
    {
      usuario: $("#usuario").val(),
      password: $("#password").val(),
    }
    $.ajax({
      async: true, //Activar la transferencia asincronica
      type: "POST", //El tipo de transaccion para los datos
      dataType: "json", //Especificaremos que datos vamos a enviar
      contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
      url: "php/iniciarSesion.php", //Sera el archivo que va a procesar la petición AJAX
      data: parametros, //Datos que le vamos a enviar
      // data: "total="+total+"&penalizacion="+penalizacion,
      beforeSend: inicioEnvio, //Es la función que se ejecuta antes de empezar la transacción
      success: llegada, //Función que se ejecuta en caso de tener exito
      timeout: 4000,
      error: problemas //Función que se ejecuta si se tiene problemas al superar el timeout
    });
    return false;
  }
  function inicioEnvio() {
    console.log("Enviando petición de login...");
  }

  function llegada(resultados) {
    if (resultados.opcion == 0) {
      alert("Actualiza tu contraseña, por favor");
      console.log(resultados.usuario);
      setTimeout("location.href='cambioPassword.html?usuario=" + resultados.usuario + "'", 500);
    }
    else if (resultados.opcion == 1) {
      //alert("Login exitoso");
      setTimeout("location.href='aplicacion/home.php'", 500);
    }
    else {
      alert("Usuario o Password incorrectos, verificalo por favor");
    }
  }

  function problemas(textError, textStatus) {
    //var error = JSON.parse(textError);
    alert("Problemas en el Servlet: " + JSON.stringify(textError));
    alert("Problemas en el servlet: " + JSON.stringify(textStatus));
  }
});
