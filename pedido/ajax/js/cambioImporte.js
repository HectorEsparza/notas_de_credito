function cambioImporte(cantidad, importe, i)
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
            document.getElementById('importeNota'+i).innerHTML = conexion.responseText;

        }
      }

      conexion.open("GET", "ajax/cambioImporte.php?cantidad="+cantidad+"&importe="+importe, true);
      conexion.send();
    }
