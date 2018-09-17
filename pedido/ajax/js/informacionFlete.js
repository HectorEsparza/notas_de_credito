function informacionFlete(cantidad)
{

       var conexion;

              document.getElementById('fletes').value = cantidad;
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

             conexion.open("GET", "ajax/informacionFlete.php?cantidad="+cantidad, true);
             conexion.send();

}
