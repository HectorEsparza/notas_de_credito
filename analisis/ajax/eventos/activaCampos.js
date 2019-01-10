$(document).ready(function(){

  $("#habilitaCampos").click(function(){

    var idApa = $("#idApa"), descripcion = $("#descripcion"),
        precio = $("#precio"), linea = $("#linea"),
        sublinea = $("#sublinea"), idVazlo = $("#idVazlo"),
        idVazlo = $("#idVazlo"), precioVazlo = $("#precioVazlo"),
        boton = $("#envio");

        idApa.prop("readonly", false);
        descripcion.prop("readonly", false);
        precio.prop("readonly", false);
        linea.prop("disabled", false);
        sublinea.prop("disabled", false);
        idVazlo.prop("readonly", false);
        precioVazlo.prop("readonly", false);
        boton.prop("disabled", false);

  });


});
