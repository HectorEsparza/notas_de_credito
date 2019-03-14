$(document).ready(function(){

  $("#limpiaFiltro").click(function(){

    $("#linea").val('0');
    $("#sublinea").val('0');
    $("#descuentoApa").val('0');
    $("#descuentoVazlo").val('0');
    $("#descuentoAdicional").prop('checked', false);

    $("#porcentajeCaro").text("");
    $("#cantidadCaro").text("");
    $("#variacionPorcentajeCaro").text("");
    $("#variacionPesosCaro").text("");
    $("#porcentajeCaroA").text("");
    $("#cantidadCaroA").text("");
    $("#porcentajeCaroB").text("");
    $("#cantidadCaroB").text("");
    $("#porcentajeCaroC").text("");
    $("#cantidadCaroC").text("");

    $("#porcentajeBarato").text("");
    $("#cantidadBarato").text("");
    $("#variacionPorcentajeBarato").text("");
    $("#variacionPesosBarato").text("");
    $("#porcentajeBaratoA").text("");
    $("#cantidadBaratoA").text("");
    $("#porcentajeBaratoB").text("");
    $("#cantidadBaratoB").text("");
    $("#porcentajeBaratoC").text("");
    $("#cantidadBaratoC").text("");

    $("#totalPorcentaje").text("");
    $("#totalCantidad").text("");
    $("#porcentaje").text("");
    $("#cantidad").text("");
    $("#totalPorcentajeA").text("");
    $("#totalCantidadA").text("");
    $("#totalPorcentajeB").text("");
    $("#totalCantidadB").text("");
    $("#totalPorcentajeC").text("");
    $("#totalCantidadC").text("");

    $("#nivel").hide();
    $("#tablaNivel").empty();
  });
});
