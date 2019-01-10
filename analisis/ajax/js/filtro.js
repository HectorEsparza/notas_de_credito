function filtro(idApa, idVazlo)
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
                    document.getElementById('table').innerHTML = conexion.responseText;

                }
              }

              conexion.open("GET", "ajax/filtro.php?idApa="+idApa+"&idVazlo="+idVazlo, true);
              conexion.send();

 }
