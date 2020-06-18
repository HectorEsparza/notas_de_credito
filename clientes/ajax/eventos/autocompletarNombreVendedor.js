$(document).ready(function(){
    $("#vendedor").keyup(function(){
        var cadena = $("#vendedor").val();
        cadena = cadena.toUpperCase();
        $("#vendedor").val(cadena);
    });
    $('#vendedor').autocomplete({
        source: function(request, response){
                $.ajax({
                        url:"ajax/autocompletarNombreVendedor.php",
                        dataType:"json",
                        data:{q:request.term},
                        success: function(data){
                                response(data);
                        }
                });
        },
        minLength:1,
        select: function(event, ui){
                //alert("Selecciono: "+ui.item.label);
        }
    });
});