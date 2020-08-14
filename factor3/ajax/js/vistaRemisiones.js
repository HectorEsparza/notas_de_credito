$(document).ready(function(){
    $(".remisiones").click(function(){
        var cliente = $(this).attr("id");
        setTimeout("location.href='vistaRemisiones.php?cliente="+cliente+"'", 500);
        //alert("Enviando a ver remisiones del cliente "+cliente);
    });
});