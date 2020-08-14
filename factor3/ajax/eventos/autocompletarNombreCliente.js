$(document).ready(function(){
    $("#nombre").keyup(function(){
        var cadena = $("#nombre").val();
        cadena = cadena.toUpperCase();
        $("#nombre").val(cadena);
    });
    $('#nombre').autocomplete({
        source: function(request, response){
                $.ajax({
                        url:"ajax/autocompletarNombreCliente.php",
                        dataType:"json",
                        data:{q:request.term},
                        success: function(data){
                                response(data);
                        }
                });
        },
        minLength:3,
        select: function(event, ui){
                //alert("Selecciono: "+ui.item.label);
        }
    });
});