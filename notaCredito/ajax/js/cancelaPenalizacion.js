$(document).ready(function(){

  function totalSub(importe, descuento){
    var x = descuento/100;
    var y = importe-(importe*x);
    var z = Math.round(y*100)/100;
    return z;
  }
  function iva(subtotal){

    var x = subtotal*.16;
    var y = Math.round(x * 100) / 100;
    return y;
  }

  function total(iva, subtotal){
    var resultado = Math.round((iva + subtotal)*100) / 100;
    return resultado;
  }
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

  var cancelaPenalizacion = $("#cancelaPenalizacion");
  var contador = $("#contadorSubtotal").val();
  cancelaPenalizacion.click(function(){

    var totalPenalizacion = 0;
    for (var i = 1; i <= contador; i++) {
      if(document.getElementById('costo'+i).innerText!=""){
        //console.log("Entramos");
        var costo = document.getElementById('subtotalPenalizacion'+i).value;
        costo = parseFloat(costo);
        console.log(costo);
        $("#subtotalPenalizacion"+i).val(0);
        if($("#cantidad"+i).val()>0 && costo>0){
          var costoPenalizacion = costo;
          var importePenalizacion = Math.round(($("#cantidad"+i).val()*costoPenalizacion)*100)/100;
          var subtotalPenalizacion = Math.round((totalSub(importePenalizacion, $("#descuentoConsulta").val()))*100)/100;
          var funcion = "listas(document.querySelector('.clave"+i+"').value, "+i+", document.getElementById('user').value)";
          document.getElementById('costo'+i).innerHTML = '$'+formatNumber.new(costoPenalizacion)+'<input type="button" class="boton" value="?" onclick="'+funcion+'" />';
          $("#importeNota"+i).text("$"+formatNumber.new(importePenalizacion));
          $("#subtotal"+i).text("$"+formatNumber.new(subtotalPenalizacion));
          totalPenalizacion += subtotalPenalizacion;
        }
        else{
          var costoPenalizacion = costo;
          var funcion = "listas(document.querySelector('.clave"+i+"').value, "+i+", document.getElementById('user').value)";
          document.getElementById('costo'+i).innerHTML = '$'+formatNumber.new(costoPenalizacion)+'<input type="button" class="boton" value="?" onclick="'+funcion+'" />';
          $("#importeNota"+i).text("$"+formatNumber.new(costoPenalizacion));
          $("#subtotal"+i).text("$"+formatNumber.new(costoPenalizacion));
          totalPenalizacion += subtotalPenalizacion;
        }

      }
    }
    $("#subtotalNota").val("$"+formatNumber.new(Math.round(totalPenalizacion*100)/100));
    $("#iva").val("$"+formatNumber.new(Math.round(iva(totalPenalizacion)*100)/100));
    $("#totalNota").val("$"+formatNumber.new(Math.round(total(iva(totalPenalizacion), totalPenalizacion)*100)/100));
    $("#penalizacionNota").val(0);
    $("#porcentaje").val(0);
    $("#cancelaPenalizacion").hide();
    $("#penalizacion").show();
    $("#pen").text("");
  });
  // cancelaPenalizacion.click(enviar);
  //
  // function enviar(){
  //   // var total = $("#totalNota").val();
  //   // var penalizacion = $("#penalizacionNota").val();
  //   // console.log(total);
  //   var parametros =
  //   {
  //     total: $("#totalNota").val(),
  //     penalizacion: $("#penalizacionNota").val()
  //   }
  //   $.ajax({
  //       async: true, //Activar la transferencia asincronica
  //       type: "POST", //El tipo de transaccion para los datos
  //       dataType: "html", //Especificaremos que datos vamos a enviar
  //       contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
  //       url: "ajax/cancelaPenalizacion.php", //Sera el archivo que va a procesar la petición AJAX
  //       data: parametros, //Datos que le vamos a enviar
  //       // data: "total="+total+"&penalizacion="+penalizacion,
  //       beforeSend: inicioEnvio, //Es la función que se ejecuta antes de empezar la transacción
  //       success: llegada, //Función que se ejecuta en caso de tener exito
  //       timeout: 4000,
  //       error: problemas //Función que se ejecuta si se tiene problemas al superar el timeout
  //   });
  //   return false;
  // }
  // function inicioEnvio(){
  //     var cargando = $("#totalNota");
  //     cargando.val("Cargando...");
  // }
  //
  // function llegada(datos){
  //     $("#totalNota").val(datos);
  //     $("#cancelaPenalizacion").hide();
  //     $("#penalizacion").show();
  //     $("#pen").text("");
  // }
  //
  // function problemas(){
  //     $("#totalNota").val("Problemas en el servidor");
  // }
});
