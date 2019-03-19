$(document).ready(function(){

  $("#habilitaCampos").click(function(){

    var idApa = $("#idApa"), descripcion = $("#descripcion"),
        precio = $("#precio"), linea = $("#linea"),
        sublinea = $("#sublinea"), idVazlo = $("#idVazlo"),
        idVazlo = $("#idVazlo"), precioVazlo = $("#precioVazlo"),
        importancia = $("#importancia"), boton = $("#envio");

        idApa.prop("readonly", true);
        descripcion.prop("readonly", false);
        precio.prop("readonly", false);
        linea.prop("disabled", false);
        sublinea.prop("disabled", false);
        idVazlo.prop("readonly", false);
        precioVazlo.prop("readonly", false);
        importancia.prop("readonly", false);
        boton.prop("disabled", false);

  });


});
