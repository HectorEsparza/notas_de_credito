function subtotalesListas(){

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

  var importe = [];
  var subtotal = [];
  var tipo = $("#tipo").val();
  var contador = $("#contadorSubtotal").val();

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
}
