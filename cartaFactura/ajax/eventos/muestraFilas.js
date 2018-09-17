$(document).ready(function(){


  $("#formatoPartidas").click(function(){

    var valor = $("#formatoPartidas").val();

    if(valor==24){
      // alert("Su valor es 24!!!");
      for (var i = 11; i <= 24; i++) {
        $("#muestraFilas"+i).show();
      }

      $("#formatoPartidas").val(10);
      $("#contadorSubtotal").val(24);
    }
    else if (valor==10){
      // alert("Su valor es de 10!!!");
      for (var i = 11; i <= 24; i++) {
        $("#muestraFilas"+i).hide();
      }
      $("#formatoPartidas").val(24);
      $("#contadorSubtotal").val(10);

    }
  });

});
24
