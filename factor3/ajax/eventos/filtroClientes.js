$(document).ready(function(){
  
    $("#buscar").click(function(){
      if($("#idCliente").val()!="" || $("#nombre").val()!="" || $("#estatus").val()!="" || 
         $("#descuento").val()!="" || $("#vendedor").val()!=""){
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
        estatus: $("#estatus").val(), 
        descuento: $("#descuento").val(),
        vendedor: $("#vendedor").val(),
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
      //console.log(datos);
      $("#table").empty();
      $("#paginador").empty();
      var contador = Object.keys(datos.numeroCliente).length;
      
      if(contador==0){
        $('<tr>'+
          '<td colspan="6">No se encontraron datos en la consulta</td>'+
        '</tr>').appendTo($("#table"));
      }
      else{
        for (var i = 0; i < contador; i++) {
          $('<tr>'+
            '<td>'+datos.numeroCliente[i]+'</td>'+
            '<td>'+datos.nombreCliente[i]+'</td>'+
            '<td>'+datos.descuentoCliente[i]+'%</td>'+
            '<td>'+datos.rfcCliente[i]+'</td>'+
            '<td>'+datos.estatusCliente[i]+'</td>'+
            '<td>'+datos.vendedorCliente[i]+'</td>'+
          '</tr>').appendTo($("#table"));
        }
      }
      
    }
  
    function problemas(textError, textStatus) {
          //var error = JSON.parse(textError);
          alert("Problemas en el Servlet: " + JSON.stringify(textError));
          alert("Problemas en el servlet: " + JSON.stringify(textStatus));
    }
  });