$(document).ready(function(){
    $("#exportarFacturasSinEntrada").click(function(){
        alert("Exportación en proceso");
        setTimeout("location.href='exportarFacturasSinEntrada.php'", 500);
    });
});