$(document).ready(function(){
    $(".abonar").click(function(){
        var id = $(this).attr("id");
        id = id.split("-");
        id = id[1];

        //Cargando los datos en el modal
        $("#remisionAbono").val($("#remision-"+id).text());
        $("#importeAbono").val($("#importe-"+id).text());
        $("#saldoAbono").val($("#saldo-"+id).text());
    });
});
