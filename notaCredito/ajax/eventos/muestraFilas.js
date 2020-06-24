$(document).ready(function(){


  $("#formatoPartidas").click(function(){

    var valor = $("#formatoPartidas").val();

    if(valor==40){
      // alert("Su valor es 40!!!");
      for (var i = 11; i <= 40; i++) {
        $("#muestraFilas"+i).show();
      }

      $("#formatoPartidas").val(10);
      $("#contadorSubtotal").val(40);
    }
    else if (valor==10){
      // alert("Su valor es de 10!!!");
      for (var i = 11; i <= 40; i++) {
        $("#muestraFilas"+i).hide();
      }
      $("#formatoPartidas").val(40);
      $("#contadorSubtotal").val(10);

    }
  });

});
