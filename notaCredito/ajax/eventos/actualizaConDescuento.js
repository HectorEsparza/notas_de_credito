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

  function iva(subtotal){

    var x = subtotal*.16;
    var y = Math.round(x * 100) / 100;
    return y;
  }

  function totalSub(importe, descuento){
    var x = descuento/100;
    var y = importe-(importe*x);
    var z = Math.round(y*100)/100;
    return z;
  }

  function total(iva, subtotal){
    var resultado = Math.round((iva + subtotal)*100) / 100;
    return resultado;
  }
    // alert("Estoy en el document");
    $("#clienteValor").blur(function(){

      var contador = $("#contadorSubtotal").val();
      var tipo = $("#tipo").val();
      var valor = document.getElementById('descuento').innerText;
      var separador = valor.split("%");
      $("#descuentoConsulta").val(separador[0]);

      if(valor!=""){
        $("#cantidad1").prop("readonly", false);
        $("#clave1").prop("readonly", false);
        $("#devolucion1").prop("disabled", false);

      }
      else{
        $("#cantidad1").prop("readonly", true);
        $("#clave1").prop("readonly", true);
        $("#devolucion1").prop("disabled", true);

      }

      // for (var i = 1; i <=10; i++) {
      //   if(valor!=""){
      //     $("#cantidad"+i).prop("readonly", false);
      //     $("#clave"+i).prop("readonly", false);
      //
      //   }
      //   else{
      //     $("#cantidad"+i).prop("readonly", true);
      //     $("#clave"+i).prop("readonly", true);
      //
      //   }
      // }

      var importe = [];
      var subtotal = [];

      for(var i=1;i<=contador;i++){

        if(document.getElementById('importeNota'+i).innerText!=""){

          var importeTexto = document.getElementById('importeNota'+i).innerText;
          var importeCadena = importeTexto.replace(',', "");
          var importeCadena2 = importeCadena.split("$");
          importe[i] = parseFloat(importeCadena2[1]);
          var descuentoTexto = document.getElementById('descuento').innerText
          var descuentoCadena = descuentoTexto.split("%");
          var descuentoNumero = parseFloat(descuentoCadena[0]);
          $("#subtotal"+i).text("$"+formatNumber.new(totalSub(importe[i], descuentoNumero)));
          // console.log(totalSub(importe[i], descuentoNumero));
          // console.log(importe[i]+1);
          // console.log(descuentoNumero);
        }
      }

      var subtotal = 0;
      var auxiliar = [];

      for (var i = 1; i <= contador; i++) {

        if(document.getElementById('subtotal'+i).innerText==""){
          auxiliar[i] = 0;
        }
        else {
          var valor = document.getElementById('subtotal'+i).innerText;
          var cadena = valor.split("$");
          auxiliar[i] = parseFloat(cadena[1].replace(',', ""));
        }
      }

      for (var i = 1; i <=contador; i++) {
         subtotal = subtotal + auxiliar[i];
      }
      if(tipo=="4. Factor 3"||tipo=="6. Entrada Caja Factor 3"){
        $("#subtotalNota").val(formatNumber.new(Math.round(subtotal*100)/100, "$"));
        $("#iva").val("$0");
        $("#totalNota").val(formatNumber.new(Math.round(subtotal*100)/100, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(Math.round(subtotal*100)/100, "$"));
        $("#iva").val(formatNumber.new(iva(subtotal), "$"));
        $("#totalNota").val(formatNumber.new(total(iva(subtotal), subtotal), "$"));
      }
    });
    //Cada que se cambia la clave
   //  $("#clave1").blur(function(){
   //    var subtotal = 0;
   //    var auxiliar = [];
   //
   //    for (var i = 1; i <= 10; i++) {
   //
   //      if(document.getElementById('subtotal'+i).innerText==""){
   //        auxiliar[i] = 0;
   //        // console.log(auxiliar[i]);
   //      }
   //      else {
   //        var valor = document.getElementById('subtotal'+i).innerText;
   //        var cadena = valor.split("$");
   //        auxiliar[i] = parseFloat(cadena[1].replace(',', ""));
   //        // console.log(auxiliar[i]);
   //      }
   //    }
   //
   //    for (var i = 1; i <=10; i++) {
   //      subtotal = subtotal + auxiliar[i];
   //    }
   //
   //    $("#subtotalNota").val(formatNumber.new(Math.round(subtotal*100)/100, "$"));
   //    $("#iva").val(formatNumber.new(iva(subtotal), "$"));
   //    $("#totalNota").val(formatNumber.new(total(iva(subtotal), subtotal), "$"));
   //
   //     console.log(valor);
   //
   //
   // });

   // $("#clave1").change(function(){
   //
   //   console.log("si entro");
   // });

  });
