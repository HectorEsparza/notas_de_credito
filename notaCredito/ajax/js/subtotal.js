function subtotal(i, cant, cla, descuento)
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
            document.getElementById('subtotal'+i).innerHTML = conexion.responseText;

        }
      }

      conexion.open("GET", "ajax/subtotal2.php?cantidad="+cant+"&clave="+cla+"&descuento="+descuento, true);
      conexion.send();
    }
