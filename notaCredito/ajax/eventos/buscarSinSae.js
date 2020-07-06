$(document).ready(function(){
    var formatNumber = {
        separador: ",", // separador para los miles
        sepDecimal: '.', // separador para los decimales
        formatear:function (num){
        num +='';
        var splitStr = num.split('.');
        var splitLeft = splitStr[0];
        var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
        var regx = /(\d+)(\d{3})/;
        while (regx.test(splitLeft)) {
        splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
        }
        return this.simbol + splitLeft +splitRight;
        },
        new:function(num, simbol){
        this.simbol = simbol ||'';
        return this.formatear(num);
        }
     }

    $("#buscarSinSae").click(function(){
        alert("Buscar notas sin SAE");
        enviar();
    });

    function enviar(){
      
        $.ajax({
            async: true, //Activar la transferencia asincronica
            type: "POST", //El tipo de transaccion para los datos
            dataType: "json", //Especificaremos que datos vamos a enviar
            contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
            url: "ajax/buscarSinSae.php", //Sera el archivo que va a procesar la petición AJAX
            //data: parametros, //Datos que le vamos a enviar
            // data: "total="+total+"&penalizacion="+penalizacion,
            beforeSend: inicioEnvio, //Es la función que se ejecuta antes de empezar la transacción
            success: llegada, //Función que se ejecuta en caso de tener exito
            timeout: 4000,
            error: problemas //Función que se ejecuta si se tiene problemas al superar el timeout
        });
        return false;
      }
      function inicioEnvio(){
          console.log("Cargando Filtro Notas sin SAE...");
      }
    
      function llegada(datos){
        console.log(datos);
        $("#table").empty();
          $("#paginador").empty();
          var contador = Object.keys(datos.folioInterno).length;
          var tabla = "";

          for (let i = 0; i < contador; i++) {
            var click = "saludo(document.querySelector('.folio"+i+"').value)";
            var click2 = "cancela(document.querySelector('.folio"+i+"').value)";
              tabla += '<tr class="nulo">'+
                            '<td><input type="text" class="folio'+i+'" value='+datos.folioInterno[i]+' size="4" readonly /></td>'+
                            '<td>'+datos.numeroCliente[i]+'</td>'+
                            '<td>'+datos.nombreCliente[i]+'</td>'+
                            '<td></td>'+
                            '<td>'+formatNumber.new(datos.total[i], "$")+'</td>'+
                            '<td>'+datos.fecha[i]+'</td>'+
                            '<td>'+datos.estatus[i]+'</td>'+
                            '<td><button class="modifica" onclick='+click+'>!</button></td>'+
                            '<td><button class="modifica" onclick='+click2+'>Cancelar</button></td>'+
                        '</tr>'; 
          }
          $("#table").append(tabla);
          
      }
    
      function problemas(textError, textStatus) {
            //var error = JSON.parse(textError);
            alert("Problemas en el Servlet: " + JSON.stringify(textError));
            alert("Problemas en el servlet: " + JSON.stringify(textStatus));
      }
});