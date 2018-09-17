function cancelaPenalizacion(total, penalizacion)
{

       var conexion;
       $("#cancelaPenalizacion").hide();
       document.getElementById('pen').innerText = "";
       document.getElementById('penalizacionNota').value = 0;
       document.getElementById('porcentaje').value = 0;
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
                   // document.getElementById('pen').innerHTML = conexion.responseText;
                   document.getElementById('totalNota').value = conexion.responseText;

               }
             }

             conexion.open("GET", "ajax/cancelaPenalizacion.php?total="+total+"&penalizacion="+penalizacion, true);
             conexion.send();

}
