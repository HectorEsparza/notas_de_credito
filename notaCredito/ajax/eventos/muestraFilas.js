$(document).ready(function(){


  $("#formatoPartidas").click(function(){

    var valor = $("#formatoPartidas").val();

    if(valor==25){
      // alert("Su valor es 25!!!");
      for (var i = 11; i <= 25; i++) {
        $("#muestraFilas"+i).show();
      }

      $("#formatoPartidas").val(10);
      $("#contadorSubtotal").val(25);
    }
    else if (valor==10){
      // alert("Su valor es de 10!!!");
      for (var i = 11; i <= 25; i++) {
        $("#muestraFilas"+i).hide();
      }
      $("#formatoPartidas").val(25);
      $("#contadorSubtotal").val(10);

    }
  });

});
