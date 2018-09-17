function recepcion(folio)
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
               if(conexion.readyState==4 && conexion.status==200)
               {
                   //document.getElementById('pen').innerHTML = conexion.responseText;
                   document.getElementById('folioRecepcion').value = conexion.responseText;

               }
             }

             conexion.open("GET", "ajax/folioRecepcion.php?folio="+folio, true);
             conexion.send();

}
