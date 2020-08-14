$(document).ready(function () {

    var url = window.location.search;
    url = url.split("=");
    var cliente = url[1];

    enviar(cliente);

    function enviar(cliente) {

        var parametros =
        {
            cliente: cliente,
        }
        $.ajax({
            async: true, //Activar la transferencia asincronica
            type: "POST", //El tipo de transaccion para los datos
            dataType: "json", //Especificaremos que datos vamos a enviar
            contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
            url: "ajax/cargarRemisionesCliente.php", //Sera el archivo que va a procesar la petición AJAX
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
        console.log("Cargando Remisiones Clientes...");
    }

    function llegada(datos) {
        console.log(datos);
        var contador = Object.keys(datos.clave).length;
        if(contador==0){
            alert("El cliente "+datos.cliente+" no cuenta con remisiones actualmente");
            setTimeout("location.href='visualizacion.php'", 500);
        }
        else{
            var contenido = "";
            $("#cliente").val(datos.cliente);
            $("#infoCliente").text("Cliente "+datos.cliente+" "+datos.nombre);
    
            for (var i = 0; i < contador; i++){
                contenido += '<tr>'+
                                '<td id="remision-'+i+'">'+datos.clave[i]+'</td>'+
                                '<td>'+datos.fecha[i]+'</td>'+
                                '<td id="importe-'+i+'">'+formatNumber.new(datos.importe[i], "$")+'</td>'+
                                '<td id="saldo-'+i+'">'+formatNumber.new(datos.saldo[i], "$")+'</td>'+
                                '<td>'+
                                    '<input type="button" class="btn btn-info btn-sm abonar" id="abonar-'+i+'" value="+"'+ 
                                    'data-toggle="modal" data-target="#miModal"/>'+
                                    '&nbsp;&nbsp;'+
                                    '<input type="button" class="btn btn-warning btn-sm consultar" id="consultar-'+i+'" value="?"'+
                                    'data-toggle="modal" data-target="#historial" /></td>'+
                             '</tr>';
            }
            $("#table").append(contenido);
            $("#scriptParaCargas").append('<script type="text/javascript" src="ajax/js/vistaAbonar.js"></script>'+
                                          '<script type="text/javascript" src="ajax/eventos/consultarAbono.js"></script>');
        }
        
    }

    function problemas(textError, textStatus) {
        //var error = JSON.parse(textError);
        alert("Problemas en el Servlet: " + JSON.stringify(textError));
        alert("Problemas en el servlet: " + JSON.stringify(textStatus));
    }
});