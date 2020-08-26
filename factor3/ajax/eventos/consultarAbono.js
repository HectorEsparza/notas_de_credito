$(document).ready(function () {

    $(".consultar").click(function () {
        var id = $(this).attr("id");
        id = id.split("-");
        id = id[1];
        $( "#contenidoHistorial" ).dialog({
            height: 550,
            width: 1000,
            dialogClass: "no-close",
            buttons: [
              {
                class: "btn btn-danger",
                text: "Cerrar",
                click: function() {
                  $( this ).dialog( "close" );
                }
              }
            ]
        });
        //Guardando el folio de remision
        $("#remisionAbono").val($("#remision-"+id).text());
        //Guardando el total del importe de la remisión
        var importe = $("#importe-"+id).text();
        importe = importe.replace("$", "");
        importe = parseFloat(importe.replace(",", ""));
        $("#importeAbono").val(importe);
    
        enviar(id);
    });

    function enviar(id) {

        var parametros =
        {
            remision: $("#remision-" + id).text(),
        }

        $.ajax({
            async: true, //Activar la transferencia asincronica
            type: "POST", //El tipo de transaccion para los datos
            dataType: "json", //Especificaremos que datos vamos a enviar
            contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
            url: "ajax/consultarAbono.php", //Sera el archivo que va a procesar la petición AJAX
            data: parametros,
            // data: "total="+total+"&penalizacion="+penalizacion,
            beforeSend: inicioEnvio, //Es la función que se ejecuta antes de empezar la transacción
            success: llegada, //Función que se ejecuta en caso de tener exito
            timeout: 4000,
            error: problemas //Función que se ejecuta si se tiene problemas al superar el timeout
        });
        return false;
    }
    function inicioEnvio() {
        console.log("Cargando historial abonos...");
    }

    function llegada(datos) {
        console.log(datos);
        var contador = Object.keys(datos.abono).length;

        if (contador > 0) {
            var contenido = '<table class="table table-bordered table-striped text-center">' +
                '<thead class="thead-dark">' +
                '<th>#</th>' +
                '<th>Importe</th>' +
                '<th>Fecha</th>' +
                '<th>Observaciones</th>' +
                '<th>Aplicado por</th>' +
                '<th colspan=2>Editar</th>' +
                '</thead>' +
                '<tbody>';

            for (var i = 0; i < contador; i++) {

                contenido += '<tr>' +
                    '<td>' + (parseInt(i) + 1) + '</td>' +
                    '<td id="importeAbono-'+i+'">' + formatNumber.new(datos.abono[i], "$") + '</td>' +
                    '<td id="fechaAbono-'+i+'">' + datos.fecha[i] + '</td>' +
                    '<td>' + datos.observaciones[i] + '</td>' +
                    '<td>' + datos.usuario[i] + '</td>' +
                    '<td>'+
                        '<input type="number" step="any" class="form-control" id="editarAbono-'+i+'" placeholder="Captura un importe" />'+
                    '</td>' +
                    '<td>'+
                        '<input type="button" class="btn btn-success btn-sm editar" id="editar-'+i+'" value="Confirmar" />'+
                    '</td>' +
                    '</tr>';
            }

            contenido += '</tbody>' +
                '</table>';

            $("#contenidoHistorial").empty();
            $("#contenidoHistorial").append(contenido);
        }
        else{
            $("#contenidoHistorial").empty();
            $("#contenidoHistorial").append("<p>No se encontraron historial de pagos</p>");  
        }

        //$("#scriptParaCargas").empty();
        $("#scriptParaCargas").append('<script type="text/javascript" src="ajax/eventos/editarAbono.js"></script>');
    }

    function problemas(textError, textStatus) {
        //var error = JSON.parse(textError);
        alert("Problemas en el Servlet: " + JSON.stringify(textError));
        alert("Problemas en el servlet: " + JSON.stringify(textStatus));
    }
});