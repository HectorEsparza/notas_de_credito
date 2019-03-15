$(document).ready(function(){

  $("#envio").click(function(){

    enviar();
  });

  function enviar(){
    // var total = $("#totalNota").val();
    // var penalizacion = $("#penalizacionNota").val();
    // console.log(total);
    var parametros =
    {
      idApa: $("#idApa").val(),
      descripcion: $("#descripcion").val(),
      precio: $("#precio").val(),
      linea: $("#linea").val(),
      sublinea: $("#sublinea").val(),
      idVazlo: $("#idVazlo").val(),
      precioVazlo: $("#precioVazlo").val(),
      importancia: $("#importancia").val(),
      anteriorApa: $("#anteriorApa").val(),
    }
    $.ajax({
        async: true, //Activar la transferencia asincronica
        type: "POST", //El tipo de transaccion para los datos
        dataType: "html", //Especificaremos que datos vamos a enviar
        contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
        url: "ajax/activaEnvio.php", //Sera el archivo que va a procesar la petición AJAX
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
      // var cargando = $("#idApa");
      // cargando.val("Cargando...");
  }

  function llegada(datos){
      // console.log("Id Apa: "+datos[0]);
      // console.log("Descripción: "+datos[1]);
      // console.log("Precio: "+datos[2]);
      // console.log("Linea: "+datos[3]);
      // console.log("Sublinea: "+datos[4]);
      // console.log("Id Vazlo: "+datos[5]);
      // console.log("Precio Vazlo: "+datos[6]);
      // console.log("Importancia: "+datos[7]);
      // console.log("Anterior Apa: "+datos[8]);
      if(datos=="exito"){
        alert("La actualización del producto se realizó con éxito");
        setTimeout("location.href='analisis.php'",500);
      }
      else if(datos=="repetido"){
        alert("No se pudo realizar la actualización del producto, porque el ID APA ya existe");
      }
      else if(datos=="vacio"){
        alert("No se pudo realizar la actualización del producto, porque no introdujo un ID APA");
      }

  }

  function problemas(){
      alert("Problemas en el Servidor");
  }


});
