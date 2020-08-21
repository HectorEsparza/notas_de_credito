$(document).ready(function () {

    $("#buscar").click(function () {
        if ($("#folio").val() != "" || $("#fecha").val() != "") {
            enviar();
        }
        else {
            alert("Captura al menos un campo, por favor");
        }

    });

    function enviar() {

        var parametros =
        {
            folio: $("#folio").val(),
            fecha: $("#fecha").val(),
            cliente: $("#cliente").val(),
        }
        console.log(parametros);
        $.ajax({
            async: true, //Activar la transferencia asincronica
            type: "POST", //El tipo de transaccion para los datos
            dataType: "json", //Especificaremos que datos vamos a enviar
            contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
            url: "ajax/filtroRemisiones.php", //Sera el archivo que va a procesar la petición AJAX
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
        console.log("Cargando Filtro Remisiones...");
    }

    function llegada(datos) {
        console.log(datos);
        var contador = Object.keys(datos.clave).length;
        var contenido = "";

        if (contador > 0) {
            for (var i = 0; i < contador; i++) {
                contenido += '<tr>' +
                    '<td id="remision-' + i + '">' + datos.clave[i] + '</td>' +
                    '<td>' + datos.fecha[i] + '</td>' +
                    '<td id="importe-' + i + '">' + formatNumber.new(datos.importe[i], "$") + '</td>' +
                    '<td id="saldo-' + i + '">' + formatNumber.new(datos.saldo[i], "$") + '</td>' +
                    '<td>' +
                    '<input type="button" class="btn btn-info btn-sm abonar" id="abonar-' + i + '" value="+"' +
                    'data-toggle="modal" data-target="#miModal"/>' +
                    '&nbsp;&nbsp;' +
                    '<input type="button" class="btn btn-warning btn-sm consultar" id="consultar-' + i + '" value="?"' +
                    'data-toggle="modal" data-target="#historial" /></td>' +
                    '</tr>';
            }
            $("#paginador").hide();
            $("#table").empty();
            $("#table").append(contenido);
            $("#scriptParaCargas").empty();
            $("#scriptParaCargas").append('<script type="text/javascript" src="ajax/js/vistaAbonar.js"></script>' +
                '<script type="text/javascript" src="ajax/eventos/consultarAbono.js"></script>');
        }
        else {
            alert("No se encontraron datos en la consulta");
        }

    }

    function problemas(textError, textStatus) {
        //var error = JSON.parse(textError);
        alert("Problemas en el Servlet: " + JSON.stringify(textError));
        alert("Problemas en el servlet: " + JSON.stringify(textStatus));
    }
});