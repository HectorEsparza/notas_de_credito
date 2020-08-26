$(document).ready(function(){
    //alert("Vamos a editar el abono");
    $(".editar").click(function(){
        var id = $(this).attr("id");
        id = id.split("-");
        id = id[1];
        //Obteniendo el importe actual del abono y quitando los carcateres y así que quede solamente el número
        var importeAbono = $("#importeAbono-"+id).text();
        importeAbono = importeAbono.replace("$", "");
        importeAbono = parseFloat(importeAbono.replace(",", ""));
        //obteniendo la fecha actual de abono
        var fechaAbono = $("#fechaAbono-"+id).text();
        
        
        if($("#editarAbono-"+id).val()!="" && parseFloat($("#editarAbono-"+id).val())>0){
            if($("#editarAbono-"+id).val()!=importeAbono){
                //alert("Enviando petición");
                enviar(id, importeAbono, fechaAbono);
            }
            else{
                alert("Captura un importe diferente al abono capturado anteriormente, por favor");
            }
        }
        else{
            alert("Captura un importe y además que sea mayor a 0, por favor");
        }
    });
    function enviar(id, importeAbono, fechaAbono) {

        var parametros =
        {
            nuevoAbono: $("#editarAbono-"+id).val(),
            anteriorAbono: importeAbono,
            fechaAbono: fechaAbono,
            remision: $("#remisionAbono").val(),
            importeRemision: $("#importeAbono").val(),
        }
        
        $.ajax({
            async: true, //Activar la transferencia asincronica
            type: "POST", //El tipo de transaccion para los datos
            dataType: "json", //Especificaremos que datos vamos a enviar
            contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
            url: "ajax/editarAbono.php", //Sera el archivo que va a procesar la petición AJAX
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
        console.log("Comprobando la edición del abono...");
    }

    function llegada(datos) {
        console.log(datos);
        if(datos.usuarioCapturador==1){
            if(datos.abonoActualizado==1){
                alert("Se pudo editar el abono de manera exitosa");
                location.reload();
            }
            else{
                alert("No se puedo editar el abono porque el saldo de la remisión quedaría negativo, intenta otro importe por favor");
            }
        }
        else{
            alert("Solamente puede editar el usuario que aplico el abono");
        }

    }

    function problemas(textError, textStatus) {
        //var error = JSON.parse(textError);
        alert("Problemas en el Servlet: " + JSON.stringify(textError));
        alert("Problemas en el servlet: " + JSON.stringify(textStatus));
    }
});