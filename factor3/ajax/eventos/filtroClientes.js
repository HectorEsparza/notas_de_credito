$(document).ready(function(){
  
    $("#buscar").click(function(){
      if($("#idCliente").val()!="" || $("#nombre").val()!=""){
        enviar();
      }
      else{
        alert("Captura al menos un campo, por favor");
      }
  
    });
  
    function enviar(){
      
      var parametros =
      {
        idCliente: $("#idCliente").val(),
        nombre: $("#nombre").val(),
      }
      $.ajax({
          async: true, //Activar la transferencia asincronica
          type: "POST", //El tipo de transaccion para los datos
          dataType: "json", //Especificaremos que datos vamos a enviar
          contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
          url: "ajax/filtroClientes.php", //Sera el archivo que va a procesar la petición AJAX
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
        console.log("Cargando Filtro Clientes...");
    }
  
    function llegada(datos){
      console.log(datos);
      $("#table").empty();
    
      if(datos.idCliente!=""){
        $('<tr>'+
            '<td>'+datos.idCliente+'</td>'+
            '<td>'+datos.nombreCliente+'</td>'+
            '<td><input type="button" class="btn btn-info btn-sm remisiones" id="'+datos.idCliente+'" value="Remisiones" /></td>'+
          '</tr>').appendTo($("#table"));
      }
      else{
        $('<tr>'+
            '<td colspan="3" align="center">No se encontraron datos en la consulta</td>'+
          '</tr>').appendTo($("#table"));
      }
      $("#scriptParaCargas").empty();
      $("#scriptParaCargas").append('<script type="text/javascript" src="ajax/js/vistaRemisiones.js"></script>');
      
    }
  
    function problemas(textError, textStatus) {
          //var error = JSON.parse(textError);
          alert("Problemas en el Servlet: " + JSON.stringify(textError));
          alert("Problemas en el servlet: " + JSON.stringify(textStatus));
    }
  });