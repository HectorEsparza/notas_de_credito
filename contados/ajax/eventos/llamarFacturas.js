$(document).ready(function(){

    $(".factura").change(function(){
      var indice = $(this).attr('id');
      indice = indice.substr(7,7);
      var mayuscula = $("#factura"+indice).val();
      mayuscula = mayuscula.toUpperCase();
      $("#factura"+indice).val(mayuscula);
      $("#factura").val($("#factura"+indice).val());
      $("#indice").val(indice);
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
      console.log(parametros);
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
      var siguienteFila = parseInt(datos.indice, 10);
      siguienteFila += 1;
      //activamos el boton de guardar
      //En el servidor la condicion se cumple si datos[5]==""
      //En el servidor local la condicion se cumple si datos[5]==null
      console.log(datos.folio+" "+datos.cliente);
      if(datos.folio==null && datos.cliente!=null){
            var separador = datos.factura;
            separador = separador.substr(1,1);
            console.log(separador);
            if(datos.departamento=="CONTADOS" && 
              ((separador=="D" && $("#tipo").val()=="facturas") || 
              (separador=="R" && $("#tipo").val()=="remisiones"))){
              if(datos.indice==1&&datos.importe>0){
                $("#guardar").prop("disabled", false);
              }
              else if(datos.indice==1&&datos.importe==0){
                $("#guardar").prop("disabled", true);
              }
              $("#cliente"+datos.indice).text(datos.cliente);
              $("#nombre"+datos.indice).text(datos.nombre);
              if(datos.importe>=0){
                $("#importe"+datos.indice).text("$"+datos.importe);
                //desbloqueamos la siguiente fila para que introduzcan otra factura
                $("#factura"+siguienteFila).prop("readonly", false);
                $("#cajas"+siguienteFila).prop("readonly", false);
                $("#peso"+siguienteFila).prop("readonly", false);
                $("#recibe"+siguienteFila).prop("readonly", false);
                $("#observaciones"+siguienteFila).prop("readonly", false);
              }
              else{
                $("#factura"+datos.indice).val("");
                $("#cliente"+datos.indice).text("");
                $("#nombre"+datos.indice).text("");
                $("#importe"+datos.indice).text("");
                $("#cajas"+datos.indice).val("");
                $("#peso"+datos.indice).val("");
                $("#recibe"+datos.indice).val("");
                $("#observaciones"+datos.indice).val("");
              }
            }
            else if(datos.departamento=="CONTADOS_TECAMAC" && 
                   ((separador=="T" &&  $("#tipo").val()=="facturas") || 
                   (separador=="R" && $("#tipo").val()=="remisiones"))){
              if(datos.indice==1&&datos.importe>0){
                $("#guardar").prop("disabled", false);
              }
              else if(datos.indice==1&&datos.importe==0){
                $("#guardar").prop("disabled", true);
              }
              $("#cliente"+datos.indice).text(datos.cliente);
              $("#nombre"+datos.indice).text(datos.nombre);
              if(datos.importe>=0){
                $("#importe"+datos.indice).text("$"+datos.importe);
                //desbloqueamos la siguiente fila para que introduzcan otra factura
                $("#factura"+siguienteFila).prop("readonly", false);
                $("#cajas"+siguienteFila).prop("readonly", false);
                $("#peso"+siguienteFila).prop("readonly", false);
                $("#recibe"+siguienteFila).prop("readonly", false);
                $("#observaciones"+siguienteFila).prop("readonly", false);
              }
              else{
                $("#factura"+datos.indice).val("");
                $("#cliente"+datos.indice).text("");
                $("#nombre"+datos.indice).text("");
                $("#importe"+datos.indice).text("");
                $("#cajas"+datos.indice).val("");
                $("#peso"+datos.indice).val("");
                $("#recibe"+datos.indice).val("");
                $("#observaciones"+datos.indice).val("");
              }
            }
            else{
              alert("No tiene permiso de capturar esa factura");
              $("#factura"+datos.indice).val("");
            }
      }
      else if(datos.folio!=null && datos.cliente!=null){
        alert("La factura/remisión "+datos.factura+" ya se encuentra capturada en el contado "+datos.folio);
        $("#factura"+datos.indice).val("");
        $("#cliente"+datos.indice).text("");
        $("#nombre"+datos.indice).text("");
        $("#importe"+datos.indice).text("");
        $("#cajas"+datos.indice).val("");
        $("#peso"+datos.indice).val("");
        $("#recibe"+datos.indice).val("");
        $("#observaciones"+datos.indice).val("");
      }
      else{
        alert("La factura "+datos.factura+" no existe en la base de datos");
        $("#factura"+datos.indice).val("");
        $("#cliente"+datos.indice).text("");
        $("#nombre"+datos.indice).text("");
        $("#importe"+datos.indice).text("");
        $("#cajas"+datos.indice).val("");
        $("#peso"+datos.indice).val("");
        $("#recibe"+datos.indice).val("");
        $("#observaciones"+datos.indice).val("");
      }
      for (var j = 1; j<=$("#filas").val(); j++){
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
      $("#total").text("$"+Math.round(subtotal*100)/100);
      console.log(siguienteFila);
      //console.log("Se activo la factura "+datos[0]+", con folio "+datos[1]);
      //alert(datos);
    }

    function problemas(textError, textStatus) {
        //var error = JSON.parse(textError);
        alert("Problemas en el Servlet: " + JSON.stringify(textError));
        alert("Problemas en el servlet: " + JSON.stringify(textStatus));
    }

});
