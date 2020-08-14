$(document).ready(function () {

    $("#guardarAbono").click(function(){
        //alert("Comprobando datos");
        if($("#abono").val()!=""){
            //Obteniendo el saldo actual y quitando los carcateres y así que quede solamente el número
            var saldo = $("#saldoAbono").val();
            saldo = saldo.replace("$", "");
            saldo = parseFloat(saldo.replace(",", ""));
            //Obteniendo el importe del abono capturado
            var abono = parseFloat($("#abono").val());
            
            //Comparando que el importe introducido sea mayor a 0 y menor o igual al saldo actual
            if(abono>0 && abono<=saldo){
                enviar();
            }
            else{
                alert("Captura un importe para el abono mayor a 0 y menor o igual al saldo actual, por favor");
            }
        }
        else{
            alert("Captura un importe para el abono, por favor");
        }
    });
    function enviar() {

        var parametros =
        {
            abono: $("#abono").val(),
            cliente: $("#cliente").val(),
            remision: $("#remisionAbono").val(),

        }
        $.ajax({
            async: true, //Activar la transferencia asincronica
            type: "POST", //El tipo de transaccion para los datos
            dataType: "json", //Especificaremos que datos vamos a enviar
            contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
            url: "ajax/guardarAbono.php", //Sera el archivo que va a procesar la petición AJAX
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
        console.log("Cargando guardado del abono...");
    }

    function llegada(datos) {
        if(datos.estatus==1){
            alert("Se pudo abonar "+formatNumber.new(datos.abono, "$")+" a la remisión "+datos.remision);
            setTimeout("location.href='vistaRemisiones.php?cliente="+datos.cliente+"'", 500);
        }
        else{
            alert("Error, no se pudo abonar "+datos.abono+" a la remisión "+datos.remision);
        }
        
    }

    function problemas(textError, textStatus) {
        //var error = JSON.parse(textError);
        alert("Problemas en el Servlet: " + JSON.stringify(textError));
        alert("Problemas en el servlet: " + JSON.stringify(textStatus));
    }
});