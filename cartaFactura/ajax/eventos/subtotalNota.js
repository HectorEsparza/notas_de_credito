
$(document).ready(function(){

  function iva(subtotal){

    var x = subtotal*.16;
    var y = Math.round(x * 100) / 100;
    return y;
  }

  function total(iva, subtotal){
    var resultado = Math.round((iva + subtotal)*100) / 100;
    return resultado;
  }

  function desc(subtotal1, descuento){
    var auxiliar;
    auxiliar = subtotal1*descuento;
    auxiliar = subtotal1-auxiliar;
    auxiliar = Math.round(auxiliar*100)/100;
    return auxiliar;
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

for (var i = 1; i <= 24; i++) {


  $("#cantidad"+i).blur(function(){
    var tipo = $("#tipo").val();
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0]/100;
    // alert(descuento);
    var contador = $("#contadorSubtotal").val();
    var subtotal = 0;
    var auxiliar = [];

    for (var i = 1; i <= contador; i++) {

      if(document.getElementById('importeNota'+i).innerText==""){
        auxiliar[i] = 0;
      }
      else {
        var valor = document.getElementById('importeNota'+i).innerText;
        var cadena = valor.split("$");
        auxiliar[i] = parseFloat(cadena[1].replace(',', ""));
      }
    }

    for (var i = 1; i <=contador; i++) {
       subtotal = subtotal + auxiliar[i];
    }
      descuento = Math.round((subtotal*descuento)*100)/100;
      var subtotal2 = Math.round((subtotal-descuento)*100)/100;
      var impuesto = iva(subtotal2);
      var total = Math.round((subtotal2+impuesto)*100)/100;

      $("#subtotalNota").val(formatNumber.new(Math.round(subtotal*100)/100, "$"));
      $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
      $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
      $("#iva").val(formatNumber.new(impuesto, "$"));
      $("#totalNota").val(formatNumber.new(total, "$"));

      // if(tipo=="1. Carta Factura"||tipo==""){
      //   $("#subtotalNota").val(formatNumber.new(Math.round(subtotal*100)/100, "$"));
      //   $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
      //   $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
      //   $("#iva").val(formatNumber.new(impuesto, "$"));
      //   $("#totalNota").val(formatNumber.new(total, "$"));
      // }
      // else{
      //   $("#subtotalNota").val(formatNumber.new(Math.round(subtotal*100)/100, "$"));
      //   $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
      //   $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
      //   $("#iva").val(formatNumber.new(0, "$"));
      //   $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      // }



  });
  //Cada que se cambia la clave
  $("#clave"+i).blur(function(){
    var tipo = $("#tipo").val();
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0]/100;
    var contador = $("#contadorSubtotal").val();
    var subtotal = 0;
    var auxiliar = [];

    for (var i = 1; i <= contador; i++) {

      if(document.getElementById('importeNota'+i).innerText==""){
        auxiliar[i] = 0;
      }
      else {
        var valor = document.getElementById('importeNota'+i).innerText;
        var cadena = valor.split("$");
        auxiliar[i] = parseFloat(cadena[1].replace(',', ""));
      }
    }

    for (var i = 1; i <=contador; i++) {
      subtotal = subtotal + auxiliar[i];
    }
      descuento = Math.round((subtotal*descuento)*100)/100;
      var subtotal2 = Math.round((subtotal-descuento)*100)/100;
      var impuesto = iva(subtotal2);
      var total = Math.round((subtotal2+impuesto)*100)/100;

        $("#subtotalNota").val(formatNumber.new(Math.round(subtotal*100)/100, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(impuesto, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      // if(tipo=="1. Carta Factura"||tipo==""){
      //   $("#subtotalNota").val(formatNumber.new(Math.round(subtotal*100)/100, "$"));
      //   $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
      //   $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
      //   $("#iva").val(formatNumber.new(impuesto, "$"));
      //   $("#totalNota").val(formatNumber.new(total, "$"));
      // }
      // else{
      //   $("#subtotalNota").val(formatNumber.new(Math.round(subtotal*100)/100, "$"));
      //   $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
      //   $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
      //   $("#iva").val(formatNumber.new(0, "$"));
      //   $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      // }

  });
}

});
