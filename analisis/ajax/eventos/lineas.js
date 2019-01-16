$(document).ready(function(){

  var linea = $("#linea"), sublinea = $("#sublinea");

  $("#linea").change(function(){
    // alert(linea.val());
    // alert("Cambiaste de Linea");

    //Si se escoge el Total
    if(linea.val()=="Total"){
      sublinea.empty("");
      $('<option value="Total">Total</option>').appendTo(sublinea);
    }
    //Si se escoge Soporte APA
    else if(linea.val()=="Soporte APA"){
      sublinea.empty("");
      $('<option value=""></option>'+
        '<option value="Soportes para Motor y Transmisión">Soportes para Motor y Transmisión</option>'+
        '<option value="Gomas, Tapas y Conjuntos para Cardán">Gomas, Tapas y Conjuntos para Cardán</option>'+
        '<option value="Varillas, Ganchos y Topes">Varillas, Ganchos y Topes</option>'+
        '<option value="Total">Totales</option>').appendTo(sublinea);
    }
    //Si se escoge Soporte Importado
    else if(linea.val()=="Soporte Importado") {
      sublinea.empty("");
      $('<option value=""></option>'+
        '<option value="Soportes para Motor y Transmisión">Soportes para Motor y Transmisión</option>'+
        '<option value="Bases de Amortiguador">Bases de Amortiguador</option>'+
        '<option value="Gomas, Tapas y Conjuntos para Cardán">Gomas, Tapas y Conjuntos para Cardán</option>'+
        '<option value="Total">Totales</option>').appendTo(sublinea);
    }
    //Si se escoge Manguera
    else if(linea.val()=="Manguera"){
      sublinea.empty("");
      $('<option value=""></option>'+
        '<option value="Manguera Charter">Manguera Charter</option>'+
        '<option value="Codos de Aire">Codos de Aire</option>'+
        '<option value="Manguera Recta Silicón Naranja">Manguera Recta Silicón Naranja</option>'+
        '<option value="Manguera Recta Silicón Verde">Manguera Recta Silicón Verde</option>'+
        '<option value="Manguera de Silicón Turbo con Anillo">Manguera de Silicón Turbo con Anillo</option>'+
        '<option value="Manguera Tanque de Gasolina">Manguera Tanque de Gasolina</option>'+
        '<option value="Codos y Coples de Silicón">Codos y Coples de Silicón</option>'+
        '<option value="Coples de Admisión">Coples de Admisión</option>'+
        '<option value="Manguera de Purificador">Manguera de Purificador</option>'+
        '<option value="Manguera Moldeada">Manguera Moldeada</option>'+
        '<option value="Total">Totales</option>').appendTo(sublinea);
    }
    else if(linea.val()==""){
      sublinea.empty("");
      $('<option value=""></option>').appendTo(sublinea);
    }

  });

});
