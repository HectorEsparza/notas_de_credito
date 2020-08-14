$(document).ready(function () {
    $("#nota").click(function () {
        setTimeout("location.href='../notaCredito/visualizacion.php'", 500);
    });
    $("#carta").click(function () {
        setTimeout("location.href='../cartaFactura/visualizarCartas.php'", 500);
    });
    $("#sae").click(function () {
        setTimeout("location.href='../notaCredito/sae.php'", 500);
    });
    $("#pedido").click(function () {
        setTimeout("location.href='../pedido/visualizarPedidos.php'", 500);
    });
    $("#altas").click(function () {
        setTimeout("location.href='../altaTrabajador/visualizacion.php'", 500);
    });

    $("#analisis").click(function () {
        setTimeout("location.href='../analisis/analisis.php'", 500);
    });

    $("#caja").click(function () {
        setTimeout("location.href='../caja/visualizacion.php'", 500);
    });

    $("#contado").click(function () {
        setTimeout("location.href='../contados/visualizacion.php'", 500);
    });

    $("#cliente").click(function () {
        setTimeout("location.href='../clientes/visualizacion.php'", 500);
    });

    $("#factor3").click(function () {
        setTimeout("location.href='../factor3/visualizacion.php'", 500);
    });
});