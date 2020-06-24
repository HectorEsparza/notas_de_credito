
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

for (var i = 1; i <= 40; i++) {


  $("#cantidad"+i).blur(function(){
    var tipo = $("#tipo").val();
    var contador = $("#contadorSubtotal").val();
    console.log(tipo);
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
    if(tipo=="Factor 3"||tipo=="Entrada Caja Factor 3"){
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
  $("#clave"+i).blur(function(){
    var tipo = $("#tipo").val();
    var contador = $("#contadorSubtotal").val();
    console.log(tipo);
    var subtotal = 0;
    var auxiliar = [];

    for (var i = 1; i <= contador; i++) {

      if(document.getElementById('subtotal'+i).innerText==""){
        auxiliar[i] = 0;
        // console.log(auxiliar[i]);
      }
      else {
        var valor = document.getElementById('subtotal'+i).innerText;
        var cadena = valor.split("$");
        auxiliar[i] = parseFloat(cadena[1].replace(',', ""));
        // console.log(auxiliar[i]);
      }
    }

    for (var i = 1; i <=contador; i++) {
      subtotal = subtotal + auxiliar[i];
    }

    if(tipo=="Factor 3"||tipo=="Entrada Caja Factor 3"){
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
}

});
