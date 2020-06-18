$(document).ready(function(){

    $("#botonDeCarga").click(function(){
        //alert("Enviando Formulari de carga");
        if($("#opcionDeCarga").val()!="" && $("#archivoDeCarga").val()!=""){
            var archivo = $("#archivoDeCarga").val();
            arreglo = archivo.split("\\");
            arreglo = arreglo[arreglo.length-1];
            //alert("Introduciste el archivo "+arreglo+" y el tamaño es de "+arreglo.length);
            arreglo = arreglo.split(".");
            arreglo = arreglo[1];
            if (arreglo=="csv"){
                enviar(); 
            }
            else{
                alert("Solamente se permiten archivos con extensión .csv, verificalo por favor");
            }
        }
        else{
            alert("Llena todos los campos, por favor");
        }
    });

    function enviar(){
      
        var formData = new FormData(document.getElementById("formularioDeCarga"));

        $.ajax({
            async: true, //Activar la transferencia asincronica
            type: "POST", //El tipo de transaccion para los datos
            dataType: "json", //Especificaremos que datos vamos a enviar
            contentType: false, //Especificaremos el tipo de contenido
            url: "ajax/cargarArchivo.php", //Sera el archivo que va a procesar la petición AJAX
            data: formData, //Datos que le vamos a enviar
            cache: false,
            processData: false,
            // data: "total="+total+"&penalizacion="+penalizacion,
            beforeSend: inicioEnvio, //Es la función que se ejecuta antes de empezar la transacción
            success: llegada, //Función que se ejecuta en caso de tener exito
            timeout: 4000,
            error: problemas //Función que se ejecuta si se tiene problemas al superar el timeout
        });
        return false;
      }
      function inicioEnvio(){
          console.log("Cargando Carga de Archivo...");
      }
    
      function llegada(datos){
        console.log(datos);
        if(datos.flag==1){
            //Redireccionando
            setTimeout("location.href='cargarInformacion.php?opcion="+datos.opcionDeCarga+"&archivo="+datos.nombreArchivo+"'",500);
        }
        else{
            alert("El archivo no cumple con la estructura, revisalo por favor");
        }
        
      }
    
      function problemas(textError, textStatus) {
            //var error = JSON.parse(textError);
            alert("Problemas en el Servlet: " + JSON.stringify(textError));
            alert("Problemas en el servlet: " + JSON.stringify(textStatus));
      }
});