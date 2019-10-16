$(document).ready(function(){
    $("#exportarFacturas").click(function(){
        alert("Exportación en proceso");
        setTimeout("location.href='exportarFacturas.php'", 500);
    });
});