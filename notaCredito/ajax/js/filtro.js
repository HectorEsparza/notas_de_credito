function filtro(nocliente, cliente, fecha, folio, sae)
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

              conexion.open("GET", "ajax/filtro.php?nocliente="+nocliente+"&cliente="+cliente+"&fecha="+fecha+"&folio="+folio+"&sae="+sae, true);
              conexion.send();

 }
