$(document).ready(function(){


  $("#descontar1").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad1").val();
    if(cantidad==1){
      var importe = $("#costo1").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad1").val("");
      $("#clave1").val("");
      $("#descripcion1").val("");
      $("#costo1").val("");
      $("#importeNota1").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }

    }
    else if(cantidad>1) if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo1").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad1").val(auxiliar);
      $("#importeNota1").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });
  $("#descontar2").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad2").val();
    if(cantidad==1){
      var importe = $("#costo2").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad2").val("");
      $("#clave2").val("");
      $("#descripcion2").val("");
      $("#costo2").val("");
      $("#importeNota2").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }
    else if(cantidad>1) if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo2").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad2").val(auxiliar);
      $("#importeNota2").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });
  $("#descontar3").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad3").val();
    if(cantidad==1){
      var importe = $("#costo3").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad3").val("");
      $("#clave3").val("");
      $("#descripcion3").val("");
      $("#costo3").val("");
      $("#importeNota3").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }
    else if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo3").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad3").val(auxiliar);
      $("#importeNota3").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });
  $("#descontar4").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad4").val();
    if(cantidad==1){
      var importe = $("#costo4").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad4").val("");
      $("#clave4").val("");
      $("#descripcion4").val("");
      $("#costo4").val("");
      $("#importeNota4").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }
    else if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo4").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad4").val(auxiliar);
      $("#importeNota4").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });
  $("#descontar5").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad5").val();
    if(cantidad==1){
      var importe = $("#costo5").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad5").val("");
      $("#clave5").val("");
      $("#descripcion5").val("");
      $("#costo5").val("");
      $("#importeNota5").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }
    else if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo5").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad5").val(auxiliar);
      $("#importeNota5").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });
  $("#descontar6").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad6").val();
    if(cantidad==1){
      var importe = $("#costo6").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad6").val("");
      $("#clave6").val("");
      $("#descripcion6").val("");
      $("#costo6").val("");
      $("#importeNota6").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }
    else if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo6").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad6").val(auxiliar);
      $("#importeNota6").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });
  $("#descontar7").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad7").val();
    if(cantidad==1){
      var importe = $("#costo7").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad7").val("");
      $("#clave7").val("");
      $("#descripcion7").val("");
      $("#costo7").val("");
      $("#importeNota7").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }
    else if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo7").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad7").val(auxiliar);
      $("#importeNota7").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });
  $("#descontar8").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad8").val();
    if(cantidad==1){
      var importe = $("#costo8").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad8").val("");
      $("#clave8").val("");
      $("#descripcion8").val("");
      $("#costo8").val("");
      $("#importeNota8").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }
    else if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo8").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad8").val(auxiliar);
      $("#importeNota8").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });
  $("#descontar9").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad9").val();
    if(cantidad==1){
      var importe = $("#costo9").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad9").val("");
      $("#clave9").val("");
      $("#descripcion9").val("");
      $("#costo9").val("");
      $("#importeNota9").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }
    else if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo9").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad9").val(auxiliar);
      $("#importeNota9").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });
  $("#descontar10").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad10").val();
    if(cantidad==1){
      var importe = $("#costo10").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad10").val("");
      $("#clave10").val("");
      $("#descripcion10").val("");
      $("#costo10").val("");
      $("#importeNota10").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }
    else if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo10").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad10").val(auxiliar);
      $("#importeNota10").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });
  $("#descontar11").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad11").val();
    if(cantidad==1){
      var importe = $("#costo11").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad11").val("");
      $("#clave11").val("");
      $("#descripcion11").val("");
      $("#costo11").val("");
      $("#importeNota11").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }
    else if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo11").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad11").val(auxiliar);
      $("#importeNota11").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });
  $("#descontar12").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad12").val();
    if(cantidad==1){
      var importe = $("#costo12").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad12").val("");
      $("#clave12").val("");
      $("#descripcion12").val("");
      $("#costo12").val("");
      $("#importeNota12").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }
    else if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo12").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad12").val(auxiliar);
      $("#importeNota12").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });
  $("#descontar13").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad13").val();
    if(cantidad==1){
      var importe = $("#costo13").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad13").val("");
      $("#clave13").val("");
      $("#descripcion13").val("");
      $("#costo13").val("");
      $("#importeNota13").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }
    else if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo13").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad13").val(auxiliar);
      $("#importeNota13").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });
  $("#descontar14").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad14").val();
    if(cantidad==1){
      var importe = $("#costo14").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad14").val("");
      $("#clave14").val("");
      $("#descripcion14").val("");
      $("#costo14").val("");
      $("#importeNota14").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }
    else if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo14").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad14").val(auxiliar);
      $("#importeNota14").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });
  $("#descontar15").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad15").val();
    if(cantidad==1){
      var importe = $("#costo15").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad15").val("");
      $("#clave15").val("");
      $("#descripcion15").val("");
      $("#costo15").val("");
      $("#importeNota15").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }
    else if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo15").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad15").val(auxiliar);
      $("#importeNota15").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });
  $("#descontar16").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad16").val();
    if(cantidad==1){
      var importe = $("#costo16").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad16").val("");
      $("#clave16").val("");
      $("#descripcion16").val("");
      $("#costo16").val("");
      $("#importeNota16").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }
    else if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo16").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad16").val(auxiliar);
      $("#importeNota16").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });
  $("#descontar17").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad17").val();
    if(cantidad==1){
      var importe = $("#costo17").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad17").val("");
      $("#clave17").val("");
      $("#descripcion17").val("");
      $("#costo17").val("");
      $("#importeNota17").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }
    else if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo17").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad17").val(auxiliar);
      $("#importeNota17").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });
  $("#descontar18").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad18").val();
    if(cantidad==1){
      var importe = $("#costo18").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad18").val("");
      $("#clave18").val("");
      $("#descripcion18").val("");
      $("#costo18").val("");
      $("#importeNota18").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }
    else if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo18").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad18").val(auxiliar);
      $("#importeNota18").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });
  $("#descontar19").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad19").val();
    if(cantidad==1){
      var importe = $("#costo19").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad19").val("");
      $("#clave19").val("");
      $("#descripcion19").val("");
      $("#costo19").val("");
      $("#importeNota19").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }
    else if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo19").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad19").val(auxiliar);
      $("#importeNota19").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });
  $("#descontar20").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad20").val();
    if(cantidad==1){
      var importe = $("#costo20").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad20").val("");
      $("#clave20").val("");
      $("#descripcion20").val("");
      $("#costo20").val("");
      $("#importeNota20").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }
    else if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo20").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad20").val(auxiliar);
      $("#importeNota20").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });
  $("#descontar21").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad21").val();
    if(cantidad==1){
      var importe = $("#costo21").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad21").val("");
      $("#clave21").val("");
      $("#descripcion21").val("");
      $("#costo21").val("");
      $("#importeNota21").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }
    else if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo21").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad21").val(auxiliar);
      $("#importeNota21").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });
  $("#descontar22").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad22").val();
    if(cantidad==1){
      var importe = $("#costo22").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad22").val("");
      $("#clave22").val("");
      $("#descripcion22").val("");
      $("#costo22").val("");
      $("#importeNota22").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }
    else if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo22").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad22").val(auxiliar);
      $("#importeNota22").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });
  $("#descontar23").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad23").val();
    if(cantidad==1){
      var importe = $("#costo23").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad23").val("");
      $("#clave23").val("");
      $("#descripcion23").val("");
      $("#costo23").val("");
      $("#importeNota23").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }
    else if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo23").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad23").val(auxiliar);
      $("#importeNota23").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });
  $("#descontar24").click(function(){
    var descuento = $("#descuento").text();
    descuento = descuento.split("%");
    descuento = descuento[0];
    var tipo = $("#tipo").val();
    var cantidad = $("#cantidad24").val();
    if(cantidad==1){
      var importe = $("#costo24").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad24").val("");
      $("#clave24").val("");
      $("#descripcion24").val("");
      $("#costo24").val("");
      $("#importeNota24").val("");
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }
    else if(cantidad>1){
      auxiliar = cantidad-1;
      var importe = $("#costo24").val();
      importe = importe.replace(',','');
      importe = importe.split("$");
      importe = importe[1];
      $("#cantidad24").val(auxiliar);
      $("#importeNota24").val(formatNumber.new((importe*auxiliar), "$"));
      var subtotal = $("#subtotalNota").val();
      subtotal = subtotal.replace(',','');
      subtotal = subtotal.split("$");
      subtotal = subtotal[1];
      subtotal = Math.round((subtotal-importe)*100)/100;
      descuento = Math.round((subtotal*(descuento/100))*100)/100;
      subtotal2 = Math.round((subtotal-descuento)*100)/100;
      iva = Math.round((subtotal2*.16)*100)/100;
      total = Math.round((subtotal2+iva)*100)/100;
      if(tipo=="1. Carta Factura"||tipo==""){
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(iva, "$"));
        $("#totalNota").val(formatNumber.new(total, "$"));
      }
      else{
        $("#subtotalNota").val(formatNumber.new(subtotal, "$"));
        $("#descuentoCarta").val(formatNumber.new(descuento, "$"));
        $("#subtotalNota2").val(formatNumber.new(subtotal2, "$"));
        $("#iva").val(formatNumber.new(0, "$"));
        $("#totalNota").val(formatNumber.new(subtotal2, "$"));
      }
    }

  });

});
