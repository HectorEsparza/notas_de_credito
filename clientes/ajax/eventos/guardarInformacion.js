$(document).ready(function(){
    $("#guardarInformacion").click(function(){
        enviar();
    });

    function enviar() {

        var parametros =
        {
            opcionDeCarga: $("#opcionDeCarga").val(),
            archivoDeCarga: $("#archivoDeCarga").val(),
        }
        $.ajax({
            async: true, //Activar la transferencia asincronica
            type: "POST", //El tipo de transaccion para los datos
            dataType: "json", //Especificaremos que datos vamos a enviar
            contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
            url: "ajax/guardarInformacion.php", //Sera el archivo que va a procesar la petición AJAX
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
        console.log("Comprobando infomación...");
    }

    function llegada(datos) {

        switch (datos.respuesta) {
            case 0:
                alert("Carga exitosa");
                setTimeout("location.href='visualizacion.php'");
                break;

            case 1:
                alert("El cliente "+datos.idCliente+" ya existe en la base de datos, verificalo por favor");
                break;
            
            case 2:
                alert("No existe el descuento "+datos.descuentoCliente+"% asociado al cliente "+
                datos.idCliente+", verificalo por favor");
                break;
            
            case 3:
                alert("No existe el vendedor "+datos.vendedorCliente+" asociado al cliente "+
                datos.idCliente+", verificalo por favor");
                break;
            
            case 4:
                    alert("El número de vendedor "+datos.idVendedor+" ya existe en la base de datos, verificalo por favor");
                    break;
            
            case 5:
                    alert("La clave de vendedor "+datos.claveVendedor+" asociada al número de vendedor "+
                    datos.idVendedor+" ya existe en la base de datos, verificalo por favor");
                    break;
            
            case 6:
                    alert("El nombre de vendedor "+datos.nombreVendedor+" asociado al número de vendedor "+
                    datos.idVendedor+" ya existe en la base de datos, verificalo por favor");
                    break;

            default:
                break;
        }
        
    }

    function problemas(textError, textStatus) {
        //var error = JSON.parse(textError);
        alert("Problemas en el Servlet: " + JSON.stringify(textError));
        alert("Problemas en el servlet: " + JSON.stringify(textStatus));
    }
});