function listaDescuentos(usuario)
{

       var conexion;

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
               if (conexion.readyState==4 && conexion.status==200)
               {
                   //document.getElementById('principal').innerHTML = conexion.responseText;
                   document.getElementById('listas').innerHTML = conexion.responseText;

               }
             }

             conexion.open("GET", "ajax/listaDescuentos.php?usuario="+usuario, true);
             conexion.send();

}
