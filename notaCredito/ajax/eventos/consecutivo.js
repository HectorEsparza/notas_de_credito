$(document).ready(function(){

    $("#tipo").blur(function(){
        var folio = document.getElementById('folio').innerText;
        console.log(folio);
        var separador = folio.split('-');
        $("#consecutivo").val(folio);
        if(folio!=""){

          $("#clienteValor").prop("readonly", false);
          $("#folioRecepcion").prop("readonly", false);
          $("#factura").prop("readonly", false);
          if(separador[0]=="M"){

            // $("#factura").val("Muestra");
            // $("#factura").prop("readonly", true);
            // $("#folioRecepcion").val(0);
            // $("#folioRecepcion").prop("readonly", true);
          }
          else{
            $("#factura").prop("readonly", false);
            $("#folioRecepcion").prop("readonly", false);
            $("#factura").val("");
            $("#folioRecepcion").val("");
          }
        }
        else{
          $("#clienteValor").prop("readonly", true);
          $("#folioRecepcion").prop("readonly", true);
          $("#factura").prop("readonly", true);
        }
    });
});
