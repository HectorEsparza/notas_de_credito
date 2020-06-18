$(document).ready(function () {
    var url = window.location.search;
    url = url.split("?");
    url = url[1];
    url = url.split("&");
    var opcionDeCarga = url[0];
    opcionDeCarga = opcionDeCarga.split("=");
    opcionDeCarga = opcionDeCarga[1];
    opcionDeCarga = opcionDeCarga.replace("%20", " ");
    var archivoDeCarga = url[1];
    archivoDeCarga = archivoDeCarga.split("=");
    archivoDeCarga = archivoDeCarga[1];
    archivoDeCarga = archivoDeCarga.replace("%20", " ");

    enviar(opcionDeCarga, archivoDeCarga);

    function enviar(opcionDeCarga, archivoDeCarga) {

        var parametros =
        {
            opcionDeCarga: opcionDeCarga,
            archivoDeCarga: archivoDeCarga,
        }
        $.ajax({
            async: true, //Activar la transferencia asincronica
            type: "POST", //El tipo de transaccion para los datos
            dataType: "json", //Especificaremos que datos vamos a enviar
            contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
            url: "ajax/leerArchivo.php", //Sera el archivo que va a procesar la petición AJAX
            data: parametros, //Datos que le vamos a enviar
            // data: "total="+total+"&penalizacion="+penalizacion,
            beforeSend: inicioEnvio, //Es la función que se ejecuta antes de empezar la transacción
            success: llegada, //Función que se ejecuta en caso de tener exito
            timeout: 4000,
            error: problemas //Función que se ejecuta si se tiene problemas al superar el timeout
        });
        return false;
    }
    function inicioEnvio() {
        console.log("Leyendo Archivo...");
    }

    function llegada(datos) {

        if (datos.opcionDeCarga == "Nuevos Clientes" || datos.opcionDeCarga == "Actualizar Clientes") {
            var contador = Object.keys(datos.idCliente).length;
            if(contador==0){
                alert("El archivo no cumple con la estructura, verificalo por favor");
                setTimeout("location.href='visualizacion.php'");
            }
            var tabla = '<table class="table table-hover table-sm table-responsive text-center">';
            for (var i = 0; i < contador; i++) {
                if (i == 0) {
                    tabla += '<thead class="thead-dark">' +
                        '<tr>' +
                        '<th>' + datos.idCliente[i] + '</th>' +
                        '<th>' + datos.nombreCliente[i] + '</th>' +
                        '<th>' + datos.descuentoCliente[i] + '</th>' +
                        '<th>' + datos.rfcCliente[i] + '</th>' +
                        '<th>' + datos.calleCliente[i] + '</th>' +
                        '<th>' + datos.coloniaCliente[i] + '</th>' +
                        '<th>' + datos.cpCliente[i] + '</th>' +
                        '<th>' + datos.telefonoCliente[i] + '</th>' +
                        '<th>' + datos.estatusCliente[i] + '</th>' +
                        '<th>' + datos.vendedorCliente[i] + '</th>' +
                        '</tr>' +
                        '</thead>';
                }
                else if (i == 1) {
                    tabla += '<tbody>' +
                        '<tr>' +
                        '<td>' + datos.idCliente[i] + '</td>' +
                        '<td>' + datos.nombreCliente[i] + '</td>' +
                        '<td>' + datos.descuentoCliente[i] + '%</td>' +
                        '<td>' + datos.rfcCliente[i] + '</td>' +
                        '<td>' + datos.calleCliente[i] + '</td>' +
                        '<td>' + datos.coloniaCliente[i] + '</td>' +
                        '<td>' + datos.cpCliente[i] + '</td>' +
                        '<td>' + datos.telefonoCliente[i] + '</td>' +
                        '<td>' + datos.estatusCliente[i] + '</td>' +
                        '<td>' + datos.vendedorCliente[i] + '</td>' +
                        '</tr>';
                }
                else {
                    tabla += '  <tr>' +
                        '<td>' + datos.idCliente[i] + '</td>' +
                        '<td>' + datos.nombreCliente[i] + '</td>' +
                        '<td>' + datos.descuentoCliente[i] + '%</td>' +
                        '<td>' + datos.rfcCliente[i] + '</td>' +
                        '<td>' + datos.calleCliente[i] + '</td>' +
                        '<td>' + datos.coloniaCliente[i] + '</td>' +
                        '<td>' + datos.cpCliente[i] + '</td>' +
                        '<td>' + datos.telefonoCliente[i] + '</td>' +
                        '<td>' + datos.estatusCliente[i] + '</td>' +
                        '<td>' + datos.vendedorCliente[i] + '</td>' +
                        '</tr>';
                }

            }
            tabla += '</tbody>' +
                '<tfoot>' +
                '<td colspan="10" class="text-center">'+
                    '<input type="button" class="btn btn-sm btn-dark" id="guardarInformacion" value="Guardar"/>'+
                    '<input type="hidden" id="opcionDeCarga" value="'+datos.opcionDeCarga+'"/>'+
                    '<input type="hidden" id="archivoDeCarga" value="'+datos.archivoDeCarga+'"/>'+
                '</td>'+
            '</tfoot>' +
                '</table>';
            $("#principal").empty();
            $("#principal").append(tabla);
            $("#encabezado").empty();
            $("#encabezado").append('<h1>' + datos.opcionDeCarga + '</h1>');
            $("#scriptParaCargas").empty();
            $("#scriptParaCargas").append('<script type="text/javascript" src="ajax/eventos/guardarInformacion.js"></script>');
        }
        else if (datos.opcionDeCarga == "Nuevos Vendedores" || datos.opcionDeCarga == "Actualizar Vendedores") {
            var contador = Object.keys(datos.idVendedor).length;
            if(contador==0){
                alert("El archivo no cumple con la estructura, verificalo por favor");
                setTimeout("location.href='visualizacion.php'");
            }
            var tabla = '<table class="table table-hover table-sm table-responsive text-center">';
            for (var i = 0; i < contador; i++) {
                if (i == 0) {
                    tabla += '<thead class="thead-dark">' +
                        '<tr>' +
                        '<th>' + datos.idVendedor[i] + '</th>' +
                        '<th>' + datos.claveVendedor[i] + '</th>' +
                        '<th>' + datos.nombreVendedor[i] + '</th>' +
                        '</tr>' +
                        '</thead>';
                }
                else if (i == 1) {
                    tabla += '<tbody>' +
                        '<tr>' +
                        '<td>' + datos.idVendedor[i] + '</td>' +
                        '<td>' + datos.claveVendedor[i] + '</td>' +
                        '<td>' + datos.nombreVendedor[i] + '</td>' +
                        '</tr>';
                }
                else {
                    tabla += '  <tr>' +
                        '<td>' + datos.idVendedor[i] + '</td>' +
                        '<td>' + datos.claveVendedor[i] + '</td>' +
                        '<td>' + datos.nombreVendedor[i] + '</td>' +
                        '</tr>';
                }

            }
            tabla += '</tbody>' +
                '<tfoot>' +
                '<td colspan="10" class="text-center">'+
                    '<input type="button" class="btn btn-sm btn-dark" id="guardarInformacion" value="Guardar"/>'+
                    '<input type="hidden" id="opcionDeCarga" value="'+datos.opcionDeCarga+'"/>'+
                    '<input type="hidden" id="archivoDeCarga" value="'+datos.archivoDeCarga+'"/>'+
                '</td>'+
            '</tfoot>' +
                '</table>';
            $("#principal").empty();
            $("#principal").append(tabla);
            $("#encabezado").empty();
            $("#encabezado").append('<h1>' + datos.opcionDeCarga + '</h1>');
            $("#scriptParaCargas").empty();
            $("#scriptParaCargas").append('<script type="text/javascript" src="ajax/eventos/guardarInformacion.js"></script>');
        }

    }

    function problemas(textError, textStatus) {
        //var error = JSON.parse(textError);
        alert("Problemas en el Servlet: " + JSON.stringify(textError));
        alert("Problemas en el servlet: " + JSON.stringify(textStatus));
    }
});