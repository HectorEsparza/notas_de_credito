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

    $("#tipo").blur(function(){
        var tipo = $("#tipo").val();
        var folio = document.getElementById('folio').innerText;
        console.log(folio);
        var separador = folio.split('-');
        $("#consecutivo").val(folio);
        if(folio!=""){

          $("#clienteValor").prop("readonly", false);
          $("#folioRecepcion").prop("readonly", false);
          $("#factura").prop("readonly", false);
          // if(separador[0]=="M"){
          //
          //   // $("#factura").val("Muestra");
          //   // $("#factura").prop("readonly", true);
          //   // $("#folioRecepcion").val(0);
          //   // $("#folioRecepcion").prop("readonly", true);
          // }
          // else{
          //   $("#factura").prop("readonly", false);
          //   $("#folioRecepcion").prop("readonly", false);
          //   $("#factura").val("");
          //   $("#folioRecepcion").val("");
          // }
        }
        else{
          $("#clienteValor").prop("readonly", true);
          $("#folioRecepcion").prop("readonly", true);
          $("#factura").prop("readonly", true);
        }

        // if(tipo=="Factor 3"||tipo=="Entrada Caja Factor 3"){
        //   $("#subtotalNota").val(formatNumber.new(Math.round(subtotal*100)/100, "$"));
        //   $("#iva").val("$0");
        //   $("#totalNota").val(formatNumber.new(Math.round(subtotal*100)/100, "$"));
        // }
        // else{
        //   $("#subtotalNota").val(formatNumber.new(Math.round(subtotal*100)/100, "$"));
        //   $("#iva").val(formatNumber.new(iva(subtotal), "$"));
        //   $("#totalNota").val(formatNumber.new(total(iva(subtotal), subtotal), "$"));
        // }
    });
});
