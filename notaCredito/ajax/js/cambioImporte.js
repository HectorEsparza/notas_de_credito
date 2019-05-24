// $(document).ready(function(){
//
//   for (var i = 1; i <= 10; i++) {
//     var clave = $("#clave"+i);
//     clave.change(enviar);
//
//     function enviar(){
//       // var total = $("#totalNota").val();
//       // var penalizacion = $("#penalizacionNota").val();
//       // console.log(total);
//       var parametros =
//       {
//         cantidad: $("#cantidad"+i).val(),
//         importe: $("#costo"+i).text()
//       }
//       $.ajax({
//           async: true, //Activar la transferencia asincronica
//           type: "GET", //El tipo de transaccion para los datos
//           dataType: "html", //Especificaremos que datos vamos a enviar
//           contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
//           url: "ajax/cambioImporte.php", //Sera el archivo que va a procesar la petición AJAX
//           data: parametros, //Datos que le vamos a enviar
//           // data: "total="+total+"&penalizacion="+penalizacion,
//           beforeSend: inicioEnvio, //Es la función que se ejecuta antes de empezar la transacción
//           success: llegada, //Función que se ejecuta en caso de tener exito
//           timeout: 4000,
//           error: problemas //Función que se ejecuta si se tiene problemas al superar el timeout
//       });
//       return false;
//     }
//     function inicioEnvio(){
//         var cargando = $("#importeNota"+i);
//         cargando.text("Cargando...");
//     }
//
//     function llegada(datos){
//         $("#importeNota"+i).text(datos);
//     }
//
//     function problemas(){
//         $("#importeNota"+i).text("Problemas en el servidor");
//     }
//   }
//
//
// });



function cambioImporte(cantidad, importe, i)
    {



      var conexion;
      if (window.XMLHttpRequest)
      {
        conexion = new XMLHttpRequest();
      }
      else
      {
        conexion = new ActiveXObject("Microsoft.XMLHTTP");
      }

      conexion.onreadystatechange = function()
      {
        if (conexion.readyState==4 && conexion.status==200)
        {
            document.getElementById('importeNota'+i).innerHTML = conexion.responseText;

        }
      }

      conexion.open("GET", "ajax/cambioImporte.php?cantidad="+cantidad+"&importe="+importe, true);
      conexion.send();
    }
