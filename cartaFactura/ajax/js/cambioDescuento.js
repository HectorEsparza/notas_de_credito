function cambioDescuento(descuento)
{

       var conexion;
       var separador = descuento.split("%");
       document.getElementById('descuentoConsulta').value = separador[0];
    

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
                   document.getElementById('descuento').innerHTML = conexion.responseText;

               }
             }

             conexion.open("GET", "ajax/cambioDescuento.php?descuento="+descuento, true);
             conexion.send();

}
