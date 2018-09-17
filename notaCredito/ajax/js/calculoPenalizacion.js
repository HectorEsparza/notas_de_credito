function calculoPenalizacion(porcentaje, total)
{

       var conexion;
       var totalOculto;
       var porcentajeOculto;
       totalOculto = total.replace(',', '');
       totalOculto = totalOculto.split("$");
       descuento = parseFloat(totalOculto[1]);
       porcentajeOculto = porcentaje/100;
       descuento = descuento*porcentajeOculto;
       descuento = Math.round(descuento*100)/100;
       document.getElementById('penalizacionNota').value = descuento;
       document.getElementById('porcentaje').value = porcentaje;
       $("#cancelaPenalizacion").show();

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
                   //document.getElementById('pen').innerHTML = conexion.responseText;
                   document.getElementById('totalNota').value = conexion.responseText;

               }
             }

             conexion.open("GET", "ajax/calculoPenalizacion.php?porcentaje="+porcentaje+"&total="+total, true);
             conexion.send();

}
