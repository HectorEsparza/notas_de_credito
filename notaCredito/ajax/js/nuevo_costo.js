function nvo_costo(costo, i, lista, user)
    {
        var conexion;

          document.getElementById('lis'+i).value = lista;
          var params = "costo="+costo+"&indice="+i+"&usuario="+user;/*+"&cantidad2="+cant2+"&cantidad3="+cant3+
          "&clave1="+cla1+"&clave2="+cla2+"&clave3="+cla3+"&descuento="+desc;*/

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
                document.getElementById('costo'+i).innerHTML = conexion.responseText;

            }
          }

          conexion.open("POST", "ajax/nvo_costo.php", true);
          conexion.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          conexion.send(params);
      }
