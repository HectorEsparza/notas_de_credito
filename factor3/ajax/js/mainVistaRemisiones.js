// url para llamar la peticion por ajax
//var url_listar_usuario = "php/listar.php";
var url_listar_usuario = "remisiones.php";
var contador = 1;
var url = window.location.search;
url = url.split("=");
var cliente = url[1];
var i = 0;

$(document).ready(function () {
    // se genera el paginador
    paginador = $(".pagination");
    // cantidad de items por pagina
    var items = 10, numeros = 4;
    // inicia el paginador
    init_paginator(paginador, items, numeros);
    // se envia la peticion ajax que se realizara como callback
    set_callback(get_data_callback);
    cargaPagina(0);
});

function get_data_callback() {
    $.ajax({
        data: {
            limit: itemsPorPagina,
            offset: desde,
            cliente: cliente
        },
        type: "POST",
        url: url_listar_usuario
    }).done(function (data, textStatus, jqXHR) {
        console.log(data.lista);
        // obtiene la clave lista del json data
        var lista = data.lista;
        $("#table").html("");

        // si es necesario actualiza la cantidad de paginas del paginador
        if (pagina == 0) {
            creaPaginador(data.cantidad);
        }
        // genera el cuerpo de la tabla
        $.each(lista, function (ind, elem) {

            $('<tr>' +
                '<td id="remision-'+i+'">' + elem.clave + '</td>' +
                '<td>' + elem.fecha + '</td>' +
                '<td id="importe-'+i+'">' + formatNumber.new(elem.importe, "$") + '</td>' +
                '<td id="saldo-'+i+'">' + formatNumber.new(elem.saldo, "$")+ '</td>' +
                '<td>' +
                    '<input type="button" class="btn btn-info btn-sm abonar" id="abonar-' + i + '" value="+"/>' +
                    '&nbsp;&nbsp;' +
                    '<input type="button" class="btn btn-warning btn-sm consultar" id="consultar-' + i + '" value="?"/>'+
                '</td>' +
                '</tr>').appendTo($("#table"));
            i++;
            $("#infoCliente").text("Cliente "+elem.idCliente+" "+elem.nombreCliente);
            $("#cliente").val(elem.idCliente);
        });
        //Agregando texto
        
        //Agregando scripts para cargar abono y mostrar historial
        $("#scriptParaCargas").empty();
        $("#scriptParaCargas").append('<script type="text/javascript" src="ajax/js/vistaAbonar.js"></script>'+
                                          '<script type="text/javascript" src="ajax/eventos/consultarAbono.js"></script>');

    }).fail(function (jqXHR, textStatus, textError) {
        alert("Error al realizar la peticion dame".textError);
    });

}