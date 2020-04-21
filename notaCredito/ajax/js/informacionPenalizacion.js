function informacionPenalizacion(porcentaje, total)
{

       var conexion;
       var penalizacion = $("#penalizacionNota").val();
       console.log(penalizacion);

             if (window.XMLHttpRequest)
             {
               conexion = new XMLHttpRequest();
             }
             else
             {
               conexion = new ActiveXObject("Microsoft.XMLHTTP");
             }

             conexion.onreadystatechange = function()
             {
               if(conexion.readyState==4 && conexion.status==200)
               {
                   document.getElementById('pen').innerHTML = conexion.responseText;
                   // document.getElementById('totalNota').value = conexion.responseText;

               }
             }

             conexion.open("GET", "ajax/informacionPenalizacion.php?porcentaje="+porcentaje+"&total="+total+"&penalizacion="+penalizacion, true);
             conexion.send();

}
